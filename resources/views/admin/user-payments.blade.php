@extends('layouts.admin')

@section('title', tr('user_payments'))

@section('content-header',tr('user_payments'))

@section('breadcrumb')
    <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>{{tr('home')}}</a></li>
    <li class="active"> {{tr('user_payments')}}</li>
@endsection

@section('content')

@include('notification.notify')

	<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">

            	@if(count($data) > 0)

	              	<table id="example1" class="table table-bordered table-striped">

						<thead>
						    <tr>
						      <th>{{tr('id')}}</th>
						      <th>{{tr('username')}}</th>
						      <th>{{tr('payment_id')}}</th>
						      <th>{{tr('amount')}}</th>
						      <th>{{tr('expiry_date')}}</th>
						    </tr>
						</thead>

						<tbody>

							@foreach($data as $i => $payment)

							    <tr>
							      	<td>{{$i+1}}</td>
							      	<td><a href="{{route('admin.view.user' , $payment->user_id)}}"> {{$payment->user->name}} </a></td>
							      	<td>{{$payment->payment_id}}</td>
							      	<td>$ {{$payment->amount}}</td>
							      	<td>{{date('d M Y',strtotime($payment->expiry_date))}}</td>
							    </tr>					

							@endforeach
						</tbody>
					</table>
				@else
					<h3 class="no-result">{{tr('no_result_found')}}</h3>
				@endif
            </div>
          </div>
        </div>
    </div>

@endsection


