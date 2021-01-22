<?php

use App\Helpers\Helper;

use App\Helpers\EnvEditorHelper;

use Carbon\Carbon;

use App\SubCategoryImage;

use App\AdminVideoImage;

use App\Category;

use App\SubCategory;

use App\Genre;

use App\Wishlist;

use App\AdminVideo;

use App\UserHistory;

use App\UserRating;

use App\User;

use App\Settings;

use App\Page;

function tr($key) {

    if (!\Session::has('locale'))
        \Session::put('locale', \Config::get('app.locale'));
    return \Lang::choice('messages.'.$key, 0, Array(), \Session::get('locale'));

}

function sub_category_image($picture , $sub_category_id,$position) {

    $image = new SubCategoryImage;

    $check_image = SubCategoryImage::where('sub_category_id' , $sub_category_id)->where('position' , $position)->first();


    if($check_image) {

        if ($check_image->picture) {

            Helper::delete_picture($check_image->picture);

        }

        $image = $check_image;
    }

    $image->sub_category_id = $sub_category_id;
    $url = Helper::normal_upload_picture($picture);
    $image->picture = $url ? $url : asset('admin-css/img/dummy.jpeg');
    $image->position = $position;
    $image->save();

    return true;
}
function get_sub_category_image($sub_category_id) {

    $images = SubCategoryImage::where('sub_category_id' , $sub_category_id)
                    ->orderBy('position' , 'ASC')
                    ->get();

    return $images;

}

function get_categories() {

    $categories = Category::where('categories.is_approved' , 1)
                        ->select('categories.id as id' , 'categories.name' , 'categories.picture' ,
                            'categories.is_series' ,'categories.status' , 'categories.is_approved')
                        ->leftJoin('admin_videos' , 'categories.id' , '=' , 'admin_videos.category_id')
                        ->where('admin_videos.status' , 1)
                        ->where('admin_videos.is_approved' , 1)
                        ->groupBy('admin_videos.category_id')
                        ->havingRaw("COUNT(admin_videos.id) > 0")
                        ->orderBy('name' , 'ASC')
                        ->get();
    return $categories;
}

function get_sub_categories($category_id) {

    $sub_categories = SubCategory::where('sub_categories.category_id' , $category_id)
                        ->select('sub_categories.id as id' , 'sub_categories.name' ,
                            'sub_categories.status' , 'sub_categories.is_approved')
                        ->leftJoin('admin_videos' , 'sub_categories.id' , '=' , 'admin_videos.sub_category_id')
                        ->groupBy('admin_videos.sub_category_id')
                        ->havingRaw("COUNT(admin_videos.id) > 0")
                        ->where('sub_categories.is_approved' , 1)
                        ->orderBy('sub_categories.name' , 'ASC')
                        ->get();
    return $sub_categories;
}

function get_category_video_count($category_id) {

    $count = AdminVideo::where('category_id' , $category_id)
                    ->where('is_approved' , 1)
                    ->where('admin_videos.status' , 1)
                    ->count();

    return $count;
}

function active_categories_count() {


    $count = Category::where('is_approved', 1)->count();

    return $count;

}

function get_video_fav_count($video_id) {

    $count = Wishlist::where('admin_video_id' , $video_id)
                ->leftJoin('admin_videos' ,'wishlists.admin_video_id' , '=' , 'admin_videos.id')
                ->where('admin_videos.is_approved' , 1)
                ->where('admin_videos.status' , 1)
                ->count();

    return $count;
}

function get_user_history_count($user_id) {
    $count = UserHistory::where('user_id' , $user_id)
                ->leftJoin('admin_videos' ,'user_histories.admin_video_id' , '=' , 'admin_videos.id')
                ->where('admin_videos.is_approved' , 1)
                ->where('admin_videos.status' , 1)
                ->count();

    return $count;
}

function get_user_wishlist_count($user_id) {

    $count = Wishlist::where('user_id' , $user_id)
                ->leftJoin('admin_videos' ,'wishlists.admin_video_id' , '=' , 'admin_videos.id')
                ->where('admin_videos.is_approved' , 1)
                ->where('admin_videos.status' , 1)
                ->count();

    return $count;
}

function get_user_comment_count($user_id) {

    $count = UserRating::where('user_id' , $user_id)
                ->leftJoin('admin_videos' ,'user_ratings.admin_video_id' , '=' , 'admin_videos.id')
                ->where('admin_videos.is_approved' , 1)
                ->where('admin_videos.status' , 1)
                ->count();

    return $count;

}

function get_video_comment_count($video_id) {

    $count = UserRating::where('admin_video_id' , $video_id)
                ->leftJoin('admin_videos' ,'user_ratings.admin_video_id' , '=' , 'admin_videos.id')
                ->where('admin_videos.is_approved' , 1)
                ->where('admin_videos.status' , 1)
                ->count();

    return $count;

}

function total_video_count() {
    
    $count = AdminVideo::where('is_approved' , 1)->where('admin_videos.status' , 1)->count();

    return $count;

}

function get_sub_category_video_count($id) {
    
    $count = AdminVideo::where('sub_category_id' , $id)->where('admin_videos.status' , 1)->where('is_approved' , 1)->count();

    return $count;
}
function get_genre_video_count($id) {
    
    $count = AdminVideo::where('genre_id' , $id)->where('admin_videos.status' , 1)->where('is_approved' , 1)->count();

    return $count;
}

function get_sub_category_details($id) {

    $sub_category = SubCategory::where('id' , $id)->first();

    return $sub_category;
}

function get_genre_details($id) {

    $genre = Genre::where('id' , $id)->first();

    return $genre;
}

function get_genres($id) {

    $genres = Genre::where('sub_category_id' , $id)->where('is_approved'  , 1)->get();

    return $genres;
}

function get_youtube_embed_link($video_url) {

    if(strpos($video_url , 'embed')) {
       return $video_url;
    }

    $video_url_id = substr($video_url, strpos($video_url, "=") + 1);

    $youtube_embed = "https://www.youtube.com/embed/" . $video_url_id;

    return $youtube_embed;

}

function category_video_count($category_id)
{
    $category_video_count = AdminVideo::where('category_id',$category_id)->where('is_approved' , 1)->count();
    return $category_video_count;
}


function get_video_end($video_url) {
    $url = explode('/',$video_url);
    $result = end($url);

    return $result;
}

function get_video_image($video_id)
{
    $video_image = AdminVideoImage::where('admin_video_id',$video_id)->orderBy('position','ASC')->get();
    return $video_image;
}

function wishlist($user_id) {

    $videos = Wishlist::where('user_id' , $user_id)
                    ->leftJoin('admin_videos' ,'wishlists.admin_video_id' , '=' , 'admin_videos.id')
                    ->leftJoin('categories' ,'admin_videos.category_id' , '=' , 'categories.id')
                    ->where('admin_videos.is_approved' , 1)
                    ->select(
                            'wishlists.id as wishlist_id',
                            'admin_videos.id as admin_video_id' ,
                            'admin_videos.title','admin_videos.description' ,
                            'default_image','admin_videos.watch_count',
                            'admin_videos.default_image',
                            'admin_videos.ratings',
                            'admin_videos.duration',
                            DB::raw('DATE_FORMAT(admin_videos.publish_time , "%e %b %y") as publish_time') , 'categories.name as category_name')
                    ->orderby('wishlists.created_at' , 'desc')
                    ->skip(0)->take(10)
                    ->get();

    if(!$videos) {
        $videos = array();
    }

    return $videos;
}

function trending() {

    $videos = AdminVideo::where('watch_count' , '>' , 0)
                    ->select(
                        'admin_videos.id as admin_video_id' , 
                        'admin_videos.title',
                        'admin_videos.description',
                        'default_image','admin_videos.watch_count' , 
                        'admin_videos.publish_time',
                        'admin_videos.default_image',
                        'admin_videos.ratings',
                        'admin_videos.status',
                        'admin_videos.is_approved'
                        )
                    ->where('admin_videos.status', 1)
                    ->where('admin_videos.is_approved', 1)
                    ->orderby('watch_count' , 'desc')
                    ->skip(0)->take(10)
                    ->get();


    return $videos;
}

function sub_category_videos($sub_category_id) 
{

    $videos = AdminVideo::where('admin_videos.is_approved' , 1)
                ->leftJoin('categories' , 'admin_videos.category_id' , '=' , 'categories.id')
                ->leftJoin('sub_categories' , 'admin_videos.sub_category_id' , '=' , 'sub_categories.id')
                ->where('admin_videos.sub_category_id' , $sub_category_id)
                ->select(
                    'admin_videos.id as admin_video_id' , 
                    'admin_videos.default_image' , 
                    'admin_videos.ratings' , 
                    'admin_videos.watch_count' , 
                    'admin_videos.title' ,
                    'admin_videos.description',
                    'admin_videos.sub_category_id' , 
                    'admin_videos.category_id',
                    'categories.name as category_name',
                    'sub_categories.name as sub_category_name',
                    'admin_videos.duration',
                    DB::raw('DATE_FORMAT(admin_videos.publish_time , "%e %b %y") as publish_time')
                    )
                ->orderby('admin_videos.sub_category_id' , 'asc')
                ->get();

    if(!$videos) {
        $videos = array();
    }

    return $videos;
} 

function change_theme() {
    return array();
}


function get_recent_users() {
    $users = User::orderBy('created_at' , 'desc')->skip(0)->take(12)->get();

    return $users;
}
function get_recent_videos() {
    $videos = AdminVideo::orderBy('publish_time' , 'desc')->skip(0)->take(12)->get();

    return $videos;
}

function check_s3_configure() {

    $key = config('filesystems.disks.s3.key');

    $secret = config('filesystems.disks.s3.secret');

    $bucket = config('filesystems.disks.s3.bucket');

    $region = config('filesystems.disks.s3.region');

    if($key && $secret && $bucket && $region) {
        return 1;
    } else {
        return false;
    }
}

function get_slider_video() {
    return AdminVideo::where('is_home_slider' , 1)
            ->select('admin_videos.id as admin_video_id' , 'admin_videos.default_image',
                'admin_videos.title','admin_videos.trailer_video', 'admin_videos.video_type','admin_videos.video_upload_type')
            ->first();
}

function check_valid_url($file) {

    $video = get_video_end($file);

    // if(file_exists(public_path('uploads/'.$video))) {
        return 1;
    // } else {
    //     return 0;
    // }

}

function check_nginx_configure() {

    $nginx = shell_exec('nginx -V');

    if($nginx) {
        return true;
    } else {
        if(file_exists("/usr/local/nginx-streaming/conf/nginx.conf")) {
            return true;
        } else {
           return false; 
        }
        
    }
    // return file_exists('/usr/local/nginx-streaming/conf/nginx.conf');
}

function check_php_configure() {
    return phpversion();
}

function check_mysql_configure() {

    $output = shell_exec('mysql -V');

    $data = 1;

    if($output) {
        preg_match('@[0-9]+\.[0-9]+\.[0-9]+@', $output, $version); 
        // $data = $version[0];
    }

    return $data; 
}

function check_database_configure() {

    $status = 0;

    $database = config('database.connections.mysql.database');
    $username = config('database.connections.mysql.username');

    if($database && $username) {
        $status = 1;
    }
    return $status;

}

function check_settings_seeder() {
    return Settings::count();
}

function delete_install() {
    $controller = base_path('app/Http/Controllers/InstallationController.php');

    $public = base_path('public/install');
    
    $views = base_path('resources/views/install');

    if(is_dir($public)) {
        rmdir($public);
    }

    if(is_dir($views)) {
        rmdir($views);
    }

    if(file_exists($controller)) {
        unlink($controller);
    } 

    return true;
}

function get_banner_count() {
    return AdminVideo::where('is_banner' , 1)->count();
}

function get_expiry_days($id) {

    $days = 0;
    
    return $days;
}

function all_videos($web = NULL , $skip = 0) 
{

    $videos_query = AdminVideo::where('admin_videos.is_approved' , 1)
                ->where('admin_videos.status' , 1)
                ->leftJoin('categories' , 'admin_videos.category_id' , '=' , 'categories.id')
                ->leftJoin('sub_categories' , 'admin_videos.sub_category_id' , '=' , 'sub_categories.id')
                ->select(
                    'admin_videos.id as admin_video_id' , 
                    'admin_videos.default_image' , 
                    'admin_videos.ratings' , 
                    'admin_videos.watch_count' , 
                    'admin_videos.title' ,
                    'admin_videos.description',
                    'admin_videos.sub_category_id' , 
                    'admin_videos.category_id',
                    'categories.name as category_name',
                    'sub_categories.name as sub_category_name',
                    'admin_videos.duration',
                    DB::raw('DATE_FORMAT(admin_videos.publish_time , "%e %b %y") as publish_time')
                    )
                ->orderby('admin_videos.created_at' , 'desc');

    if($web) {
        $videos = $videos_query->paginate(20);
    } else {
        $videos = $videos_query->skip($skip)->take(20)->get();
    }

    return $videos;
}

function get_trending_count() {

    $data = AdminVideo::where('watch_count' , '>' , 0)
                    ->where('admin_videos.is_approved' , 1)
                    ->where('admin_videos.status' , 1)
                    ->skip(0)->take(20)
                    ->count();

    return $data;

}

function get_wishlist_count($id) {
    
    $data = Wishlist::where('user_id' , $id)
                ->leftJoin('admin_videos' ,'wishlists.admin_video_id' , '=' , 'admin_videos.id')
                ->where('admin_videos.is_approved' , 1)
                ->where('admin_videos.status' , 1)
                ->where('wishlists.status' , 1)
                ->count();

    return $data;

}

function get_suggestion_count($id) {

    $data = Wishlist::where('user_id' , $id)
                ->leftJoin('admin_videos' ,'wishlists.admin_video_id' , '=' , 'admin_videos.id')
                ->where('admin_videos.is_approved' , 1)
                ->where('admin_videos.status' , 1)
                ->where('wishlists.status' , 1)
                ->count();

    return $data;

}

function get_recent_count($id) {

    $data = Wishlist::where('user_id' , $id)
                ->leftJoin('admin_videos' ,'wishlists.admin_video_id' , '=' , 'admin_videos.id')
                ->where('admin_videos.is_approved' , 1)
                ->where('admin_videos.status' , 1)
                ->where('wishlists.status' , 1)
                ->count();

    return $data;

}

function get_history_count($id) {

    $data = UserHistory::where('user_id' , $id)
                ->leftJoin('admin_videos' ,'user_histories.admin_video_id' , '=' , 'admin_videos.id')
                ->where('admin_videos.is_approved' , 1)
                ->where('admin_videos.status' , 1)
                ->count();

    return $data;

}

function envfile($key) {

    $data = EnvEditorHelper::getEnvValues();

    if($data) {
        return $data[$key];
    }

    return "";
}



//this function converts string from UTC time zone to current user timezone

function convertTimeToUSERzone($str, $userTimezone, $format = 'Y-m-d H:i:s') {

    if(empty($str)){
        return '';
    }
    try{
        $new_str = new DateTime($str, new DateTimeZone('UTC') );
        $new_str->setTimeZone(new DateTimeZone( $userTimezone ));
    }
    catch(\Exception $e) {
        // Do Nothing
    }
    
    return $new_str->format( $format);
}



function convertToBytes($from){
    $number=substr($from,0,-2);
    switch(strtoupper(substr($from,-2))){
        case "KB":
            return $number*1024;
        case "MB":
            return $number*pow(1024,2);
        case "GB":
            return $number*pow(1024,3);
        case "TB":
            return $number*pow(1024,4);
        case "PB":
            return $number*pow(1024,5);
        default:
            return $from;
    }
}

function checkSize() {

    $php_ini_upload_size = convertToBytes(ini_get('upload_max_filesize')."B");

    $php_ini_post_size = convertToBytes(ini_get('post_max_size')."B");

    $setting_upload_size = convertToBytes(Setting::get('upload_max_size')."B");

    $setting_post_size = convertToBytes(Setting::get('post_max_size')."B");

    if(($php_ini_upload_size < $setting_upload_size) || ($php_ini_post_size < $setting_post_size)) {

        return true;

    }

    return false;
}

function pages() {

    $model = Page::get();

    return $model;

}