<!DOCTYPE html>
<html lang="en" onclick="submitOrHide(this.id, isFocus)" style="min-height:100%">
    <head>
        <!-- Styles -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <link href="https://laravel-properties-finder-acarste.c9users.io/css/app.css" rel="stylesheet">
    </head>
    <body>
        <div class="container thumbnail" id="holder" style="border:1px solid lightgrey; border-radius:3px; box-shadow:2px 2px 2px lightgrey; color:black;">
            <div class="row" style="padding:15px;">
                
                <h1 style="padding-top:0px; margin-top:0px;">Welcome {{$user->name}} {{$user->last_name }}!</h1>
                
                <p>
                    <b>{{ $user->name }}</b>, we are so happy to welcome you into the YouProfy family. 
                    Here you will be able to post properties for rent, shared rent, or lease takeover.
                    You could find your next roomate or you could help someone else find a roomate, 
                    who knows, the posibilities are endless.
                    Nonetheless, we just want to use this email to thank you for being part of YouProfy and
                    to wish you a nice day.
                </p>
                
                <div>
                    <b><a href="https://laravel-properties-finder-acarste.c9users.io/" style="text-decoration:none;">YouProfy.com</a> all rights reserved.</b>
                </div>
                
                <p style="font-size:10px;">
                    ***Please do not reply to this email since it won't be delivered.
                </p>

            </div>
        </div>
    </body>
</html>