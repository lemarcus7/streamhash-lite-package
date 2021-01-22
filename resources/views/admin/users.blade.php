@extends('layouts.admin')

@section('title', tr('users'))

@section('content-header', tr('users'))

@section('breadcrumb')
    <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>{{tr('home')}}</a></li>
    <li class="active"><i class="fa fa-user"></i> {{tr('users')}}</li>
@endsection

@section('content')

	@include('notification.notify')

	<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">

            	@if(count($users) > 0)

	              	<table id="example1" class="table table-bordered table-striped">

						<thead>
						    <tr>
						      <th>{{tr('id')}}</th>
						      <th>{{tr('username')}}</th>
						      <th>{{tr('email')}}</th>
						      <th>{{tr('mobile')}}</th>
						      <th>{{tr('action')}}</th>
						    </tr>
						</thead>

						<tbody>
							@foreach($users as $i => $user)

							    <tr>
							      	<td>{{$i+1}}</td>
							      	<td>{{$user->name}}</td>
							      	<td>{{$user->email}}</td>
							      	<td>{{$user->mobile}}</td>
							      	
							      	<td>
							      		
            							<ul class="admin-action btn btn-default">
											@if($i == 0 || $i == 1)
            									<li class="dropdown">
            								@else
            									<li class="dropup">
            								@endif	
								                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
								                  {{tr('action')}} <span class="caret"></span>
								                </a>
								                <ul class="dropdown-menu">
								                  	<li role="presentation"><a role="menuitem" tabindex="-1" href="{{route('admin.edit.user' , array('id' => $user->id))}}">{{tr('edit')}}</a></li>
								                  	<li role="presentation"><a role="menuitem" tabindex="-1" href="{{route('admin.view.user' , $user->id)}}">{{tr('view')}}</a></li>
								                  	<li role="presentation" class="divider"></li>

								                  	<li role="presentation"><a role="menuitem" tabindex="-1" href="{{route('admin.user.history', $user->id)}}">{{tr('history')}}</a></li>

								                  	<li role="presentation"><a role="menuitem" tabindex="-1" href="{{route('admin.user.wishlist', $user->id)}}">{{tr('wishlist')}}</a></li>

								                  	<li role="presentation" class="divider"></li>
								                  	<li role="presentation">

								                  	 @if(Setting::get('admin_delete_control'))
								                  	 	<a role="button" href="javascript:;" class="btn disabled" style="text-align: left">{{tr('delete')}}</a>
								                  	 @else

								                  	 	<a role="menuitem" tabindex="-1"
								                  			onclick="return confirm('Are you sure?');" href="{{route('admin.delete.user', array('id' => $user->id))}}">{{tr('delete')}}
								                  		</a>

								                  	 @endif

								                  	</li>

								                </ul>
              								</li>
            							
            							</ul>

							      	</td>

							    </tr>
							@endforeach
						</tbody>
					</table>
				@else
					<h3 class="no-result">{{tr('no_user_found')}}</h3>
				@endif
            </div>
          </div>
        </div>
    </div>

@endsection
