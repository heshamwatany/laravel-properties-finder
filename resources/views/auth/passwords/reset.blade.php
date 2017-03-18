@extends('layouts.app')

@section('content')
<div class="container" style="padding-top:2%;">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <center><h1 style="width: 80%; text-align: left; font-size: 26px">Reset your Password</h1></center>
                <div class="panel-body" style="padding-top: 5px">
                    
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
                        {{ csrf_field() }}

                        <input type="hidden" name="token" value="{{ $token }}">
                        
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}" style="margin-bottom: 15px">
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
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}" style="margin-bottom: 15px">
                            <center><div class="form-group" style="width: 80%;  margin-bottom: 0">
                                <label for="password" style="text-align:left; width:100%">Password</label>
                                <input id="password" type="password" class="form-control" name="password">
                                @if ($errors->has('password'))
                                    <span class="help-block" style="text-align:left; width:100%; margin-bottom: 0">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div></center>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}" style="margin-bottom: 15px">
                            <center><div class="form-group" style="width: 80%;  margin-bottom: 0">
                            <label for="password-confirm" style="text-align:left; width:100%">Confirm Password</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block" style="text-align:left; width:100%; margin-bottom: 0">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div></center>
                        </div>
                        
                        <div class="form-group">
                            <center><button type="submit" class="btn btn-primary" style="width: 80%">
                                    <i class="fa fa-btn fa-refresh"></i> Reset Password
                            </button></center>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
