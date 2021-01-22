<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->delete();
    	DB::table('settings')->insert([
    		[
		        'key' => 'site_name',
		        'value' => 'StreamHash'
		    ],
		    [
		        'key' => 'site_logo',
		        'value' => ''
		    ],
		    [
		        'key' => 'site_icon',
		        'value' => ''
		    ],
		    [
		        'key' => 'tag_name',
		        'value' => ''
		    ],
		    [
		        'key' => 'paypal_email',
		        'value' => ''
		    ],
		    [
		        'key' => 'browser_key',
		        'value' => ''
		    ],
		    [
		        'key' => 'default_lang',
		        'value' => 'en'
		    ], 
		    [
		        'key' => 'currency',
		        'value' => '$'
		    ],
		    [
        		'key' => 'streaming_url',
        		'value' => ''
        	],
		    [
        		'key' => 'admin_take_count',
        		'value' => 12
        	],
        	[
		        'key' => 'installation_process',
		        'value' => 0
		    ],
        	[
        		'key' => 'admin_delete_control',
        		'value' => 0
        	],
        	[
        		'key' => 'JWPLAYER_KEY',
        		'value' => "M2NCefPoiiKsaVB8nTttvMBxfb1J3Xl7PDXSaw=="
        	],
        	[
        		'key' => 'HLS_STREAMING_URL',
        		'value' => ""
        	],
        	[
        		'key' => 'header_scripts',
        		'value' => ""
        	],
        	[
        		'key' => 'body_scripts',
        		'value' => ''
        	],
            [
                'key' => 'demo_admin_email',
                'value' => "admin@streamhash.com"
            ],
            [
                'key' => 'demo_admin_password',
                'value' => '123456'
            ],
            [
                'key' => 'copyrights_url',
                'value' => ''
            ]

		]);
    }
}
