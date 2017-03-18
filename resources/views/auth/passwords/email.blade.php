@extends('layouts.app')

@section('content')
<div class="container" style="padding-top:2%; padding-bottom:5%;">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                
                <center><h1 style="width: 80%; text-align: left; font-size: 26px">Recover your Password</h1></center>
                <div class="panel-body" style="padding-top: 5px">

                    @if (session('status'))
                    <center>
                        <div class="alert alert-success" style="width: 80%;">
                            {{ session('status') }}
                        </div>
                    </center>
                    @endif

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
                        {{ csrf_field() }}
                        
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}" style="margin-bottom: 30px">
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

                        <div class="form-group">
                            <center><button type="submit" class="btn btn-primary" style="width: 80%">
                                    </i> Send password reset link
                            </button></center>
                        </div>
                        
                        <center><div style="width: 80%; height: 12px; border-bottom: 1px solid lightgrey; text-align: center; margin-bottom: 20px;">
                          <span style="background-color: white; font-size: 12px; padding-right: 5px; padding-left: 5px; color: grey">
                            You don't have an account?  
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
