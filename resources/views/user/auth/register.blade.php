@extends('layouts.user.focused')

@section('content')

<div class="login-box">
    <h4>{{tr('register')}}</h4>
    
    <form role="form" method="POST" action="{{ url('/register') }}">
        
      <div class="form-group">
        {!! csrf_field() !!}
        @if($errors->has('email') || $errors->has('name') || $errors->has('password_confirmation') ||$errors->has('password'))
            <div data-abide-error="" class="alert callout">
                <p>
                    <i class="fa fa-exclamation-triangle"></i> 
                    <strong> 
                        @if($errors->has('email')) 
                            {{ $errors->first('email') }}
                        @endif

                        @if($errors->has('name')) 
                            {{ $errors->first('name') }}
                        @endif

                        @if($errors->has('password')) 
                            {{$errors->first('password') }}
                        @endif

                        @if($errors->has('password_confirmation'))
                            {{ $errors->first('password_confirmation') }}
                        @endif

                    </strong>
                </p>
            </div>
        @endif
        <label for="name">{{tr('name')}}</label>
        <input type="text" name="name" required class="form-control" id="name">
      </div>
      <div class="form-group">
        <label for="email">{{tr('email')}}</label>
        <input type="email" name="email" required class="form-control" id="email">
      </div>
      <div class="form-group">
        <label for="pwd">{{tr('password')}}</label>
        <input type="password" name="password" required class="form-control" id="pwd">
      </div>  
      <div class="form-group">
        <label for="pwd">{{tr('confirm_password')}}</label>
        <input type="password" name="password_confirmation" required class="form-control" id="pwd">
      </div>                  
      <button type="submit" class="btn btn-default">{{tr('signup')}}</button>
    </form>                
    <p class="help"><a href="{{ route('user.login.form') }}">{{tr('login')}}</a></p>         
</div>

@endsection
