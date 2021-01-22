@extends('layouts.user.focused')

@section('content')

    @include('notification.notify')

    <div class="login-box">
        <h4>{{tr('delete_account_heading')}}</h4>

        <p style="color: gray">
            <strong>Note:</strong> {{tr('delete_account_content')}}
        </p>
        
        <form role="form" method="POST" action="{{ route('user.delete.account.process') }}">

            <div class="form-group">
                <label for="pwd">Password:</label>
                <input type="password" name="password" required class="form-control" id="pwd">
                <span class="form-error">
                    @if ($errors->has('password'))
                        <strong>{{ $errors->first('password') }}</strong>
                    @endif
                </span>
            </div>     

          <button type="submit" class="btn btn-default" onclick="return confirm('Are you sure?.')">{{tr('delete_account')}}</button>

        </form> 
    </div>

@endsection
