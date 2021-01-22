@extends('layouts.admin')

@section('title', tr('dashboard'))

@section('content-header', tr('dashboard'))

@section('breadcrumb')
    <li class="active"><i class="fa fa-dashboard"></i> {{tr('dashboard')}}</a></li>
@endsection

<style type="text/css">
  .center-card{
    	width: 30% !important;
	}
  .small-box .icon {
    top: 0px !important;
  }
</style>

@section('content')

	<div class="row">

		<!-- Total Users -->

		<div class="col-lg-4 col-xs-6">

          	<div class="small-box bg-green">
            	<div class="inner">
              		<h3>{{$user_count}}</h3>
              		<p>{{tr('total_users')}}</p>
            	</div>
            	
            	<div class="icon">
              		<i class="fa fa-user"></i>
            	</div>

            	<a href="{{route('admin.users')}}" class="small-box-footer">
              		{{tr('more_info')}}
              		<i class="fa fa-arrow-circle-right"></i>
            	</a>
          	</div>
        </div>

		<!-- Total Moderators -->

          <div class="col-lg-4 col-xs-6">

            <div class="small-box label-primary">
                <div class="inner">
                    <h3>{{$categories}}</h3>
                    <p>{{tr('categories')}}</p>
                </div>
                
                <div class="icon">
                    <i class="fa fa-suitcase"></i>
                </div>

                <a href="{{route('admin.categories')}}" class="small-box-footer">
                    {{tr('more_info')}}
                    <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        
        </div>


        

        <div class="col-lg-4 col-xs-6">

          	<div class="small-box bg-yellow">
            	<div class="inner">
              		<h3>{{$video_count}}</h3>
              		<p>{{tr('today_videos')}}</p>
            	</div>
            	
            	<div class="icon">
              		<i class="fa fa-video-camera"></i>
            	</div>

            	<a href="{{route('admin.videos')}}" class="small-box-footer">
              		{{tr('more_info')}}
              		<i class="fa fa-arrow-circle-right"></i>
            	</a>
          	</div>
        
        </div>

      
	</div>



    <div class="row">
        @if(count($recent_users) > 0)

        <div class="col-md-6">
              <!-- USERS LIST -->
            <div class="box box-danger">

                <div class="box-header with-border">
                    <h3 class="box-title">{{tr('latest_users')}}</h3>

                    <div class="box-tools pull-right">
                        <!-- <span class="label label-danger">8 New Members</span> -->
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>

                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <ul class="users-list clearfix">
                        @foreach($recent_users as $user)

                            <li>
                                <img style="width:60px;height:60px" src="@if($user->picture) {{$user->picture}} @else {{asset('placeholder.png')}} @endif" alt="User Image">
                                <a class="users-list-name" href="{{route('admin.view.user' , $user->id)}}">{{$user->name}}</a>
                                <span class="users-list-date">{{$user->created_at->diffForHumans()}}</span>
                            </li>

                        @endforeach
                    </ul>
                  <!-- /.users-list -->
                </div>
                <!-- /.box-body -->

                <div class="box-footer text-center">
                    <a href="{{route('admin.users')}}" class="uppercase">{{tr('view_all')}}</a>
                </div>

                <!-- /.box-footer -->
            </div>

              <!--/.box -->
        </div>

        @endif

        @if(count($recent_videos) > 0)
            <div class="col-md-6">
                <div class="box box-primary">

                    <div class="box-header with-border">
                        <h3 class="box-title">{{tr('recent_videos')}}</h3>

                        <div class="box-tools pull-right">

                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>

                            <button type="button" class="btn btn-box-tool" data-widget="remove">
                                <i class="fa fa-times"></i>
                            </button>
                      </div>

                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">

                        <ul class="products-list product-list-in-box">
                            @foreach($recent_videos as $v => $video)

                                @if($v < 5)
                                    <li class="item">
                                        <div class="product-img">
                                            <img src="{{$video->default_image}}" alt="Product Image">
                                        </div>
                                        <div class="product-info">
                                            <a href="{{route('admin.view.video' , array('id' => $video->admin_video_id))}}" class="product-title">{{substr($video->title, 0,50)}}
                                                <span class="label label-warning pull-right">{{$video->duration}}</span>
                                            </a>
                                            <span class="product-description">
                                              {{substr($video->description , 0 , 75)}}
                                            </span>
                                      </div>
                                    </li>

                                @endif
                            @endforeach
                            <!-- /.item -->
                        </ul>
                    </div>

                    <!-- /.box-body -->
                    <div class="box-footer text-center">
                        <a href="{{route('admin.videos')}}" class="uppercase">{{tr('view_all')}}</a>
                    </div>
                    <!-- /.box-footer -->
                </div>
            </div>
        @endif

    </div>


@endsection

