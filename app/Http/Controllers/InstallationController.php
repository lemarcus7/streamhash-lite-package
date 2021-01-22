<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Setting;

use App\Settings;

use App\Helpers\Helper;

define('NO_INSTALL' , 0);

define('SYSTEM_CHECK' , 1);

define('THEME_CHECK' , 2);

define('INSTALL_COMPLETE' , 3);

class InstallationController extends Controller {

    public function install() {

        $settings = Setting::get('installation_process');

        if( $settings == NO_INSTALL) {
            $title = "System Check";
            return view('install.system-check')->with('title' , $title)->with('page' , 'system_check');
        } 

        /*** Theme Install Page */

        if($settings == THEME_CHECK ) {
            $title = "Configure Site Settings";

            return view('install.install-others')->with('title' , $title)->with('page' , 'other_install');
        }

        if($settings == INSTALL_COMPLETE) {

            if(session('check_streaming_url')) {

                $check_streaming_url = session('check_streaming_url');

                \Session::forget('check_streaming_url');

                return redirect()->route('admin.login')->with('flash_success' , "Installation Process is done")
                                    ->with('flash_error' , $check_streaming_url);

            } else {
                return redirect()->route('admin.login')->with('flash_success' , "Installation Process is done");
            }  
        }
        
        return redirect()->route('admin.login')->with('flash_success' , "Installation Process is done"); 
    
    }

    public function system_check_process() {

    	$Settings = Settings::where('key' , 'installation_process')->first();

    	if($Settings) {
    		$Settings->value = THEME_CHECK;
    		$Settings->save();
    	}

    	if($Settings) {
    		return redirect()->route('installTheme');	
    	} else {
            return back();
        }
    }

    public function settings_process(Request $request) {
    	
    	$Settings = Settings::where('key' , 'installation_process')->first();

    	if($Settings) {
    		$Settings->value = INSTALL_COMPLETE;
    		$Settings->save();
    	}

        $settings = Settings::all();

        foreach ($settings as $setting) {

            $key = $setting->key;
           
            $temp_setting = Settings::find($setting->id);

                if($temp_setting->key == 'site_icon'){
                    $site_icon = $request->file('site_icon');
                    if($site_icon == null) {
                        $icon = $temp_setting->value;
                    } else {

                        if($temp_setting->value) {
                            Helper::delete_picture($temp_setting->value);
                        }

                        $icon = Helper::normal_upload_picture($site_icon);
                    }

                    $temp_setting->value = $icon;
                    
                } else if($temp_setting->key == 'site_logo'){
                    $picture = $request->file('site_logo');
                    if($picture == null){
                        $logo = $temp_setting->value;
                    } else {
                        if($temp_setting->value) {
                            Helper::delete_picture($temp_setting->value);
                        }
                        $logo = Helper::normal_upload_picture($picture);
                    }

                    $temp_setting->value = $logo;

                } else if($request->$key!='') { 

                    if($temp_setting->key == 'streaming_url'){
                        if(check_nginx_configure()) {
                            $temp_setting->value = $request->$key;
                        } else {
                            session(['check_streaming_url' => 'Please Configure the nginx Streaming Server.']);
                        }
                    
                    } else {
                        $temp_setting->value = $request->$key;
                    }
                }
            $temp_setting->save();
        }
        // Delete the installation related folders
        // delete_install();
        return redirect()->route('installTheme');
    
    }
}
