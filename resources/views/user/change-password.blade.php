@extends('layouts.user')

@section('content')

<div class="login-box">
    <h4>{{tr('change_password')}}</h4>    
    @include('notification.notify')           
    <form method="post" action="{{ route('user.profile.password') }}">
      <div class="form-group">
        <label for="newpwd">{{tr('old_password')}}:</label>
        <input type="password" name="old_password" class="form-control" id="newpwd">
      </div>
      <div class="form-group">
        <label for="newpwd">{{tr('new_password')}}:</label>
        <input type="password" name="password" class="form-control" id="newpwd">
      </div>
      <div class="form-group">
        <label for="cnfrmpwd">{{tr('confirm_password')}}:</label>
        <input type="password" name="password_confirmation" class="form-control" id="cnfrmpwd">
      </div>                                     
      <button type="submit" class="btn btn-default">{{tr('submit')}}</button>
    </form>                
    <p class="help"><a href="{{route('user.dashboard')}}">Go Home</a></p>                
  </div>

@endsection