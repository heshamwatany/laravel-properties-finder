@extends('layouts.app')

@section('content')

<div class="container" style="padding-top:2%; padding-bottom:5%;">
    
       <div class="row">
           
        <div class="col-md-4 col-md-offset-4">
            
            <div class="panel panel-default">
                
                <center><h1 style="width: 80%; text-align: left;">Login</h1></center>
                <div class="panel-body" style="padding-top: 5px">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}" novalidate>
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}" style="margin-bottom: 10px">
                            <center><div class="form-group" style="width: 80%;  margin-bottom: 0">
                                <label for="email" style="text-align:left; width:100%">Email</label>
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" autofocus>
                                @if ($errors->has('email'))
                                    <span class="help-block" style="text-align:left; width:100%; margin-bottom: 0">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div></center>
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}" style="margin-bottom: 0px">
                            <center><div class="form-group" style="width: 80%; margin-bottom: 0">
                                <label for="password" style="text-align:left; width:100%">Password</label>
                                <input id="password" type="password" class="form-control" name="password">
                                 @if ($errors->has('password'))
                                    <span class="help-block" style="text-align:left; width:100%; margin-bottom: 0px">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div></center>
                        </div>
                        <div class="form-group" style="margin-bottom: 10px;">
                            <div class="checkbox" style="width:100%">
                                <label style="text-align:left; margin-left: 10%">
                                    <input type="checkbox" name="remember"> Remember me
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <center><button type="submit" class="btn btn-primary" style="width: 80%">
                                    <i class="fa fa-btn fa-sign-in"></i> Login
                            </button></center>
                            <a class="btn btn-link" href="{{ url('/password/reset') }}" style="text-align:left; margin-left: 10%; padding-top: 10px; 
                            padding-left: 0px; padding-bottom: 0px; text-decoration:none;" >
                            Forgot password?</a>
                        </div>
                        <center><div style="width: 80%; height: 12px; border-bottom: 1px solid lightgrey; text-align: center; margin-bottom: 20px;">
                          <span style="background-color: white; font-size: 12px; padding-right: 5px; padding-left: 5px; color: grey">
                            You don't hava an account?  
                          </span>
                        </div></center>
                        <center><div class="form-group">
                            <a type="button" class="btn btn-info active" style="width: 80%;" href="{{ url('/register') }}">
                                    Resgister
                            </a>
                        </div></center>

                    </form>
                </div>
            </div>
        </div>
    </div>
    

</div>
@endsection
