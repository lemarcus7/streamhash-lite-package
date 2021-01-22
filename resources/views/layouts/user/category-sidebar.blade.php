<div class="cat-side-box">
    <div class="box-title">
      <h3>{{tr('categories')}}</h3>
    </div>
    
    <div class="cat-side-box-cont">

    	@if(count($categories) > 0)
	        @foreach($categories as $category)
	            <a href="{{route('user.category',$category->id)}}">{{$category->name}}</a>
	        @endforeach
        @else
        	<div class="text-center">{{tr("no_result_found")}}</div>
        @endif
    </div>

</div>