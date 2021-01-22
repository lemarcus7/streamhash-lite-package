<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Helpers\Helper;

use App\Settings;

use App\User;

use App\Wishlist;

use App\Category;

use App\Page;

use Validator;

use Setting;

define('WEB' , 1);


class UserController extends Controller
{
    protected $UserAPI;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserApiController $API)
    {
        $this->UserAPI = $API;
        
        $this->middleware('auth', ['except' => ['index','about','single_video','all_categories' ,'category_videos' , 'sub_category_videos' ,  'about' , 'contact','trending']]);
    }

    /**
     * Show the user dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $database = config('database.connections.mysql.database');
        $username = config('database.connections.mysql.username');

        if($database && $username && Setting::get('installation_process') == 3) {

            /*$watch_lists = $wishlists = array();

            if(\Auth::check()){

                $wishlists  = Helper::wishlist(\Auth::user()->id,WEB);  

                $watch_lists = Helper::watch_list(\Auth::user()->id,WEB);  
            }
            
            $recent_videos = Helper::recently_added(WEB);

            $trendings = Helper::trending(WEB);
            
            $suggestions  = Helper::suggestion_videos(WEB);*/

            $categories = get_categories();

            return view('user.index')
                        ->with('page' , 'home')
                        ->with('subPage' , 'home')
                        ->with('categories' , $categories)
                        /*->with('wishlists' , $wishlists)
                        ->with('recent_videos' , $recent_videos)
                        ->with('trendings' , $trendings)
                        ->with('watch_lists' , $watch_lists)
                        ->with('suggestions' , $suggestions)
                        ->with('categories' , $categories)*/;
        } else {
            return redirect()->route('installTheme');
        }
        
    }

    public function single_video($id) {

        $video = Helper::get_video_details($id);

        $trendings = Helper::trending(WEB);

        $recent_videos = Helper::recently_added(WEB);

        $categories = get_categories();

        $comments = Helper::get_video_comments($id,0,WEB);

        $suggestions = Helper::suggestion_videos();

        $wishlist_status = $history_status = WISHLIST_EMPTY;

        if(\Auth::check()) {
            $wishlist_status = Helper::check_wishlist_status(\Auth::user()->id,$id);
            $history_status = Helper::history_status(\Auth::user()->id,$id);

        }

        if($video) {

            $trailer_video = $video->trailer_video;

            $main_video = $video->video; 

            if(check_valid_url($video->video) && $video->video_upload_type == 2) {
                if(\Setting::get('streaming_url')) {
                    $main_video = \Setting::get('streaming_url').get_video_end($video->video);
                }
            }

            if(check_valid_url($video->trailer_video) && $video->video_upload_type == 2) {
                if(\Setting::get('streaming_url')) {
                    $trailer_video = \Setting::get('streaming_url').get_video_end($video->trailer_video);
                }
            }

        }

        $share_link = route('user.single' , $id);
        
        return view('user.single-video')
                    ->with('page' , '')
                    ->with('subPage' , '')
                    ->with('video' , $video)
                    ->with('recent_videos' , $recent_videos)
                    ->with('trendings' , $trendings)
                    ->with('comments' , $comments)
                    ->with('suggestions',$suggestions)
                    ->with('wishlist_status' , $wishlist_status)
                    ->with('suggestions',$suggestions)
                    ->with('history_status' , $history_status)
                    ->with('categories' , $categories)
                    ->with('trailer_video' , $trailer_video)
                    ->with('main_video' , $main_video);
    }

    /**
     * Show the profile list.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        return view('user.profile')
                    ->with('page' , 'profile')
                    ->with('subPage' , 'user-profile');
    }

    /**
     * Show the profile list.
     *
     * @return \Illuminate\Http\Response
     */
    public function update_profile()
    {
        return view('user.edit-profile')->with('page' , 'profile')
                    ->with('subPage' , 'user-update-profile');
    }

    /**
     * Save any changes to the users profile.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile_save(Request $request)
    {
        $request->request->add([ 
            'id' => \Auth::user()->id,
            'token' => \Auth::user()->token,
            'device_token' => \Auth::user()->device_token,
        ]);

        $response = $this->UserAPI->update_profile($request)->getData();

        if($response->success) {
            $response->message = tr('profile_updated');
        } else {
            $response->success = false;
            $response->message = $response->error." ".$response->error_messages;
        }

        return back()->with('response', $response);
    }

    /**
     * Save changed password.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile_save_password(Request $request)
    {
        $request->request->add([ 
            'id' => \Auth::user()->id,
            'token' => \Auth::user()->token,
            'device_token' => \Auth::user()->device_token,
        ]);

        $response = $this->UserAPI->change_password($request)->getData();

        if($response->success) {

            return back()->with('flash_success', tr('password_success'));

        } else {
           //  $response->success = false;
            $response->message = $response->error." ".$response->error_messages;

            return back()->with('flash_error', $response->message);
        }
    }

    public function profile_change_password(Request $request) {

        return view('user.change-password')->with('page' , 'profile')
                    ->with('subPage' , 'user-change-password');

    }

    public function add_history(Request $request) {

        $request->request->add([ 
            'id' => \Auth::user()->id,
            'token' => \Auth::user()->token,
            'device_token' => \Auth::user()->device_token
        ]);

        $response = $this->UserAPI->add_history($request)->getData();

        if($response->success) {
            $response->message = Helper::get_message(118);
        } else {
            $response->success = false;
            $response->message = "Something Went Wrong";
        }

        $response->status = $request->status;

        return response()->json($response);
    
    }

    public function delete_history(Request $request) {

        $request->request->add([ 
            'id' => \Auth::user()->id,
            'token' => \Auth::user()->token,
            'device_token' => \Auth::user()->device_token
        ]);

        $response = $this->UserAPI->delete_history($request)->getData();

        if($response->success) {
            $response->message = Helper::get_message(121);
        } else {
            $response->success = false;
            $response->message = "Something Went Wrong";
        }

        return back()->with('response', $response);
    }

    public function history(Request $request) {

        $histories = Helper::watch_list(\Auth::user()->id,WEB);

        return view('user.history')
                        ->with('page' , 'profile')
                        ->with('subPage' , 'user-history')
                        ->with('histories' , $histories);
    }

    public function add_wishlist(Request $request) {

        $request->request->add([ 
            'id' => \Auth::user()->id,
            'token' => \Auth::user()->token,
            'device_token' => \Auth::user()->device_token
        ]);

        if($request->status == 1) {
            $response = $this->UserAPI->add_wishlist($request)->getData();
        } else {
            $response = $this->UserAPI->delete_wishlist($request)->getData();
        }

        if($response->success) {
            $response->message = Helper::get_message(118);
        } else {
            $response->success = false;
            $response->message = "Something Went Wrong";
        }

        $response->status = $request->status;

        return response()->json($response);
    }

    public function delete_wishlist(Request $request) {

        $request->request->add([ 
            'id' => \Auth::user()->id,
            'token' => \Auth::user()->token,
            'device_token' => \Auth::user()->device_token
        ]);

        $response = $this->UserAPI->delete_wishlist($request)->getData();

        if($response->success) {
            $response->message = Helper::get_message(118);
        } else {
            $response->success = false;
            $response->message = "Something Went Wrong";
        }

        return back()->with('response', $response);
    } 

    public function wishlist(Request $request) {
        
        $videos = Helper::wishlist(\Auth::user()->id,WEB);

        return view('user.wishlist')
                    ->with('page' , 'profile')
                    ->with('subPage' , 'user-wishlist')
                    ->with('videos' , $videos);

    }

    public function add_comment(Request $request) {

        $request->request->add([ 
            'id' => \Auth::user()->id,
            'token' => \Auth::user()->token,
            'device_token' => \Auth::user()->device_token
        ]);

        $response = $this->UserAPI->user_rating($request)->getData();

        if($response->success) {
            $response->message = Helper::get_message(118);
        } else {
            $response->success = false;
            $response->message = "Something Went Wrong";
        }

        return response()->json($response);
    
    }

    public function comments(Request $request) {

        $videos = Helper::get_user_comments(\Auth::user()->id,WEB);

        return view('user.comments')
                    ->with('page' , 'profile')
                    ->with('subPage' , 'user-comments')
                    ->with('videos' , $videos);
    }

    public function all_categories(Request $request) {

        $categories = get_categories();

        $recent_videos = Helper::recently_added(WEB);

        $trendings = Helper::trending(WEB);

        $suggestions = Helper::suggestion_videos(WEB);

        return view('user.all-categories')
                    ->with('page' , 'categories')
                    ->with('subPage' , 'categories')
                    ->with('categories' , $categories)
                    ->with('trendings' , $trendings)
                    ->with('suggestions' , $suggestions)
                    ->with('recent_videos' , $recent_videos);
    }


    public function category_videos($id) {

        $sub_categories = get_sub_categories($id);

        $videos = Helper::category_videos($id,WEB);

        $trendings = Helper::trending(WEB);

        $suggestions = Helper::suggestion_videos(WEB);

        $categories = get_categories();

        $category = Category::find($id);

        return view('user.category-videos')
                    ->with('page' , 'categories')
                    ->with('subPage' , 'categories')
                    ->with('category' , $category)
                    ->with('categories' , $categories)
                    ->with('sub_categories' , $sub_categories)
                    ->with('trendings' , $trendings)
                    ->with('suggestions' , $suggestions)
                    ->with('videos' , $videos);
    }

    public function sub_category_videos($id) {

        $videos = Helper::sub_category_videos($id,WEB);

        $trendings = Helper::trending(WEB);

        $suggestions = Helper::suggestion_videos(WEB);

        $sub_category = get_sub_category_details($id);

        $genres = get_genres($id);

        return view('user.sub_categories')
                    ->with('page' , 'categories')
                    ->with('subPage' , 'categories')
                    ->with('videos' , $videos)
                    ->with('trendings' , $trendings)
                    ->with('genres' , $genres)
                    ->with('sub_category' , $sub_category)
                    ->with('suggestions' , $suggestions);
    } 

    public function genre_videos($id) {

        $videos = Helper::genre_videos($id,WEB);

        $trendings = Helper::trending(WEB);

        $suggestions = Helper::suggestion_videos(WEB);

        $genre = get_genre_details($id);

        return view('user.genres')
                    ->with('page' , 'categories')
                    ->with('subPage' , 'categories')
                    ->with('videos' , $videos)
                    ->with('trendings' , $trendings)
                    ->with('genre' , $genre)
                    ->with('suggestions' , $suggestions);
    }

    public function about(Request $request) {

        $about = Page::where('type', 'about')->first();

        return view('about')->with('about' , $about)
                        ->with('page' , 'about')
                        ->with('subPage' , '');

    }

    public function contact(Request $request) {

        $contact = Page::where('type', 'contact')->first();

        return view('contact')->with('contact' , $contact)
                        ->with('page' , 'contact')
                        ->with('subPage' , '');

    }

    public function trending()
    {
        $trending = Helper::trending(1);
        $categories = get_categories();

        return view('user.trending')->with('page', 'trending')
                                    ->with('videos',$trending)
                                    ->with('categories', $categories);
    }

    public function delete_account(Request $request) {

        if(\Auth::user()->login_by == 'manual') {

            return view('user.delete-account')
                    ->with('page' , 'profile')
                    ->with('subPage' , 'delete-account');
        } else {

            $request->request->add([ 
                'id' => \Auth::user()->id,
                'token' => \Auth::user()->token,
                'device_token' => \Auth::user()->device_token
            ]);

            $response = $this->UserAPI->delete_account($request)->getData();

            if($response->success) {
                return back()->with('flash_success', tr('user_account_delete_success'));
            } else {
                if($response->error == 101)
                    return back()->with('flash_error', $response->error_messages);
                else
                    return back()->with('flash_error', $response->error);
            }

            return back()->with('flash_error', Helper::get_error_message(146));

        }
        
    }

    public function delete_account_process(Request $request) {

        $request->request->add([ 
            'id' => \Auth::user()->id,
            'token' => \Auth::user()->token,
            'device_token' => \Auth::user()->device_token
        ]);

        $response = $this->UserAPI->delete_account($request)->getData();

        if($response->success) {
            return back()->with('flash_success', tr('user_account_delete_success'));
        } else {
            if($response->error == 101)
                return back()->with('flash_error', $response->error_messages);
            else
                return back()->with('flash_error', $response->error);
        }

        return back()->with('flash_error', Helper::get_error_message(146));

    }
}