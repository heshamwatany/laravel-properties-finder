@extends('layouts.app')

@section('content')

<div class="container" id="holder">
    <div class="row" style="margin-bottom:10px;">
        <div class="col-sm-12">
            <ul class="nav nav-pills nav-justified">
                <li><a id="step-1" class="not-active">
                    <h4 class="list-group-item-heading">Step 1 <i class="fa fa-check" style="color:green"></i></h4>
                    <p class="list-group-item-text">Select type & category</p>
                </a></li>
                <li><a id="step-2" class="not-active">
                    <h4 class="list-group-item-heading">Step 2 <i class="fa fa-check" style="color:green"></i></h4>
                    <p class="list-group-item-text">Locate your residence</p>
                </a></li>
                <li><a id="step-3" class="not-active">
                    <h4 class="list-group-item-heading">Step 3 <i class="fa fa-check" style="color:green"></i></h4>
                    <p class="list-group-item-text">Describe & submit</p>
                </a></li>
                <li><a id="step-4" class="yes-active" onclick="pageRefresh()" >
                    <h4 class="list-group-item-heading">Step 4</h4>
                    <p class="list-group-item-text">Review & add Photos</p>
                </a></li>
            </ul>
        </div>
	</div>
	<div class="row" style="padding-right:15px; padding-left:15px;">
	        <div class="col-sm-12 thumbnail" style="min-height:303px; background-color:white; box-shadow:2px 2px 2px lightgrey; padding:15px; padding-top:0px;">
	        <div class="col-sm-3">
	            <h4><b>Profile Picture</b></h4>
	            @if(count($residence->photos()->where('is_profile', '=', true)->get()) == 0)
    	            <form id="profilePicForm" action="/file-upload-profile/{{ $residence->id }}" method="POST" class="dropzone" style="min-height:245px; text-align:center;">
                            {{ csrf_field() }}
                    </form>
                @else
                    <div style="max-height:247px; max-width:245px; text-align:center;">
                        <img class="img-thumbnail" src="{{ $residence->photos()->where('is_profile', '=', true)->get()->offsetGet(0)->path }}" style="max-height:207px;">
                    </div>
                    <center>
                        <a href="/uploaded/delete/{{ $residence->photos()->where('is_profile', '=', true)->get()->offsetGet(0)->id }}" class="btn btn-info" style="margin:5px; width:100px;">Delete <i class="fa fa-times"></i></a>
                    </center>
                @endif
	        </div>
	        <div class="col-sm-3">
	            <h4><b>Pic 1</b></h4>
	            @if(count($residence->photos()->where('is_profile', '=', false)->get()) < 1)
    	            <form id="pic1Form" action="/file-upload/{{ $residence->id }}" method="POST" class="dropzone" style="min-height:245px; text-align:center;">
                            {{ csrf_field() }}
                    </form>
                @else
                    <div style="max-height:247px; max-width:245px; text-align:center;">
                        <img class="img-thumbnail" src="{{ $residence->photos()->where('is_profile', '=', false)->get()->offsetGet(0)->path}}">
                    </div>
                    <center>
                        <a href="/uploaded/delete/{{ $residence->photos()->where('is_profile', '=', false)->get()->offsetGet(0)->id }}" class="btn btn-info" style="margin:5px; width:100px;">Delete <i class="fa fa-times"></i></a>
                    </center>
                @endif
	        </div>
	        <div class="col-sm-3">
	            <h4><b>Pic 2</b></h4>
	            @if(count($residence->photos()->where('is_profile', '=', false)->get()) < 2)
    	            <form id="pic2Form" action="/file-upload/{{ $residence->id }}" method="POST" class="dropzone" style="min-height:245px; text-align:center;">
                            {{ csrf_field() }}
                    </form>
                @else
                    <div style="max-height:247px; max-width:245px; text-align:center;">
                        <img class="img-thumbnail" src="{{ $residence->photos()->where('is_profile', '=', false)->get()->offsetGet(1)->path}}">
                    </div>
                    <center>
                        <a href="/uploaded/delete/{{ $residence->photos()->where('is_profile', '=', false)->get()->offsetGet(1)->id }}" class="btn btn-info" style="margin:5px; width:100px;">Delete <i class="fa fa-times"></i></a>
                    </center>
                @endif
	        </div>
	        <div class="col-sm-3">
	            <h4><b>Pic 3</b></h4>
	            @if(count($residence->photos()->where('is_profile', '=', false)->get()) < 3)
    	            <form id="pic3Form" action="/file-upload/{{ $residence->id }}" method="POST" class="dropzone" style="min-height:245px; text-align:center;">
                            {{ csrf_field() }}
                    </form>
                @else
                    <div style="max-height:247px; max-width:245px; text-align:center;">
                        <img class="img-thumbnail" src="{{ $residence->photos()->where('is_profile', '=', false)->get()->offsetGet(2)->path}}">
                    </div>
                    <center>
                        <a href="/uploaded/delete/{{ $residence->photos()->where('is_profile', '=', false)->get()->offsetGet(2)->id }}" class="btn btn-info" style="margin:5px; width:100px;">Delete <i class="fa fa-times"></i></a>
                    </center>
                @endif
	        </div>
	    </div>
	</div>
	<div class="row" style="padding-right:15px; padding-left:15px;">
	   <div class="col-sm-12 thumbnail" style="min-height:303px; background-color:white; box-shadow:2px 2px 2px lightgrey; padding:15px; padding-top:0px;">
	        <div class="col-sm-3">
	            <h4><b>Pic 4</b></h4>
	            @if(count($residence->photos()->where('is_profile', '=', false)->get()) < 4)
    	            <form id="pic4Form" action="/file-upload/{{ $residence->id }}" method="POST" class="dropzone" style="min-height:245px; text-align:center;">
                            {{ csrf_field() }}
                    </form>
                @else
                    <div style="max-height:247px; max-width:245px; text-align:center;">
                        <img class="img-thumbnail" src="{{ $residence->photos()->where('is_profile', '=', false)->get()->offsetGet(3)->path}}">
                    </div>
                    <center>
                        <a href="/uploaded/delete/{{ $residence->photos()->where('is_profile', '=', false)->get()->offsetGet(3)->id }}" class="btn btn-info" style="margin:5px; width:100px;">Delete <i class="fa fa-times"></i></a>
                    </center>
                @endif
	        </div>
	        <div class="col-sm-3">
	            <h4><b>Pic 5</b></h4>
	            @if(count($residence->photos()->where('is_profile', '=', false)->get()) < 5)
    	            <form id="pic5Form" action="/file-upload/{{ $residence->id }}" method="POST" class="dropzone" style="min-height:245px; text-align:center;">
                            {{ csrf_field() }}
                    </form>
                @else
                    <div style="max-height:247px; max-width:245px; text-align:center;">
                        <img class="img-thumbnail" src="{{ $residence->photos()->where('is_profile', '=', false)->get()->offsetGet(4)->path}}">
                    </div>
                    <center>
                        <a href="/uploaded/delete/{{ $residence->photos()->where('is_profile', '=', false)->get()->offsetGet(4)->id }}" class="btn btn-info" style="margin:5px; width:100px;">Delete <i class="fa fa-times"></i></a>
                    </center>
                @endif
	        </div>
	        <div class="col-sm-3">
	            <h4><b>Pic 6</b></h4>
	            @if(count($residence->photos()->where('is_profile', '=', false)->get()) < 6)
    	            <form id="pic6Form" action="/file-upload/{{ $residence->id }}" method="POST" class="dropzone" style="min-height:245px; text-align:center;">
                            {{ csrf_field() }}
                    </form>
                @else
                    <div style="max-height:247px; max-width:245px; text-align:center;">
                        <img class="img-thumbnail" src="{{ $residence->photos()->where('is_profile', '=', false)->get()->offsetGet(5)->path}}">
                    </div>
                    <center>
                        <a href="/uploaded/delete/{{ $residence->photos()->where('is_profile', '=', false)->get()->offsetGet(5)->id }}" class="btn btn-info" style="margin:5px; width:100px;">Delete <i class="fa fa-times"></i></a>
                    </center>
                @endif
	        </div>
	        <div class="col-sm-3">
	            <h4><b>Pic 7</b></b></h4>
	            @if(count($residence->photos()->where('is_profile', '=', false)->get()) < 7)
    	            <form id="pic7Form" action="/file-upload/{{ $residence->id }}" method="POST" class="dropzone" style="min-height:245px; text-align:center;">
                            {{ csrf_field() }}
                    </form>
                @else
                    <div style="max-height:247px; max-width:245px; text-align:center;">
                        <img class="img-thumbnail" src="{{ $residence->photos()->where('is_profile', '=', false)->get()->offsetGet(6)->path}}">
                    </div>
                    <center>
                        <a href="/uploaded/delete/{{ $residence->photos()->where('is_profile', '=', false)->get()->offsetGet(6)->id }}" class="btn btn-info" style="margin:5px; width:100px;">Delete <i class="fa fa-times"></i></a>
                    </center>
                @endif
	        </div>
	    </div>
	</div>
	<div class="row">
	    <div id="locator-div" class="col-sm-6">
	        <div class="thumbnail" style="height:417px; background-color:white; box-shadow:2px 2px 2px lightgrey; padding:15px; padding-top:0;">
	            <h4><b>General Information:</b></h4>
	            <div class="thumbnail">
                <div>
                    <b>Type:</b> <b style="color:red">{{ title_case($residence->type) }} </b>
                </div>
                <div>
                    <b>Category:</b> <b style="color:red">{{ title_case($residence->category) }}</b>
                </div>
                <div>
                    <b>Location:</b> <b id="location-adress" style="color:red">{{ title_case($residence->street_adress) }} {{ title_case($residence->city) }},  {{ title_case($residence->state) }},  {{ title_case($residence->zip_code) }}</b>
                </div>
                <div>
                    <b>Garden:</b> <b style="color:red">@if($residence->has_pool == 1) Yes @else No @endif</b>
                </div>
                <div>
                    <b>Pool:</b> <b style="color:red">@if($residence->has_pool == 1) Yes @else No @endif</b>
                </div>
                <div>
                    <b>Direct Deal:</b> <b style="color:red">@if($residence->is_direct == 1) Yes @else No @endif</b>
                </div>
                <div>
                    <b>New:</b> <b style="color:red">@if($residence->is_direct == 0) Yes @else No @endif</b>
                </div>
                <div>
                    <b>Rooms:</b> <b style="color:red">{{ $residence->number_of_rooms }}</b>
                </div>
                <div>
                    <b>Bathrooms:</b> <b style="color:red">{{ $residence->number_of_bathrooms }}</b>
                </div>
                <div>
                    <b>Parking Spots:</b> <b style="color:red">{{ $residence->parking_spots }}</b>
                </div>
                <div>
                    <b>Area:</b> <b style="color:red">{{ $residence->area }} sq. feet</b>
                </div>
                <div>
                    <b>Construction Area:</b> <b style="color:red">{{ $residence->construction_area }} sq. feet</b>
                </div>
                <div>
                    <b>Price:</b> <b style="color:red">${{ $residence->price }}</b>
                </div>
                </div>
            </div>
	    </div>
	    <div id="map-div" class="col-sm-6">
	        <div id="mapa" class="thumbnail" style="height:417px; background-color:white; box-shadow:2px 2px 2px lightgrey">
                <center>
                        <div id="map" class="mapa"></div>
                </center>
            </div>
	    </div>
	</div>
	<div class="row">
	    <div id="locator-div" class="col-sm-6">
	        <div class="thumbnail" style="height:417px; background-color:white; box-shadow:2px 2px 2px lightgrey; padding:15px; padding-top:0;">
                <h4><b>Title:</b></h4>
                <p class="thumbnail"><b>{{ $residence->descriptions->title }}</b></p>
                <h4><b>Description:</b></h4>
                <p class="thumbnail"><b>{{ $residence->descriptions->description }}</b></p>
                <h4><b>Contact Information</b></h4>
                <div class="thumbnail" style="padding-bottom:5px;">
                    @if(!is_null($residence->contactInfos->telephone ))
                        <p style="margin-bottom:5px;"><b>Telephone 1: {{ $residence->contactInfos->telephone }}</b></p>
                    @endif
                    @if(!is_null($residence->contactInfos->alternate_telephone ))
                        <p style="margin-bottom:5px;"><b>Telephone 2: {{ $residence->contactInfos->alternate_telephone }}</b></p>
                    @endif
                    @if(!is_null($residence->contactInfos->email))
                        <p style="margin-bottom:0px;"><b>Email: {{ $residence->contactInfos->email }}</b></p>
                    @endif
                </div>
            </div>
	    </div>
	    <div id="map-div" class="col-sm-6">
	        <div class="thumbnail" style="padding-left:15px; padding-right:15px; height:417px; background-color:white; box-shadow:2px 2px 2px lightgrey">
	            <h4><b>You are almost done...</b></h4>
                <div class="thumbnail">
                    <p style="margin-bottom:5px;"><b>Ready to submit?</b></b></p>
                    <a class="btn btn-success"> Submit <i class="fa fa-check"></i></a>
                    <p style="margin-bottom:5px;"><b>Do you wish to change something?</b></b></p>
                    <a class="btn btn-primary"> Edit <i class="fa fa-edit"></i></a>
                    <p style="margin-bottom:5px;"><b>Not pleased with the outcome at all?</b></b></p>
                    <a class="btn btn-danger" style="margin-bottom:5px;"> Delete <i class="fa fa-times"></i></a>
                </div>
                <div style="margin-left:2px;">
            	    By clicking on submit you accept the<a style="text-decoration:none; cursor:pointer"> Conditions of Use </a>
                	and the <a style="text-decoration:none; cursor:pointer">Privacy Notice</a>.
            	</div>
            </div>    
	    </div>
	</div>
	@if(count($errors->all()) > 0)
        <div class="row" style="padding-left:15px; padding-right:15px;">
        <div class="alert alert-danger colscol-sm-12">
              @foreach($errors->all() as $message) 
                  {{ $message }}
              @endforeach
        </div>
    </div>
    @endif
</div>

@endsection

@section('scripts')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCEZbTqFLGAurA88s8oFkdtWSHbrD-ZD-8&callback=initMap"
        async defer></script>

<script>

    var map;
    
    var geocoder;

    function initMap() {
        
        if($('#map').length)
        {
            map = new google.maps.Map(document.getElementById('map'), {
              zoom: 14,
              center: {lat: -34.397, lng: 150.644}
            });    
        }

    }

    function geocodeAddress(address) {
      
      geocoder = new google.maps.Geocoder();
        
      geocoder.geocode({'address': address}, function(results, status) {
          if (status === 'OK') {
            
            resultsMap = new google.maps.Map(document.getElementById('map'), {
                zoom: 14,
                center: {lat: -34.397, lng: 150.644}
            });
            
            resultsMap.setCenter(results[0].geometry.location);
            var marker = new google.maps.Marker({
              map: resultsMap,
              position: results[0].geometry.location
            });
            
            if($('.mapa').length)
            {
                $('.mapa').css('display:block;');
            }
            
          } else {
              
            alert('We couldnt find your location, please enter a different adress.');
            console.log(status);
            
          }
      });
    }

</script>

<script>
    $(document).ready(function(){
        if($('#location-adress').length){
            geocodeAddress($('#location-adress').html());
        }
    });
</script>

@endsection