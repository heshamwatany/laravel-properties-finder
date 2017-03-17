@extends('layouts.app')

@section('content')
<div class="container" style="padding-top:2%; padding-bottom:2%;">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <center><h1 style="width: 80%; text-align: left;">Sign Up</h1></center>
                <div class="panel-body" style="padding-top: 5px">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}" style="margin-bottom: 10px">
                            <center><div class="form-group" style="width: 80%;  margin-bottom: 0">
                            <label for="name" style="text-align:left; width:100%">Name</label>
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" autofocus>
                                @if ($errors->has('name'))
                                    <span class="help-block" style="text-align:left; width:100%; margin-bottom: 0">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div></center>    
                        </div>
                        
                        <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                            <center><div class="form-group" style="width: 80%;  margin-bottom: 0">
                            <label for="name" style="text-align:left; width:100%">Last Name</label>
                                <input id="name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}">
                                @if ($errors->has('last_name'))
                                    <span class="help-block" style="text-align:left; width:100%; margin-bottom: 0">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                             </div></center> 
                        </div>
                        
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}" style="margin-bottom: 10px">
                            <center><div class="form-group" style="width: 80%;  margin-bottom: 0">
                            <label for="email" style="text-align:left; width:100%">Email</label>
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">
                            @if ($errors->has('email'))
                                <span class="help-block" style="text-align:left; width:100%; margin-bottom: 0">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                            </div></center>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}" style="margin-bottom: 10px">
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
                        
                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}" style="margin-bottom: 15px">
                            <center><div class="form-group" style="width: 80%; margin-bottom: 0">
                                <label for="password-confirm" style="text-align:left; width:100%">Confirm Password</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div></center>
                        </div>
                        
                        <div class="form-group">
                            <center><button type="submit" class="btn btn-primary" style="width: 80%">
                                    <i class="fa fa-btn fa-user"></i> Create an Account
                            </button></center>
                        </div>
                        
                         <div class="form-group">
                        <center><div class="form-group" style="width: 80%; font-size: 12px; text-align: left; margin: 0;">
                            By creating an account you agree to the <a style="font-size: 12px; padding: 0; text-align: left; text-decoration:none; cursor:pointer;">Conditions of Use</a> 
                            and the <a  style="font-size: 12px; padding: 0; margin:0; text-align: left; text-decoration:none; cursor:pointer;">Privacy Notice</a>.
                        </div></center>
                        </div>
                        
                        <div class="form-group">
                        <center><div class="form-group" style="width: 80%; font-size: 12px; text-align: left; margin: 0; border-top: 1px solid lightgrey; padding-top:10px;">
                            Do you have an account? <a href="{{ url('/login') }}" style="font-size: 12px; padding: 0; text-align: left; text-decoration:none; cursor:pointer;">Login</a>. 
                        </div></center>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
