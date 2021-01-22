@extends('layouts.user')

@section('content')
<div class="video-full-box">
    <div class="box-title">
      <h3>{{tr('categories')}}</h3>
    </div>

    @if(count($categories) > 0)
      @foreach($categories as $category)
      <div class="video-box">
        <a href="{{route('user.category',$category->id)}}">
          <img src="{{$category->picture}}">
          <span class="time">{{category_video_count($category->id)}} Videos</span>
          <h5 class="video-title cat">{{$category->name}}</h5>
        </a>
      </div>
      @endforeach
    @else

      <br>

      <div class="text-left">{{tr("no_result_found")}}</div>

    @endif
</div>

@endsection