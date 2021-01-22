@extends('layouts.admin')

@section('title', tr('settings'))

@section('content-header', tr('settings'))

@section('breadcrumb')
    <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>{{tr('home')}}</a></li>
    <li class="active"><i class="fa fa-gears"></i> {{tr('settings')}}</li>
@endsection

@section('content')

@include('notification.notify')

    <div class="row">

        <div class="col-md-6">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">{{tr('site_settings')}}</h3>
                </div>

                <form action="{{route('admin.save.settings')}}" method="POST" enctype="multipart/form-data" role="form">

                    <div class="box-body">
                        <div class="form-group">
                            <label for="sitename">{{tr('site_name')}}</label>
                            <input type="text" class="form-control" name="site_name" value="{{ Setting::get('site_name')  }}" id="sitename" placeholder="Enter sitename">
                        </div>

                        <!-- <div class="form-group">
                            <label for="tagname">{{tr('tag_name')}}</label>
                            <input type="text" class="form-control" name="tag_name" value="{{Setting::get('tag_name')  }}" id="tagname" placeholder="Tag Name">
                        </div> -->

                        <div class="form-group">
                            @if(Setting::get('site_logo'))
                                <img style="height: 50px; width:75px;margin-bottom: 15px; border-radius:2em;" src="{{Setting::get('site_logo')}}">
                            @endif

                            <label for="site_logo">{{tr('site_logo')}}</label>
                            <input type="file" id="site_logo" name="site_logo" accept="image/png,image/jpeg">
                            <p class="help-block">Please enter .png images only.</p>
                        </div>


                        <div class="form-group">
                            @if(Setting::get('site_icon'))
                                <img style="height: 50px; width:75px; margin-bottom: 15px; border-radius:2em;" src="{{Setting::get('site_icon')}}">
                            @endif
                            <label for="site_icon">{{tr('site_icon')}}</label>
                            <input type="file" id="site_icon" name="site_icon" accept="image/png,image/jpeg">
                            <p class="help-block">Please enter .png images only.</p>
                        </div>

                  </div>
                  <!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">{{tr('submit')}}</button>
                  </div>
                </form>

            </div>
        </div>

        <div class="col-md-6" >
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">{{tr('other_settings')}}</h3>
                </div>

                <form action="{{route('admin.save.settings')}}" method="POST" enctype="multipart/form-data" role="form">
                    <div class="box-body">

                        <!-- <div class="form-group">
                            <label for="streaming_url">{{tr('streaming_url')}}</label>
                            <input type="text" value="{{ Setting::get('streaming_url')}}" class="form-control" name="streaming_url" id="streaming_url" placeholder="Enter Streaming URL">
                        </div>  -->

                        <div class="form-group">
                            <label for="google_analytics">{{tr('google_analytics')}}</label>
                            <textarea class="form-control" id="google_analytics" name="google_analytics">{{Setting::get('google_analytics')}}</textarea>
                        </div>  

                        <div class="form-group">
                            <label for="google_analytics">{{tr('header_scripts')}}</label>
                            <textarea class="form-control" id="header_scripts" name="header_scripts">{{Setting::get('header_scripts')}}</textarea>
                        </div>  


                        <div class="form-group">
                            <label for="google_analytics">{{tr('body_scripts')}}</label>
                            <textarea class="form-control" id="body_scripts" name="body_scripts">{{Setting::get('body_scripts')}}</textarea>
                        </div>  


                        <!-- <div class="col-md-3">
                            <div class="form-group">
                                <label for="upload_max_size">{{tr('max_upload_size_label')}}</label>
                                <input type="text" class="form-control" name="upload_max_size" value="{{Setting::get('upload_max_size')  }}" id="upload_max_size" placeholder="{{tr('max_upload_size_label')}}">
                            </div>
                        </div> -->

                        
                                     

                  </div>
                  <!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">{{tr('submit')}}</button>
                  </div>
                </form>

            </div>
        </div>
    
    </div>


@endsection