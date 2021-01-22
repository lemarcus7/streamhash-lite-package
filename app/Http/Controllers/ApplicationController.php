<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Requests;

use App\Helpers\Helper;

use App\Category;

use App\SubCategory;

use App\SubCategoryImage;

use App\Genre;

use App\AdminVideo;

use App\User;

use Validator;

use Hash;

use Mail;

use Auth;

use Redirect;

use Setting;

use App\Admin;

use App\Page;

use Log;

use DB;

use Elasticsearch\ClientBuilder;

define('NO_INSTALL' , 0);

define('SYSTEM_CHECK' , 1);

define('THEME_CHECK' , 2);

define('INSTALL_COMPLETE' , 3);


class ApplicationController extends Controller {

    public $expiry_date = "";


    public function select_genre(Request $request) {
        
        $id = $request->option;

        $genres = Genre::where('sub_category_id', '=', $id)
                        ->where('is_approved' , 1)
                          ->orderBy('name', 'asc')
                          ->get();

        return response()->json($genres);
    }

    public function select_sub_category(Request $request) {
        
        $id = $request->option;

        $subcategories = Subcategory::where('category_id', '=', $id)
                        ->where('is_approved' , 1)
                          ->orderBy('name', 'asc')
                          ->get();

        return response()->json($subcategories);
    }

    public function cron_publish_video(Request $request) {
        
        Log::info('cron_publish_video');


        $admin = Admin::first();
        
        $timezone = 'Asia/Kolkata';

       if($admin) {

            if ($admin->timezone) {

                $timezone = $admin->timezone;

            } 

        }

        $date = convertTimeToUSERzone(date('Y-m-d H:i:s'), $timezone);

        $videos = AdminVideo::where('publish_time' ,'<=' ,$date)
                        ->where('status' , 0)->get();
        foreach ($videos as $key => $video) {
            Log::info('Change the status');
            $video->status = 1;
            $video->save();
        }
    }

    public function search_video(Request $request) {

        $validator = Validator::make(
            $request->all(),
            array(
                'term' => 'required',
            ),
            array(
                'exists' => 'The :attribute doesn\'t exists',
            )
        );
    
        if ($validator->fails()) {

            $error_messages = implode(',', $validator->messages()->all());
            $response_array = array('success' => false, 'error' => Helper::get_error_message(101), 'error_code' => 101, 'error_messages'=>$error_messages);

            return false;
        
        } else {

            $q = $request->term;

            \Session::set('user_search_key' , $q);

            $items = array();
            
            $results = Helper::search_video($q);

            if($results) {

                foreach ($results as $i => $key) {

                    $check = $i+1;

                    if($check <=10) {
     
                        array_push($items,$key->title);

                    } if($check == 10 ) {
                        array_push($items,"View All" );
                    }
                
                }

            }

            return response()->json($items);
        }     
    }

    public function search_all(Request $request) {

        $validator = Validator::make(
            $request->all(),
            array(
                'key' => '',
            ),
            array(
                'exists' => 'The :attribute doesn\'t exists',
            )
        );
    
        if ($validator->fails()) {

            $error_messages = implode(',', $validator->messages()->all());
            $response_array = array('success' => false, 'error' => Helper::get_error_message(101), 'error_code' => 101, 'error_messages'=>$error_messages);
        
        } else {

            if($request->has('key')) {
                $q = $request->key;    
            } else {
                $q = \Session::get('user_search_key');
            }

            if($q == "all") {
                $q = \Session::get('user_search_key');
            }

            $videos = Helper::search_video($q,1);

            return view('user.search-result')->with('key' , $q)->with('videos' , $videos)->with('page' , "")->with('subPage' , "");
        }     
    }


    public function get_page($type) {

        $model = Page::where('type', $type)->first();

        return view('user.static_page')->with('model', $model)->with('page', 'Page')->with('sub_page', '');

    }

}