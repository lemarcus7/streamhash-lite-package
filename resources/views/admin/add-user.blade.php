@extends('layouts.admin')

@section('title', tr('add_user'))

@section('content-header', tr('add_user'))

@section('breadcrumb')
    <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>{{tr('home')}}</a></li>
    <li><a href="{{route('admin.users')}}"><i class="fa fa-user"></i> {{tr('users')}}</a></li>
    <li class="active">{{tr('add_user')}}</li>
@endsection

@section('content')

@include('notification.notify')

    <div class="row">

        <div class="col-md-10">

            <div class="box box-info">

                <div class="box-header">
                </div>

                <form class="form-horizontal" action="{{route('admin.save.user')}}" method="POST" enctype="multipart/form-data" role="form">

                    <div class="box-body">

                        <div class="form-group">
                            <label for="email" class="col-sm-1 control-label">{{tr('email')}}</label>
                            <div class="col-sm-10">
                                <input type="email" required class="form-control" id="email" name="email" placeholder="{{tr('email')}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="username" class="col-sm-1 control-label">{{tr('username')}}</label>

                            <div class="col-sm-10">
                                <input type="text" required name="name" class="form-control" id="username" placeholder="{{tr('username')}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="mobile" class="col-sm-1 control-label">{{tr('mobile')}}</label>

                            <div class="col-sm-10">
                                <input type="text" required name="mobile" class="form-control" id="mobile" placeholder="{{tr('mobile')}}">
                            </div>
                        </div>

                    </div>

                    <div class="box-footer">
                        <button type="reset" class="btn btn-danger">{{tr('cancel')}}</button>
                        <button type="submit" class="btn btn-success pull-right">{{tr('submit')}}</button>
                    </div>
                </form>
            
            </div>

        </div>

    </div>

@endsection