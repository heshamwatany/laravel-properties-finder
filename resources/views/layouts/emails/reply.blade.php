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
                
                <h1 style="padding-top:0px; margin-top:0px;">{{$notification->name}}, you have been contacted!</h1>
                
                <p>
                    <b>{{ $sender->name }} {{ $sender->last_name }}</b> replied to you about the 
                    <b>
                        <a href="https://laravel-properties-finder-acarste.c9users.io/residence_main/{{ $notification->residence_id }}" style="text-decoration:none;">
                        {{ str_replace('_', ' ', App\Residence::find($notification->residence_id)->type) }}
                       </a>
                    </b> for
                    <b>{{ str_replace('_', ' ', App\Residence::find($notification->residence_id)->category) }}</b>
                    in <b>{{ App\Residence::find($notification->residence_id)->street_adress }},
                    {{ App\Residence::find($notification->residence_id)->city }},
                    {{ App\Residence::find($notification->residence_id)->state }},
                    {{ App\Residence::find($notification->residence_id)->zip_code }}</b>. 
                </p>
                
                <p>
                    <b>Your Comment:</b>
                    <br>
                    {{ $notification->comment }}
                </p>
                
                <p>
                    <b>Reply:</b>
                    <br>
                    {{ $comment }}
                </p>

                <div>
                    <b>Contact Info:</b>
                    <br>
                    <b>Email:</b> {{$sender->email }}
                </div>
                
                <br>
                
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