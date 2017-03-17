@extends('layouts.app')

@section('content')

<div id="holder" class="container">
    <div class="row" style="padding-top:50px;">
        <div class="col-sm-4">
            <div class="thumbnail" style="background-color:white; box-shadow:2px 2px 2px lightgrey; height:300px;">
                <center>
                    <div>
                        <img src="/public_images/houses.png" style="margin:15px; height:170px; width:170px; border-radius:10px;">
                    </div>
                    <p><b>Manage your properties.</b></p>
                    <a data="data-pjax-pages"  href="/manage_properties" class="btn btn-success">Go</a>
                </center>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="thumbnail" style="background-color:white; box-shadow:2px 2px 2px lightgrey; height:300px;">
                <center>
                    <div>
                        <img src="/public_images/notifications.png" style="margin:15px; height:170px; width:170px; border-radius:10px;">
                    </div>
                    <p><b>See your notifications.</b></p>
                    <a data="data-pjax-pages"  href="/notifications" class="btn btn-success">Go</a>
                </center>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="thumbnail" style="background-color:white; box-shadow:2px 2px 2px lightgrey; height:300px;">
                <center>
                    <div>
                        <img src="/public_images/questions-and-answers.png" style="margin:15px; height:170px; border-radius:10px;">
                    </div>
                    <p><b>Check your quesitons</b></p>
                    <a data="data-pjax-pages"  href="/questions" class="btn btn-success">Go</a>
                </center>
            </div>
        </div>
    </div>
</div>

@endsection