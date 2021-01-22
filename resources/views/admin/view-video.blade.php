@extends('layouts.admin')

@section('title', tr('view_video'))

@section('content-header', tr('view_video'))

@section('breadcrumb')
    <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>{{tr('home')}}</a></li>
    <li><a href="{{route('admin.videos')}}"><i class="fa fa-video-camera"></i> {{tr('videos')}}</a></li>
    <li class="active">{{tr('video')}}</li>
@endsection 

@section('content')

    @include('notification.notify')

    <div class="row">

        <div class="col-lg-7">

            <div class="box box-widget">

                <div class="box-header with-border">
                    <div class="user-block">
                        <span style="margin-left:0px" class="username"><a href="#">{{$video->title}}</a></span>
                        <span style="margin-left:0px" class="description">Created Time - {{$video->video_date}}</span>
                    </div>
                    
                    
                    <div class="box-tools">
                        <button data-widget="collapse" class="btn btn-box-tool" type="button">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>

                </div>

                <div class="box-body">

                    <div id="main-video-player"></div>

                    <div class="embed-responsive embed-responsive-16by9" id="flash_error_display_main" style="display: none;">
                       <div style="width: 100%;background: black; color:#fff;height:350px;">
                             <div style="text-align: center;padding-top:25%">Flash is missing. Download it from <a target="_blank" href="http://get.adobe.com/flashplayer/" class="underline">Adobe</a>.</div>
                       </div>
                    </div>
                    <div class="image" id="main_video_setup_error" style="display:none">
                        <img src="{{asset('error.jpg')}}" alt="{{Setting::get('site_name')}}" style="width: 100%">
                    </div>
                       
                    <h4 style="font-weight:800;color:#3c8dbc">{{tr('description')}}</h4>

                    <p style="margin-top:10px;border-bottom: 1px solid #f4f4f4;padding-bottom: 10px;">{{$video->description}}</p>

                    <h4 style="font-weight:800;color:#3c8dbc">{{tr('ratings')}}</h4>

                    <span class="starRating-view">
                        <input id="rating5" type="radio" name="ratings" value="5" @if($video->ratings == 5) checked @endif>
                        <label for="rating5">5</label>

                        <input id="rating4" type="radio" name="ratings" value="4" @if($video->ratings == 4) checked @endif>
                        <label for="rating4">4</label>

                        <input id="rating3" type="radio" name="ratings" value="3" @if($video->ratings == 3) checked @endif>
                        <label for="rating3">3</label>

                        <input id="rating2" type="radio" name="ratings" value="2" @if($video->ratings == 2) checked @endif>
                        <label for="rating2">2</label>

                        <input id="rating1" type="radio" name="ratings" value="1" @if($video->ratings == 1) checked @endif>
                        <label for="rating1">1</label>
                    </span>
                    
                    <h4 style="font-weight:800;color:#3c8dbc">{{tr('reviews')}}</h4>

                    <p style="">{{$video->reviews}}</p>
                
                </div>

            </div>

            @if($video->banner_image)

                <div class="box box-widget">

                    <div class="box-header with-border">
                        <div class="user-block">
                            <span style="margin-left:0px" class="username"><a href="#">{{tr('banner_image')}}</a></span>
                        </div>

                        <div class="box-tools">

                            <button data-widget="collapse" class="btn btn-box-tool" type="button">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>

                    </div>

                    <div class="box-body">
                        <img alt="Photo" src="{{$video->banner_image}}" style="width:100%;height:150px;">
                    </div>
                </div>

            @endif

        </div>

        <div class="col-lg-5">

            <div class="box box-widget">

                <div class="box-header with-border">
                    <div class="user-block">
                        <span style="margin-left:0px" class="username"><a href="#">{{tr('trailer_video')}}</a></span>
                    </div>

                    <div class="box-tools">

                        <button data-widget="collapse" class="btn btn-box-tool" type="button">
                            <i class="fa fa-minus"></i>
                        </button>

                    </div>

                </div>

                <div class="box-body">

                    <div id="trailer-video-player"></div>

                     <div class="embed-responsive embed-responsive-16by9" id="flash_error_display_trailer" style="display: none;">
                       <div style="width: 100%;background: black; color:#fff;height:350px;">
                             <div style="text-align: center;padding-top:25%">Flash is missing. Download it from <a target="_blank" href="http://get.adobe.com/flashplayer/" class="underline">Adobe</a>.</div>
                       </div>
                    </div>

                     <div class="image" id="trailer_video_setup_error" style="display:none">
                        <img src="{{asset('error.jpg')}}" alt="{{Setting::get('site_name')}}" style="width: 100%">
                    </div>

                </div>

            </div>

            @if($video->default_image)

                <div class="box box-widget">

                    <div class="box-header with-border">
                        <div class="user-block">
                            <span style="margin-left:0px" class="username"><a href="#">{{tr('default_image')}}</a></span>
                        </div>

                        <div class="box-tools">

                            <button data-widget="collapse" class="btn btn-box-tool" type="button">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>

                    </div>

                    <div class="box-body">
                        <img alt="Photo" src="{{$video->default_image}}" style="width:100%;height:150px;">
                    </div>
                </div>

            @endif


            @if(count($video_images) > 0)
                
                @foreach($video_images as $i => $image)
                    
                    <div class="box box-widget">

                        <div class="box-header with-border">
                            <div class="user-block">
                                <span style="margin-left:0px" class="username"><a href="#">Image {{$image->position}}</a></span>
                            </div>

                            <div class="box-tools">

                                <!-- <button title="Mark as read" data-toggle="tooltip" class="btn btn-box-tool" type="button">
                                    <i class="fa fa-circle-o"></i>
                                </button> -->

                                <button data-widget="collapse" class="btn btn-box-tool" type="button">
                                    <i class="fa fa-minus"></i>
                                </button>

                                <!-- <button data-widget="remove" class="btn btn-box-tool" type="button">
                                    <i class="fa fa-times"></i>
                                </button> -->
                            </div>

                        </div>

                        <div class="box-body">
                            <img alt="Photo" src="{{$image->image}}" style="width:100%;height:150px;">
                        </div>
                    </div>

                @endforeach

            @endif

        </div>


    </div>

@endsection

@section('scripts')
    
     <script src="{{asset('jwplayer/jwplayer.js')}}"></script>
     
    <script>jwplayer.key="{{Setting::get('JWPLAYER_KEY')}}";</script>

    <script type="text/javascript">
        
        jQuery(document).ready(function(){

            @if($video->video_type == 1)

                @if($main_video)

                    var playerInstance = jwplayer("main-video-player");

                    playerInstance.setup({
                       
                        file: "{{$main_video}}",
                        image: "{{$video->default_image}}",
                        width: "100%",
                        aspectratio: "16:9",
                        primary: "flash",
                        controls : true,
                        "controlbar.idlehide" : false,
                        controlBarMode:'floating',
                        "controls": {
                          "enableFullscreen": false,
                          "enablePlay": false,
                          "enablePause": false,
                          "enableMute": true,
                          "enableVolume": true
                        },
                        // autostart : true,
                        "sharing": {
                            "sites": ["reddit","facebook","twitter"]
                          }
                    });

                    playerInstance.on('setupError', function() {

                        jQuery("#main-video-player").css("display", "none");
                       // jQuery('#trailer_video_setup_error').hide();
                       

                        var hasFlash = false;
                        try {
                            var fo = new ActiveXObject('ShockwaveFlash.ShockwaveFlash');
                            if (fo) {
                                hasFlash = true;
                            }
                        } catch (e) {
                            if (navigator.mimeTypes
                                    && navigator.mimeTypes['application/x-shockwave-flash'] != undefined
                                    && navigator.mimeTypes['application/x-shockwave-flash'].enabledPlugin) {
                                hasFlash = true;
                            }
                        }

                        if (hasFlash == false) {
                            jQuery('#flash_error_display_main').show();
                            return false;
                        }

                        jQuery('#main_video_setup_error').css("display", "block");

                        confirm('The video format is not supported in this browser. Please option some other browser.');
                    
                    });

                @endif

                @if($trailer_video)

                    var playerInstance = jwplayer("trailer-video-player");

                    playerInstance.setup({
                        file: "{{$trailer_video}}",
                        image: "{{$video->default_image}}",
                        width: "100%",
                        aspectratio: "16:9",
                        primary: "flash",
                    });

                    playerInstance.on('setupError', function() {

                        jQuery("#trailer-video-player").css("display", "none");
                       // jQuery('#trailer_video_setup_error').hide();
                       

                        var hasFlash = false;
                        try {
                            var fo = new ActiveXObject('ShockwaveFlash.ShockwaveFlash');
                            if (fo) {
                                hasFlash = true;
                            }
                        } catch (e) {
                            if (navigator.mimeTypes
                                    && navigator.mimeTypes['application/x-shockwave-flash'] != undefined
                                    && navigator.mimeTypes['application/x-shockwave-flash'].enabledPlugin) {
                                hasFlash = true;
                            }
                        }

                        if (hasFlash == false) {
                            jQuery('#flash_error_display_trailer'   ).show();
                            return false;
                        }

                        jQuery('#trailer_video_setup_error').css("display", "block");

                        confirm('The video format is not supported in this browser. Please option some other browser.');
                    
                    });

                @endif

            @endif
        });

    </script>

@endsection

