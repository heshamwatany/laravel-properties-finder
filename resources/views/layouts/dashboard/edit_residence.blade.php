@extends('layouts.app')

@section('content')

<div class="container" id="holder">
    
    <div class="row" style="padding-right:15px; padding-left:15px;">
        <h3 style="padding-left:0px; padding-top:0px; margin-top:0px;"><b>Add or edit pictures:</b></h3>
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
	   <div class="col-sm-12 thumbnail" style="min-height:303px; background-color:white; box-shadow:2px 2px 2px lightgrey; padding:15px; padding-top:0px; margin-bottom:10px;">
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
	    <h3 style="padding-left:15px; padding-top:0px; margin-top:0px;"><b>Edit the information of your residence:</b></h3>
        <div id="locator-div" class="col-sm-6">
            <div class="thumbnail" style="height: 417px; background-color:white; width:100%; box-shadow:2px 2px 2px lightgrey">
                <center>
                    <form nam="smarty_street" style="width:80%; text-align:left;">
                      <b id="location-adress" style="color:red; display:none;">{{ title_case($residence->street_adress) }} {{ title_case($residence->city) }},  {{ title_case($residence->state) }},  {{ title_case($residence->zip_code) }}</b>
                      <h4><b>Locate your Residence</b></h4>
                      <div class="form-group">
                          <label for="street" style="text-align:left;">Street</label>
                          <input class="form-control" type="text" id="street-address" 
                          name="street" placeholder="Ex: 716 N Husband" value="{{$residence->street_adress}}">
                      </div>
                      <div class="form-group">
                          <label for="city" style="text-align:left; width:100%">City</label>
                          <input class="form-control" type="text" id="city" 
                          name="city" placeholder="Ex: Stillwater" value="{{$residence->city}}">
                      </div>
                      <div class="form-group">
                          <label for="state" style="text-align:left; width:100%">State</label>
                          <input class="form-control" type="text" id="state" 
                          name="state" placeholder="Ex: OK" value="{{$residence->state}}">
                      </div>
                      <div class="form-group">
                          <label for="zip" style="text-align:left; width:100%">Zipcode</label>
                          <input class="form-control" type="text" id="zip" 
                          name="ZIP" placeholder="Ex: 74075" value="{{$residence->zip_code}}">
                      </div>
                      <div class="form-group">
                          <button type="button" id="submit-btn" class="btn btn-success" style="color:white; width:100%">Verify</button>
                      </div>
                    </form>
                </center>
            </div>
        </div>
        <div id="map-div" class="col-sm-6">
                <div class="thumbnail" style="height:417px; background-color:white; box-shadow:2px 2px 2px lightgrey">
                    <center>
                        <div id="map" class="mapa"></div>
                    </center>
                </div>
        </div>
    </div>
	
	<form method="POST" action="/edit_residence/{{ $residence->id }}">
	   
    	{{ csrf_field() }}  {{ method_field('PATCH') }}   
    	
    	@if(count($errors->all()) > 0)
            <div class="row" style="padding-left:15px; padding-right:15px;">
                <div class="alert alert-danger col-sm-12">
                    @foreach($errors->all() as $message) 
                        {{ $message }}
                    @endforeach
                </div>
            </div>
        @endif
    	    
    	<div class="row" > 
    	    
    	    <div class="col-sm-4">
                <div class="thumbnail" style="text-align:left; background-color:white; box-shadow:2px 2px 2px lightgrey; height:300px; padding:15px; padding-top:0;">
                    <h4><b>1. Verify location</b></h4>
                    
                    <div id="populate-street"></div>
                    <div id="populate-city"></div>
                    <div id="populate-state"></div>
                    <div id="populate-zipcode"></div>
           
                    <div>
                        <div id="acceptance-status">
                            <b>Acceptance Status:</b> Accepted <i class="fa fa-check" style="color:green"></i>
                        </div>
                    </div>
                    
                    <div id="location-error" class="alert alert-danger" style="display:none;">
                        The location you entered couldn't be verified, please try again.
                    </div>
                    
                    <input id="street_adress" type="hidden" name="street_adress" value="{{$residence->street_adress}}">
                    <input id="city_input" type="hidden" name="city_input" value="{{$residence->city}}">
                    <input id="state_input" type="hidden" name="state_input" value="{{$residence->state}}">
                    <input id="zip_code_input" type="hidden" name="zip_code_input" value="{{$residence->zip_code}}">
                    
                </div>
            </div>
    	    <div class="col-sm-4">
                <div class="thumbnail" style="text-align:left; background-color:white; box-shadow:2px 2px 2px lightgrey; height:300px; padding:15px; padding-top:0;">
                    <h4><b>2. Choose residence type</b></h4>
                    <div class="radio">
                      <label><input desc="House" class="type-input" type="radio" name="type" value="house" 
                      @if(strcasecmp(old('type'), 'house') == 0 || strcasecmp($residence->type, 'house') == 0) checked @endif >House</input></label>
                    </div>
                    <div class="radio">
                      <label><input desc="Appartment" class="type-input" type="radio" name="type" value="appartment"
                      @if(strcasecmp(old('type'), 'appartment') == 0 || strcasecmp($residence->type, 'appartment') == 0) checked @endif >Appartment</input></label>
                    </div>
                    <div class="radio">
                      <label><input desc="Commercial Space" class="type-input" type="radio" name="type" value="commercial_space"
                      @if(strcasecmp(old('type'), 'commercial_space') == 0 || strcasecmp($residence->type, 'commercial_space') == 0) checked @endif >Commercial Space</input></label>
                    </div>
                    <div class="radio">
                      <label><input desc="Office Space" class="type-input" type="radio" name="type" value="office_space"
                      @if(strcasecmp(old('type'), 'office_space') == 0 || strcasecmp($residence->type, 'office_space') == 0) checked @endif >Office Space</input></label>
                    </div>
                </div>
                </div>
            <div class="col-sm-4">
                <div class="thumbnail" style="text-align:left; background-color:white; box-shadow:2px 2px 2px lightgrey; height:300px; padding:15px; padding-top:0;">
                    <h4><b>3. Choose residence category</b></h4>
                    <div class="radio">
                      <label><input desc="Rent" class="category-input" type="radio" name="category" value="rent"
                        @if(strcasecmp(old('category'), 'rent') == 0 || strcasecmp($residence->category, 'rent') == 0) checked @endif>Rent
                      </input></label>
                    </div>
                    <div class="radio">
                      <label><input desc="Lease Takeover" class="category-input" type="radio" name="category" value="lease_takeover"
                        @if(strcasecmp(old('category'), 'lease_takeover') == 0 || strcasecmp($residence->category, 'lease_takeover') == 0) checked @endif>Lease Takeover
                      </input></label>
                    </div>
                    <div class="radio">
                      <label><input desc="Shared Rent" class="category-input" type="radio" name="category" value="shared_rent"
                        @if(strcasecmp(old('category'), 'shared_rent') == 0 || strcasecmp($residence->category, 'shared_rent') == 0) checked @endif>Shared Rent
                      </input></label>
                    </div>
                </div>
            </div>
            
    	</div>
    	
    	<div class="row">
    	    
    	    <div class="col-sm-4">
    	        <div class="thumbnail" style="text-align:left; background-color:white; box-shadow:2px 2px 2px lightgrey; height:300px; padding:15px; padding-top:0;">
    	             <h4><b>4. More Specific Questions</b></h4>
    	             <center>
    	             <div class="form-group{{ $errors->has('area') ? ' has-error' : '' }}" style="margin-bottom: 10px">
        	             <div class="form-group" style="width:80%; text-align:left;">
            	            <label for="area">Area in sq. feet</label>
            	            <input class="form-control area" type="text" name="area" 
            	                value="@if(!is_null(old('area'))) {{ old('area') }} @else {{ $residence->area }} @endif">
        	             </div>
    	             </div>
    	             <div class="form-group{{ $errors->has('construction_area') ? ' has-error' : '' }}" style="margin-bottom: 10px">
        	             <div class="form-group" style="width:80%; text-align:left;">
            	            <label for="construction_area">Construction Area in sq. feet</label>
            	            <input type="hidden">
            	            <input class="form-control area" type="text" name="construction_area"
            	                value="@if(!is_null(old('construction_area'))){{old('construction_area')}}@else{{$residence->construction_area }}@endif"/>
        	             </div>
    	             </div>
    	             <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}" style="margin-bottom: 10px">
        	             <div class="form-group" style="width:80%; text-align:left;">
        	                @if(strcasecmp($residence->category, 'sale') == 0)
                	            <label for="price">Total Price (USD)</label>
                	            <input class="form-control money-total" type="text" name="price" 
                	                value="@if(!is_null(old('price'))) {{ old('price') }} @else {{ $residence->price }} @endif">
            	            @else
            	                <label for="area">Price per Month (USD)</label>
                	            <input class="form-control money-rent" type="text" name="price" 
                	                value="@if(!is_null(old('price'))) {{ old('price') }} @else {{ $residence->price }} @endif">
            	            @endif
        	             </div>
    	             </div>
    	             </center>
    	        </div>
    	</div>
    	    <div class="col-sm-4">
    	        <div class="thumbnail" style="text-align:left; background-color:white; box-shadow:2px 2px 2px lightgrey; height:300px; padding:15px; padding-top:0;">
    	            <h4><b>5. Yes or No Questions</b></h4>
    	            <div class="form-group{{ $errors->has('is_used') ? ' has-error' : '' }}">
        	            <div class="radio">
        	                  <h5 style="padding:0px; margin-bottom:5px;"><b>Is it new (has no one used it)?</b></h5>
                              <label><input class="type-input" type="radio" name="is_used" value="1"
                              @if(old('is_used') == 1 || (is_null(old('is_used')) && $residence->is_used == 1)) checked @endif>Yes</label>
                              <label style="margin-left:35px;"><input class="type-input" type="radio" name="is_used" value="0"
                              @if((!is_null(old('is_used')) && old('is_used') == 0) || (is_null(old('is_used')) && $residence->is_used == 0))) checked @endif>No</label>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('has_garden') ? ' has-error' : '' }}">
                        <div class="radio">
                          <h5 style="padding:0px; margin-bottom:5px;"><b>Does it have a garden?</b></h5>
                          <label><input class="type-input" type="radio" name="has_garden" value="1"
                          @if(old('has_garden') == 1 || (is_null(old('has_garden')) && $residence->has_garden == 1)) checked @endif>Yes</label>
                          <label style="margin-left:35px;"><input class="type-input" type="radio" name="has_garden" value="0"
                          @if((!is_null(old('has_garden')) && old('has_garden') == 0) || (is_null(old('has_garden')) && $residence->has_garden == 0))) checked @endif>No</label>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('has_pool') ? ' has-error' : '' }}">
                        <div class="radio">
                              <h5 style="padding:0px; margin-bottom:5px;"><b>Does it have a pool?</b></h5>
                              <label><input class="type-input" type="radio" name="has_pool" value="1"
                              @if(old('has_pool') == 1 || (is_null(old('has_pool')) && $residence->has_pool == 1)) checked @endif>Yes</label>
                              <label style="margin-left:35px;"><input class="type-input" type="radio" name="has_pool" value="0"
                              @if((!is_null(old('has_pool')) && old('has_pool') == 0) || (is_null(old('has_pool')) && $residence->has_garden == 0))) checked @endif>No</label>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('is_direct') ? ' has-error' : '' }}">
                        <div class="radio">
                              <h5 style="padding:0px; margin-bottom:5px;"><b>Is it a direct deal (no realtor)?</b></h5>
                              <label><input class="type-input" type="radio" name="is_direct" value="1"
                              @if(old('is_direct') == 1 || (is_null(old('is_direct')) && $residence->is_direct == 1)) checked @endif>Yes</label>
                              <label style="margin-left:35px;"><input class="type-input" type="radio" name="is_direct" value="0"
                              @if((!is_null(old('is_direct')) && old('is_direct') == 0) || (is_null(old('is_direct')) && $residence->has_garden == 0))) checked @endif>No</label>
                        </div>
                    </div>
    	        </div>
    	</div>
    	    <div class="col-sm-4">
	        <div class="thumbnail" style="text-align:left; background-color:white; box-shadow:2px 2px 2px lightgrey; min-height:300px; padding:15px; padding-top:0; padding-bottom:0px;">
	            <div class="form-group{{ $errors->has('pet_friendly') ? ' has-error' : '' }}">
    	            <div class="radio">
    	                  <h5 style="padding:0px; margin-bottom:5px;"><b>Is it pet friendly?</b></h5>
                          <label><input class="type-input" type="radio" name="pet_friendly" value="1"
                          @if(old('pet_friendly') == 1 || (is_null(old('pet_friendly')) && $residence->pet_friendly == 1)) checked @endif>Yes</label>
                          <label style="margin-left:35px;"><input class="type-input" type="radio" name="pet_friendly" value="0"
                          @if((!is_null(old('pet_friendly')) && old('pet_friendly') == 0) || (is_null(old('pet_friendly')) && $residence->pet_friendly == 0))) checked @endif>No</label>
                    </div>
                </div>
                <div class="form-group{{ $errors->has('laundry') ? ' has-error' : '' }}">
                    <div class="radio">
                      <h5 style="padding:0px; margin-bottom:5px;"><b>Has Laundry (wahing mashine & dryer)?</b></h5>
                      <label><input class="type-input" type="radio" name="laundry" value="1"
                      @if(old('laundry') == 1 || (is_null(old('laundry')) && $residence->laundry == 1)) checked @endif>Yes</label>
                      <label style="margin-left:35px;"><input class="type-input" type="radio" name="laundry" value="0"
                      @if((!is_null(old('laundry')) && old('laundry') == 0) || (is_null(old('laundry')) && $residence->laundry == 0))) checked @endif>No</label>
                    </div>
                </div>
                <div class="form-group{{ $errors->has('furniture_included') ? ' has-error' : '' }}">
                    <div class="radio">
                          <h5 style="padding:0px; margin-bottom:5px;"><b>Is furniture included?</b></h5>
                          <label><input class="type-input" type="radio" name="furniture_included" value="1"
                           @if(old('furniture_included') == 1 || (is_null(old('furniture_included')) && $residence->furniture_included == 1)) checked @endif>Yes</label>
                          <label style="margin-left:35px;"><input class="type-input" type="radio" name="furniture_included" value="0"
                          @if((!is_null(old('furniture_included')) && old('furniture_included') == 0) || (is_null(old('furniture_included')) && $residence->furniture_included == 0))) checked @endif>No</label>
                    </div>
                </div>
                <div class="form-group{{ $errors->has('wifi_included') ? ' has-error' : '' }}">
                    <div class="radio">
                          <h5 style="padding:0px; margin-bottom:5px;"><b>Is wifi included?</b></h5>
                          <label><input class="type-input" type="radio" name="wifi_included" value="1"
                          @if(old('wifi_included') == 1 || (is_null(old('wifi_included')) && $residence->wifi_included == 1)) checked @endif>Yes</label>
                          <label style="margin-left:35px;"><input class="type-input" type="radio" name="wifi_included" value="0"
                          @if((!is_null(old('wifi_included')) && old('wifi_included') == 0) || (is_null(old('wifi_included')) && $residence->wifi_included == 0))) checked @endif>No</label>
                    </div>
                </div>
                <div class="form-group{{ $errors->has('utilities_included') ? ' has-error' : '' }}">
                    <div class="radio">
                          <h5 style="padding:0px; margin-bottom:0px;"><b>Are utilities included?</b></h5>
                          <label><input class="type-input" type="radio" name="utilities_included" value="1"
                          @if(old('utilities_included') == 1 || (is_null(old('utilities_included')) && $residence->utilities_included == 1)) checked @endif>Yes</label>
                          <label style="margin-left:35px;"><input class="type-input" type="radio" name="utilities_included" value="0"
                          @if((!is_null(old('utilities_included')) && old('utilities_included') == 0) || (is_null(old('utilities_included')) && $residence->utilities_included == 0))) checked @endif>No</label>
                    </div>
                </div>
	        </div>
	    </div>

    	</div>
    	
    	<div class="row">
    	    
    	    <div class="col-sm-4">
    	        <div class="thumbnail" style="text-align:left; background-color:white; box-shadow:2px 2px 2px lightgrey; height:300px; padding:15px; padding-top:0;">
    	            <h4><b>6. Numeric Questions</b></h4>
    	            <div class="form-group{{ $errors->has('number_of_rooms') ? ' has-error' : '' }}" style="margin-bottom: 5px">
        	            <div class="radio">
        	                  <h5 style="padding:0px; margin-bottom:5px;"><b>How many rooms does it have?</b></h5>
                              <label><input class="type-input" type="radio" name="number_of_rooms" value="0"
                              @if((!is_null(old('number_of_rooms')) && old('number_of_rooms') == 0) 
                                || (is_null(old('number_of_rooms')) && $residence->number_of_rooms == 0))) checked @endif>0</label>
                              <label style="margin-left:15px;"><input class="type-input" type="radio" name="number_of_rooms" value="1"
                              @if(old('number_of_rooms') == 1 || (is_null(old('number_of_rooms')) && $residence->number_of_rooms == 1)) checked @endif>1</label>
                              <label style="margin-left:15px;"><input class="type-input" type="radio" name="number_of_rooms" value="2"
                              @if(old('number_of_rooms') == 2 || (is_null(old('number_of_rooms')) && $residence->number_of_rooms == 2)) checked @endif>2</label>
                              <label style="margin-left:15px;"><input class="type-input" type="radio" name="number_of_rooms" value="3"
                              @if(old('number_of_rooms') == 3 || (is_null(old('number_of_rooms')) && $residence->number_of_rooms == 3)) checked @endif>3</label>
                              <label style="margin-left:15px;"><input class="type-input" type="radio" name="number_of_rooms" value="4"
                              @if(old('number_of_rooms') == 4 || (is_null(old('number_of_rooms')) && $residence->number_of_rooms == 4)) checked @endif>4</label>
                              <label style="margin-left:15px;"><input class="type-input" type="radio" name="number_of_rooms" value="5"
                              @if(old('number_of_rooms') == 5 || (is_null(old('number_of_rooms')) && $residence->number_of_rooms == 5)) checked @endif>5 or more</label>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('number_of_bathrooms') ? ' has-error' : '' }}" style="margin-bottom: 5px">
                        <div class="radio">
        	                  <h5 style="padding:0px; margin-bottom:5px;"><b>How many bathrooms does it have?</b></h5>
                              <label><input class="type-input" type="radio" name="number_of_bathrooms" value="0"
                              @if((!is_null(old('number_of_bathrooms')) && old('number_of_bathrooms') == 0) 
                                || (is_null(old('number_of_bathrooms')) && $residence->number_of_bathrooms == 0))) checked @endif>0</label>
                              <label style="margin-left:15px;"><input class="type-input" type="radio" name="number_of_bathrooms" value="1"
                              @if(old('number_of_bathrooms') == 1 || (is_null(old('number_of_bathrooms')) && $residence->number_of_bathrooms == 1)) checked @endif>1</label>
                              <label style="margin-left:15px;"><input class="type-input" type="radio" name="number_of_bathrooms" value="2"
                              @if(old('number_of_bathrooms') == 2 || (is_null(old('number_of_bathrooms')) && $residence->number_of_bathrooms == 2)) checked @endif>2</label>
                              <label style="margin-left:15px;"><input class="type-input" type="radio" name="number_of_bathrooms" value="3"
                              @if(old('number_of_bathrooms') == 3 || (is_null(old('number_of_bathrooms')) && $residence->number_of_bathrooms == 3)) checked @endif>3</label>
                              <label style="margin-left:15px;"><input class="type-input" type="radio" name="number_of_bathrooms" value="4"
                              @if(old('number_of_bathrooms') == 4 || (is_null(old('number_of_bathrooms')) && $residence->number_of_bathrooms == 4)) checked @endif>4</label>
                              <label style="margin-left:15px;"><input class="type-input" type="radio" name="number_of_bathrooms" value="5"
                              @if(old('number_of_bathrooms') == 5 || (is_null(old('number_of_bathrooms')) && $residence->number_of_bathrooms == 5)) checked @endif>5 or more</label>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('parking_spots') ? ' has-error' : '' }}" style="margin-bottom: 5px">
                        <div class="radio">
        	                  <h5 style="padding:0px; margin-bottom:5px;"><b>How many parking spots does it have?</b></h5>
                              <label><input class="type-input" type="radio" name="parking_spots" value="0"
                              @if((!is_null(old('parking_spots')) && old('parking_spots') == 0)  
                                || (is_null(old('parking_spots')) && $residence->parking_spots == 0))) checked @endif>0</label>
                              <label style="margin-left:15px;"><input class="type-input" type="radio" name="parking_spots" value="1" 
                              @if(old('parking_spots') == 1 || (is_null(old('parking_spots')) && $residence->parking_spots == 1)) checked @endif>1</label>
                              <label style="margin-left:15px;"><input class="type-input" type="radio" name="parking_spots" value="2"
                              @if(old('parking_spots') == 2 || (is_null(old('parking_spots')) && $residence->parking_spots == 2)) checked @endif>2</label>
                              <label style="margin-left:15px;"><input class="type-input" type="radio" name="parking_spots" value="3"
                              @if(old('parking_spots') == 3 || (is_null(old('parking_spots')) && $residence->parking_spots == 3)) checked @endif>3</label>
                              <label style="margin-left:15px;"><input class="type-input" type="radio" name="parking_spots" value="4"
                              @if(old('parking_spots') == 4 || (is_null(old('parking_spots')) && $residence->parking_spots == 4)) checked @endif>4</label>
                              <label style="margin-left:15px;"><input class="type-input" type="radio" name="parking_spots" value="5"
                              @if(old('parking_spots') == 5 || (is_null(old('parking_spots')) && $residence->parking_spots == 5)) checked @endif>5 or more</label>
                        </div>
                    </div>
    	        </div>
    	    </div>
    	    <div class="col-sm-4">
    	         <div class="thumbnail" style="text-align:left; background-color:white; box-shadow:2px 2px 2px lightgrey; height:300px;padding:15px; padding-top:0;">
    	             <h4><b>7. Description</b> <b id="description-count" style="color:red;" class="pull-right"> 0/190</b></h4>
    	             <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}" style="margin-bottom: 10px">
        	             <div class="form-group">
        	                 <label for="title">Title</label>
        	                 <input class="form-control" type="text" name="title" 
        	                    value="@if(!is_null(old('title'))){{old('title')}}@else{{$residence->descriptions->title}}@endif">
        	             </div>
    	             </div>
    	             <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}" style="margin-bottom: 10px">
        	             <div class="form-group">
        	                 <label for="description">Description</label>
        	                 @if(!is_null(old('description')))
        	                 <textarea id="description-area" name="description" class="form-control" style="height:135px;">{{old('description')}}</textarea>
        	                 @else
        	                 <textarea id="description-area" name="description" class="form-control" style="height:135px;">{{$residence->descriptions->description}}</textarea>
        	                 @endif
        	             </div>
    	             </div>
    	         </div>
    	</div>
    	    <div class="col-sm-4">
    	         <div class="thumbnail" style="text-align:left; background-color:white; box-shadow:2px 2px 2px lightgrey; height:300px;padding:15px; padding-top:0;">
    	             <h4><b>8. Set your contact info (Optional)</b></h4>
    	             <center>
        	             <div class="form-group" style="width:80%; text-align:left;">
        	                <div class="form-group{{ $errors->has('telephone') ? ' has-error' : '' }}" style="margin-bottom: 5px"> 
                	            <label for="telephone">Telephone</label>
                	            <input class="form-control phone_us" type="text" name="telephone" value="@if(!is_null(old('telephone'))){{old('telephone')}}@else{{$residence->contactInfos->telephone}}@endif">
            	            </div>
            	            <div class="form-group{{ $errors->has('alternate_telephone') ? ' has-error' : '' }}" style="margin-bottom: 5px">
                	            <label for="alternate_telephone">Alternate Telephone</label>
                	            <input type="hidden">
                	            <input class="form-control phone_us" type="text" name="alternate_telephone" value="@if(!is_null(old('alternate_telephone'))){{old('alternate_telephone')}}@else{{$residence->contactInfos->alternate_telephone}}@endif">
            	            </div>
            	            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}" style="margin-bottom: 5px">
                	            <label for="email">Email</label>
                	            <input class="form-control" type="text" name="email" 
                	            value = @if(!is_null(old('email'))) "{{ old('email') }}" @else"{{$residence->contactInfos->email}}" @endif>
            	            </div>
            	            <p style="font-size:9px;">*If you provide this information everyone will be able to see it.</p>
        	             </div>
    	             </center>
    	         </div>
    	    </div>

    	</div>
	    
	    <div class="row">
	        
	        <div class="col-sm-4">
    	         <div class="thumbnail" style="text-align:left; background-color:white; box-shadow:2px 2px 2px lightgrey; height:300px;padding:15px; padding-top:0;">
    	             <h4><b>9. Decide what to do</b></h4>
    	             <p style="margin-bottom:5px;"><b>Active?</b></b></p>
    	             <input checked data-toggle="toggle" name="priority" type="checkbox">
    	             <p style="margin-bottom:5px;"><b>Ready to submit?</b></b></p>
                     <button type="submit" class="btn btn-success"> Submit <i class="fa fa-check"></i></button>
    	             <p style="margin-bottom:5px;"><b>Not pleased with the outcome at all?</b></b></p>
                     <a class="btn btn-danger" style="margin-bottom:5px;"> Delete <i class="fa fa-times"></i></a>
    	         </div>
    	    </div>
	        
	    </div>
	    
	</form>
	
	
</div>

@endsection

@section('scripts')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCEZbTqFLGAurA88s8oFkdtWSHbrD-ZD-8&callback="
        async defer></script>
<script src="//d79i1fxsrar4t.cloudfront.net/jquery.liveaddress/3.2/jquery.liveaddress.min.js"></script>
<script>

var liveaddress = $.LiveAddress({
	key: "33054751632348030",
	debug: false,
	target: "US",
	geocode: true,
	autocomplete: 5,
	autoVerify: false,
	submitSelector: "#submit",
	addresses: [{
		address1: '#street-address',
		locality: '#city',
		administrative_area: '#state',
		postal_code: '#zip',
	}]
});

var verificationStatus = false;

liveaddress.on("AddressAccepted", function (event, data, previousHandler) {
	var address = data.address.get('address1') + " " + 
        data.address.get('locality') + " " +
        data.address.get('administrative_area') + " " +
        data.address.get('postal_code');
    
    previousHandler(event, data);
    
    geocodeAddress(address);
    
    verificationStatus = true;
});

liveaddress.on("Completed", function(event, data, previousHandler)
{
    var address = data.address.get('address1') + " " + 
        data.address.get('locality') + " " +
        data.address.get('administrative_area') + " " +
        data.address.get('postal_code');
    
    previousHandler(event, data);
    
    geocodeAddress(address);
    
    verificationStatus = false;
});

liveaddress.on("AutocompleteUsed", function(){
    $('#zip').focus();
});

$('#submit-btn').click(function(){
    
    if($('#street-address').val() != "" &&
        $('#city').val() != "" &&
        $('#state').val() != "" &&
        $('#zip').val() != "")
    {
        $('.smarty-tag').trigger('click');
        $('.smarty-tag').css('visibility', 'visible');    
    }
    else{
        
        alert('Please fill out the required fields.');
        
        if($('#street-address').val() == "") $('#street-address').css('border', '1px solid red');
        
        if($('#city').val() == "") $('#city').css('border', '1px solid red');
        
        if($('#state').val() == "") $('#state').css('border', '1px solid red');
        
        if($('#zip').val() == "") $('#zip').css('border', '1px solid red');
        
    }
    
});
</script>
<script>

    var map;
    
    var geocoder;

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
            
            displayAcceptance(true);
            
            if($('.mapa').length)
            {
                $('.mapa').css('display:block;');
            }
            
          } else {
              
            alert('We couldnt find your location, please enter a different adress.');
            displayAcceptance(false);
            console.log(status);
            
          }
      });
    }
    
    function displayAcceptance(bool)
    {
        $('#street-address').css('border', '');
        $('#city').css('border', '');
        $('#state').css('border', '');
        $('#zip').css('border', '');
        
        if(bool == true)
        {
            
            $('#populate-street').html('<b>Street:</b>' + ' ' + $('#street-address').val());
            $('#populate-city').html('<b>City:</b>' + ' ' + $('#city').val());
            $('#populate-state').html('<b>State:</b>' + ' ' + $('#state').val());
            $('#populate-zipcode').html('<b>Zipcode:</b>' + ' ' + $('#zip').val());
            
            $('#acceptance-status').html('<b>Acceptance Status:</b> Accepted <i class="fa fa-check" style="color:green"></i>')
            
            $('#street_adress').val($('#street-address').val());
            $('#city_input').val($('#city').val());
            $('#state_input').val($('#state').val());
            $('#zip_code_input').val($('#zip').val());
            
        }
        else
        {
            $('#location-error').css('display', 'block');
        }
        
    }
    
</script>
<script>
    $(document).ready(function(){
        if($('#location-adress').length){
            geocodeAddress($('#location-adress').html());
        }
    });
</script>
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
@endsection