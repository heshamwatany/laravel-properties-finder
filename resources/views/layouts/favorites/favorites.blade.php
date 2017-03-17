@extends('layouts.app')

@section('content')
<div class="container" id="holder">
    <div class="row" style="padding-top:10px;">
        @if(count($residences))
            <h1 style="padding:15px; padding-top:0px;">Your favorites</h1>
        @else
            <h1 style="padding:15px; padding-top:0px;">Your favorites is empty. Please click <a href="/" style="text-decoration:none;">here</a> to look for properties.</h1>
        @endif
        @foreach($residences as $residence)
            <div class="col-sm-3">
                <a href="/residence_main/{{$residence->id}}" style="text-decoration: none; cursor: pointer;">
                    <div class="thumbnail" style="background-color:white; box-shadow:2px 2px 2px lightgrey; min-height:400px;">
                        <div class="thumbnail" style="padding:0px; height:196px; margin-bottom:5px;">
                            <center>
                                @if(count($residence->photos()->where('is_profile', '=', true)->get()) > 0)
                                <img class="img-responsive" 
                                    src="{{ $residence->photos()->where('is_profile', '=', true)->get()->offsetGet(0)->path }}" 
                                    style="height:196px; width:100%; border-radius:3px;">
                                @else
                                    No image available.
                                @endif
                            </center>
                        </div>
                        <div>
                            <b>{{ $residence->descriptions->title }}</b>
                        </div>
                        <div>
                             {{ $residence->street_adress }}, {{ $residence->city }}, {{ $residence->state }}, {{ $residence->zip_code }}
                        </div>
                        <div>
                            {{ $residence->type }} for {{ $residence->category }}  
                        </div>
                        <div>
                            {{ $residence->number_of_rooms }} rooms, {{ $residence->number_of_bathrooms }} bathrooms
                            & {{ $residence->parking_spots }} parking spots
                        </div>
                        <div>
                            <b>${{ $residence->price }} per month</b>
                            <b class="pull-right">
                            @if(!is_null($residence->contactInfos->telephone))
                                {{ $residence->contactInfos->telephone }}
                            @elseif(!is_null($residence->contactInfos->alternate_telephone))
                                {{ $residence->contactInfos->alternate_telephone }}
                            @elseif(!is_null($residence->contactInfos->email))
                                {{ $residence->contactInfos->email }}
                            @endif
                            </b>
                        </div>
                        <div>
                            <a href="/my_favorites/remove/{{ $residence->id }}" type="button" class="btn btn-danger" style="text-decoration:none; width:100%; margin-top:5px;">Remove <i class="fa fa-times"></i></a>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>
@endsection
