@extends('layouts.admin')

@section('title', tr('edit_video'))

@section('content-header', tr('edit_video'))

@section('styles')

    <link rel="stylesheet" href="{{asset('admin-css/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css')}}">

    <link rel="stylesheet" href="{{asset('admin-css/plugins/iCheck/all.css')}}">

@endsection

@section('breadcrumb')
    <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>{{tr('home')}}</a></li>
    <li><a href="{{route('admin.videos')}}"><i class="fa fa-video-camera"></i>{{tr('videos')}}</a></li>
    <li class="active"> {{tr('edit_video')}}</li>
@endsection 


@if(checkSize())
<div class="alert alert-warning">
    <button type="button" class="close" data-dismiss="alert">×</button>
        {{tr('max_upload_size')}} <b>{{ini_get('upload_max_filesize')}}</b>&nbsp;&amp;&nbsp;{{tr('post_max_size')}} <b>{{ini_get('post_max_size')}}</b>
</div>

@endif
@section('content')

    @include('notification.notify')

    <div class="row">

        <div class="col-md-12">

            <div class="box box-info">

                <div class="box-header">
                </div>

                <form class="form-horizontal" action="{{route('admin.save.edit.video')}}" method="POST" enctype="multipart/form-data" role="form">

                    <div class="box-body">

                        <div class="col-md-6">

                            <input type="hidden" value="{{$video->video_id}}" name="id">

                            <div class="form-group">
                                <label for="title" class="">{{tr('title')}}</label>
                                <input type="text" required value="{{$video->title}}" class="form-control" id="title" name="title" placeholder="{{tr('title')}}">
                            </div>

                            <div class="form-group">
                                <label for="description" class="">{{tr('description')}}</label>
                                <textarea  style="overflow:auto;resize:none" class="form-control" required rows="4" cols="50" id="description" name="description">{{$video->description}}</textarea>
                            </div>
                            
                            <div class="form-group">

                                <label for="category" class="">{{tr('select_category')}}</label>

                                <select id="category" required name="category_id" class="form-control">
                                    <option value="">{{tr('select_category')}}</option>

                                    @if(count($categories) > 0)
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}" @if($video->category_id == $category->id) selected @endif>{{$category->name}}</option>
                                        @endforeach
                                    @endif

                                </select>

                            </div>

                            <div class="form-group">

                                <label for="sub_category" class="">{{tr('select_sub_category')}}</label>

                                <select id="sub_category" required name="sub_category_id" class="form-control" @if(!$video->sub_category_id) disabled @endif>
                                    <option value="{{$video->sub_category_id}}">{{$video->sub_category_name}}</option>
                                </select>
                            </div>

                            <div class="form-group">

                                <label for="genre" class="">{{tr('select_genre')}}</label>

                                <select id="genre" name="genre_id" class="form-control" @if(!$video->is_series) disabled @endif>
                                    @if($video->genre_id)
                                        <option value="{{$video->genre_id}}">{{$video->genre_name}}</option>
                                    @else
                                        <option value="">{{tr('select_genre')}}</option>
                                    @endif
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="ratings" class="">{{tr('ratings')}}</label>
                                <span class="starRating">
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
                            </div>

                            <div class="form-group">
                                <label for="reviews" class="">{{tr('reviews')}}</label>
                                <textarea  style="overflow:auto;resize:none" class="form-control" rows="4" cols="50" id="reviews" name="reviews">{{$video->reviews}}</textarea>
                            </div>

                        </div> 

                        <div class="col-md-1">
                        </div>

                        <div class="col-md-5">

                             <div class="form-group">
                                <small style="color:brown">Note : Check the view video for video images.</small> <br>
                                <label for="default_image" class="">{{tr('default_image')}}</label> 
                                <input type="file" class="form-control" id="default_image" accept="image/gif,image/png,image/jpeg,image/jpg" name="default_image" accept="image/gif,image/jpeg,image/png,image/jpg" placeholder="{{tr('default_image')}}">
                            </div>

                            <div class="form-group">
                                <label for="other_image1" class="">{{tr('other_image1')}}</label>
                                <input type="file" class="form-control" id="other_image1" accept="image/gif,image/png,image/jpeg,image/jpg" name="other_image1" accept="image/gif,image/jpeg,image/png,image/jpg" placeholder="{{tr('other_image1')}}">
                            </div>

                            <div class="form-group">
                                <label for="other_image2" class="">{{tr('other_image2')}}</label>
                                <input type="file" class="form-control" id="other_image2" accept="image/gif,image/png,image/jpeg,image/jpg" name="other_image2" accept="image/gif,image/jpeg,image/png,image/jpg" placeholder="{{tr('other_image2')}}">
                            </div>

                            <div class="form-group">

                                <label for="datepicker" class="">{{tr('publish_time')}}</label>

                                <input type="text" value="{{$video->publish_time}}" name="publish_time" placeholder="Select the Publish Time i.e YYYY-MM-DD" class="form-control pull-right" id="datepicker">
                                
                            </div>

                            <div class="form-group">
                                <label>{{tr('duration')}} : </label><small> Note: Format must be HH:MM:SS</small>

                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input value="{{$video->duration}}" required type="text" name="duration" class="form-control" data-inputmask="'alias': 'hh:mm:ss'" data-mask>
                                </div>
                                <!-- /.input group -->
                            </div>

                            <!-- 1 = normal video upload -->

                            <input type="hidden" name="video_type" value="1"> 

                            <!-- 2 = Direct Server upload -->
                            
                            <input type="hidden" name="video_upload_type" value="2">

                            <div class="form-group">
                                <label for="video" class="">{{tr('video')}}</label>
                                <input type="file" class="form-control" id="video" name="video" accept="video/*" placeholder="{{tr('picture')}}">
                            </div>

                            <div class="form-group">
                                <label for="trailer_video" class="">{{tr('trailer_video')}}</label>
                                <input type="file" class="form-control" id="trailer_video" name="trailer_video" accept="video/*" placeholder="{{tr('trailer_video')}}">
                            </div>

                        </div>

                    </div>

                    <div class="box-footer">
                        <button type="reset" class="btn btn-danger">{{tr('cancel')}}</button>

                        <button type="submit" class="btn btn-success pull-right">{{tr('submit')}}</button>

                        <a target="_blank" style="margin-right:50px" href="{{route('admin.view.video' , array('id' => $video->video_id))}}" class="btn btn-primary pull-right">{{tr('view_video')}}</a>

                    </div>

                </form>
            
            </div>

        </div>

    </div>

@endsection

@section('scripts')

    <script type="text/javascript">

        $(function () {

            $('form').submit(function () {
                window.onbeforeunload = null;
            });

            window.onbeforeunload = function() {
                  return "Data will be lost if you leave the page, are you sure?";
            };

            $('#category').change(function(){

                var id = $(this).val();
                var url = "{{ url('select/sub_category')}}";
                
                $.post(url,{ option: id },
                
                    function(data) {

                        $('#sub_category').empty(); 

                        $('#sub_category').append("<option value=''>Select Sub category</option>");

                        if(data.length != 0) {
                            document.getElementById("sub_category").disabled=false;
                        } else {
                            document.getElementById("sub_category").disabled=true;
                        }

                        $.each(data, function(index, element) {
                            $('#sub_category').append("<option value='"+ element.id +"'>" + element.name + "</option>");
                        });
                });

            });

            $('#sub_category').change(function(){

                var id = $(this).val();
                var url = "{{ url('select/genre')}}";
                
                $.post(url,{ option: id },
                
                    function(data) {

                        $('#genre').empty(); 

                        $('#genre').append("<option value=''>Select genre</option>");

                        if(data.length != 0) {
                            document.getElementById("genre").disabled=false;
                        } else {
                            document.getElementById("genre").disabled=true;
                        }

                        $.each(data, function(index, element) {
                            $('#genre').append("<option value='"+ element.id +"'>" + element.name + "</option>");
                        });
                });

            });



        });
    </script>

    <script src="{{asset('admin-css/plugins/bootstrap-datetimepicker/js/moment.min.js')}}"></script> 

    <script src="{{asset('admin-css/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js')}}"></script> 

    <script src="{{asset('admin-css/plugins/iCheck/icheck.min.js')}}"></script>

    
    <script type="text/javascript">
        $(function () {

            $('#datepicker').datetimepicker({
                minTime: "00:00:00",
                maxDate: moment(),
                defaultDate: "{{$video->publish_time}}",
            });
        });
    </script>  
@endsection

