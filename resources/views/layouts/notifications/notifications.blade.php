@extends('layouts.app')

@section('content')
<div class="container" id="holder">
    <div class="row" style="padding-top:10px; padding-right:15px; padding-left:15px;">
    
        @if(count($notifications))
            <h1 style="padding-top:0px;">Your notifications:</h1>
        @else
            <h1 style="padding-top:0px;">Your notifications is empty. But don't worry, you will get a few soon.</h1>
        @endif
        
        @foreach($notifications as $notification)
        <div class="thumbnail" style="background-color:white; border:1px solid lightgrey; box-shadow:2px 2px 2px lightgrey; padding:15px;">
            <div class="row">
                <div class="col-sm-3">
                    <b>From:</b> {{ $notification->name }} {{ $notification->last_name }}
                    <br>
                    <b>Email:</b> {{ $notification->email }}
                    <br>
                    @if($notification->telephone)
                        <b>Telephone:</b> {{ $notification->telephone }}
                    @endif
                </div>
                <div class="col-sm-8">
                    <div>
                        <b>Date:</b>{{ $notification->updated_at }}
                    </div>
                    <div>
                        <b>Property:</b> {{ App\Residence::find($notification->residence_id)->street_adress }},
                        {{ App\Residence::find($notification->residence_id)->city }},
                        {{ App\Residence::find($notification->residence_id)->state }},
                        {{ App\Residence::find($notification->residence_id)->zip_code }}
                    </div>
                    <div>
                        <b>Comment:</b> {{ $notification->comment }}
                    </div>
                </div>
                <div class="col-sm-1">
                    <a type="button" class="btn btn-primary" style="margin-top:25%; width:100%;">Reply</a>
                </div>
            </div>
        </div>
        @endforeach
        
    </div>
</div>
    

@endsection