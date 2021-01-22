@extends('layouts.user.focused')

@section('content')

    <div class="login-box">
        <h4>{{tr('login')}}</h4>

        <form role="form" method="POST" action="{{ url('/login') }}">
            
            {!! csrf_field() !!}

            <div class="form-group">
                <label for="email">Email address:</label>
                <input type="email" name="email" required class="form-control" id="email">
                @if($errors->has('email'))
                    <span class="form-error"><strong>{{ $errors->first('email') }}</strong></span>
                @endif
            </div>

            <div class="form-group">
                <label for="pwd">Password:</label>
                <input type="password" name="password" required class="form-control" id="pwd">
                <span class="form-error">
                    @if ($errors->has('password'))
                        <strong>{{ $errors->first('password') }}</strong>
                    @endif
                </span>
            </div> 

          <button type="submit" class="btn btn-default">{{tr('login')}}</button>
        </form>                
        <p class="help"><a href="{{route('user.register.form')}}">{{tr('new_account')}}</a></p>
        <p class="help"><a href="{{ url('/password/reset') }}">{{tr('forgot_password')}}</a></p>
    </div>

@endsection
