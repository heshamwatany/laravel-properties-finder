@extends('layouts.app')

@section('content')

<div class="container" id="holder">
    <div class="row" style="margin-bottom:10px;">
        <div class="col-sm-12">
            <ul class="nav nav-pills nav-justified">
                <li><a href="/publish_property" id="step-1" class="yes-active">
                    <h4 class="list-group-item-heading">Step 1 <i class="fa fa-check" style="color:green"></i></h4>
                    <p class="list-group-item-text">Select type & category</p>
                </a></li>
                <li><a href="/locate_property" id="step-2" class="yes-active">
                    <h4 class="list-group-item-heading">Step 2 <i class="fa fa-check" style="color:green"></i></h4>
                    <p class="list-group-item-text">Locate your residence</p>
                </a></li>
                <li><a onclick="pageRefresh()" id="step-3" class="yes-active">
                    <h4 class="list-group-item-heading">Step 3</h4>
                    <p class="list-group-item-text">Describe & submit</p>
                </a></li>
                <li><a id="step-4" class="not-active">
                    <h4 class="list-group-item-heading">Step 4</h4>
                    <p class="list-group-item-text">Review & add Photos</p>
                </a></li>
            </ul>
        </div>
	</div>
	@if(count($errors->all()) > 0)
	
        <div class="row">
        <div class="col-sm-12">
            <div class="alert alert-danger col-sm-12">
              @foreach($errors->all() as $message)
                  <b>-{{ $message }}</b></br>
              @endforeach
            </div>
        </div>
    </div>
    
    @endif
    
	<form method="GET" action="/post_residence">
	   
	{{ csrf_field() }}    
	    
	<div class="row"> 
	    
	    <h3 style="padding-left:15px; padding-top:0px; margin-top:0px;"><b>Tell us about your residence:</b></h3>
	    
	    <div class="col-sm-4">
	        <div class="thumbnail" style="text-align:left; background-color:white; box-shadow:2px 2px 2px lightgrey; height:300px; padding:15px; padding-top:0;">
	            <h4><b>1. Yes or No Questions</b></h4>
	            <div class="form-group{{ $errors->has('is_used') ? ' has-error' : '' }}">
    	            <div class="radio">
    	                  <h5 style="padding:0px; margin-bottom:5px;"><b>Is it new (has no one used it)?</b></h5>
                          <label><input class="type-input" type="radio" name="is_used" value="1"
                          @if(old('is_used') == 1) checked @endif>Yes</label>
                          <label style="margin-left:35px;"><input class="type-input" type="radio" name="is_used" value="0"
                          @if(!is_null(old('is_used')) && old('is_used') == 0) checked @endif>No</label>
                    </div>
                </div>
                <div class="form-group{{ $errors->has('has_garden') ? ' has-error' : '' }}">
                    <div class="radio">
                      <h5 style="padding:0px; margin-bottom:5px;"><b>Does it have a garden?</b></h5>
                      <label><input class="type-input" type="radio" name="has_garden" value="1"
                      @if(old('has_garden') == 1) checked @endif>Yes</label>
                      <label style="margin-left:35px;"><input class="type-input" type="radio" name="has_garden" value="0"
                      @if(!is_null(old('has_garden')) && old('has_garden') == 0) checked @endif>No</label>
                    </div>
                </div>
                <div class="form-group{{ $errors->has('has_pool') ? ' has-error' : '' }}">
                    <div class="radio">
                          <h5 style="padding:0px; margin-bottom:5px;"><b>Does it have a pool?</b></h5>
                          <label><input class="type-input" type="radio" name="has_pool" value="1"
                          @if(old('has_pool') == 1) checked @endif>Yes</label>
                          <label style="margin-left:35px;"><input class="type-input" type="radio" name="has_pool" value="0"
                          @if(!is_null(old('has_pool')) && old('has_pool') == 0) checked @endif>No</label>
                    </div>
                </div>
                <div class="form-group{{ $errors->has('is_direct') ? ' has-error' : '' }}">
                    <div class="radio">
                          <h5 style="padding:0px; margin-bottom:5px;"><b>Is it a direct deal (no realtor)?</b></h5>
                          <label><input class="type-input" type="radio" name="is_direct" value="1"
                          @if(old('is_direct') == 1) checked @endif>Yes</label>
                          <label style="margin-left:35px;"><input class="type-input" type="radio" name="is_direct" value="0"
                          @if(!is_null(old('is_direct')) && old('is_direct') == 0) checked @endif>No</label>
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
                          @if(old('pet_friendly') == 1) checked @endif>Yes</label>
                          <label style="margin-left:35px;"><input class="type-input" type="radio" name="pet_friendly" value="0"
                          @if(!is_null(old('pet_friendly')) && old('pet_friendly') == 0) checked @endif>No</label>
                    </div>
                </div>
                <div class="form-group{{ $errors->has('laundry') ? ' has-error' : '' }}">
                    <div class="radio">
                      <h5 style="padding:0px; margin-bottom:5px;"><b>Has Laundry (wahing mashine & dryer)?</b></h5>
                      <label><input class="type-input" type="radio" name="laundry" value="1"
                      @if(old('laundry') == 1) checked @endif>Yes</label>
                      <label style="margin-left:35px;"><input class="type-input" type="radio" name="laundry" value="0"
                      @if(!is_null(old('laundry')) && old('laundry') == 0) checked @endif>No</label>
                    </div>
                </div>
                <div class="form-group{{ $errors->has('furniture_included') ? ' has-error' : '' }}">
                    <div class="radio">
                          <h5 style="padding:0px; margin-bottom:5px;"><b>Is furniture included?</b></h5>
                          <label><input class="type-input" type="radio" name="furniture_included" value="1"
                          @if(old('furniture_included') == 1) checked @endif>Yes</label>
                          <label style="margin-left:35px;"><input class="type-input" type="radio" name="furniture_included" value="0"
                          @if(!is_null(old('furniture_included')) && old('furniture_included') == 0) checked @endif>No</label>
                    </div>
                </div>
                <div class="form-group{{ $errors->has('wifi_included') ? ' has-error' : '' }}">
                    <div class="radio">
                          <h5 style="padding:0px; margin-bottom:5px;"><b>Is wifi included?</b></h5>
                          <label><input class="type-input" type="radio" name="wifi_included" value="1"
                          @if(old('wifi_included') == 1) checked @endif>Yes</label>
                          <label style="margin-left:35px;"><input class="type-input" type="radio" name="wifi_included" value="0"
                          @if(!is_null(old('wifi_included')) && old('wifi_included') == 0) checked @endif>No</label>
                    </div>
                </div>
                <div class="form-group{{ $errors->has('utilities_included') ? ' has-error' : '' }}">
                    <div class="radio">
                          <h5 style="padding:0px; margin-bottom:0px;"><b>Are utilities included?</b></h5>
                          <label><input class="type-input" type="radio" name="utilities_included" value="1"
                          @if(old('utilities_included') == 1) checked @endif>Yes</label>
                          <label style="margin-left:35px;"><input class="type-input" type="radio" name="utilities_included" value="0"
                          @if(!is_null(old('utilities_included')) && old('utilities_included') == 0) checked @endif>No</label>
                    </div>
                </div>
	        </div>
	    </div>
	    <div class="col-sm-4">
	        <div class="thumbnail" style="text-align:left; background-color:white; box-shadow:2px 2px 2px lightgrey; min-height:300px; padding:15px; padding-top:0;">
	            <h4><b>2. Numeric Questions</b></h4>
	            <div class="form-group{{ $errors->has('number_of_rooms') ? ' has-error' : '' }}" style="margin-bottom: 5px">
    	            <div class="radio">
    	                  <h5 style="padding:0px; margin-bottom:5px;"><b>How many rooms does it have?</b></h5>
                          <label><input class="type-input" type="radio" name="number_of_rooms" value="0"
                          @if(!is_null(old('number_of_rooms')) && old('number_of_rooms') == 0) checked @endif>0</label>
                          <label style="margin-left:15px;"><input class="type-input" type="radio" name="number_of_rooms" value="1"
                          @if(old('number_of_rooms') == 1) checked @endif>1</label>
                          <label style="margin-left:15px;"><input class="type-input" type="radio" name="number_of_rooms" value="2"
                          @if(old('number_of_rooms') == 2) checked @endif>2</label>
                          <label style="margin-left:15px;"><input class="type-input" type="radio" name="number_of_rooms" value="3"
                          @if(old('number_of_rooms') == 3) checked @endif>3</label>
                          <label style="margin-left:15px;"><input class="type-input" type="radio" name="number_of_rooms" value="4"
                          @if(old('number_of_rooms') == 4) checked @endif>4</label>
                          <label style="margin-left:15px;"><input class="type-input" type="radio" name="number_of_rooms" value="5"
                          @if(old('number_of_rooms') == 5) checked @endif>5 or more</label>
                    </div>
                </div>
                <div class="form-group{{ $errors->has('number_of_bathrooms') ? ' has-error' : '' }}" style="margin-bottom: 5px">
                    <div class="radio">
    	                  <h5 style="padding:0px; margin-bottom:5px;"><b>How many bathrooms does it have?</b></h5>
                          <label><input class="type-input" type="radio" name="number_of_bathrooms" value="0"
                          @if(!is_null(old('number_of_bathrooms')) && old('number_of_bathrooms') == 0) checked @endif>0</label>
                          <label style="margin-left:15px;"><input class="type-input" type="radio" name="number_of_bathrooms" value="1"
                          @if(old('number_of_bathrooms') == 1) checked @endif>1</label>
                          <label style="margin-left:15px;"><input class="type-input" type="radio" name="number_of_bathrooms" value="2"
                          @if(old('number_of_bathrooms') == 2) checked @endif>2</label>
                          <label style="margin-left:15px;"><input class="type-input" type="radio" name="number_of_bathrooms" value="3"
                          @if(old('number_of_bathrooms') == 3) checked @endif>3</label>
                          <label style="margin-left:15px;"><input class="type-input" type="radio" name="number_of_bathrooms" value="4"
                          @if(old('number_of_bathrooms') == 4) checked @endif>4</label>
                          <label style="margin-left:15px;"><input class="type-input" type="radio" name="number_of_bathrooms" value="5"
                          @if(old('number_of_bathrooms') == 5) checked @endif>5 or more</label>
                    </div>
                </div>
                <div class="form-group{{ $errors->has('parking_spots') ? ' has-error' : '' }}" style="margin-bottom: 5px">
                    <div class="radio">
    	                  <h5 style="padding:0px; margin-bottom:5px;"><b>How many parking spots does it have?</b></h5>
                          <label><input class="type-input" type="radio" name="parking_spots" value="0"
                          @if(!is_null(old('parking_spots')) && old('parking_spots') == 0) checked @endif>0</label>
                          <label style="margin-left:15px;"><input class="type-input" type="radio" name="parking_spots" value="1" 
                          @if(old('parking_spots') == 1) checked @endif>1</label>
                          <label style="margin-left:15px;"><input class="type-input" type="radio" name="parking_spots" value="2"
                          @if(old('parking_spots') == 2) checked @endif>2</label>
                          <label style="margin-left:15px;"><input class="type-input" type="radio" name="parking_spots" value="3"
                          @if(old('parking_spots') == 3) checked @endif>3</label>
                          <label style="margin-left:15px;"><input class="type-input" type="radio" name="parking_spots" value="4"
                          @if(old('parking_spots') == 4) checked @endif>4</label>
                          <label style="margin-left:15px;"><input class="type-input" type="radio" name="parking_spots" value="5"
                          @if(old('parking_spots') == 5) checked @endif>5 or more</label>
                    </div>
                </div>
	        </div>
	    </div>
        
	</div>
	
	<div class="row">
	    
	    <div class="col-sm-4">
	        <div class="thumbnail" style="text-align:left; background-color:white; box-shadow:2px 2px 2px lightgrey; height:300px; padding:15px; padding-top:0;">
	             <h4><b>3. More Specific Questions</b></h4>
	             <center>
	             <div class="form-group{{ $errors->has('area') ? ' has-error' : '' }}" style="margin-bottom: 10px">
    	             <div class="form-group" style="width:80%; text-align:left;">
        	            <label for="area">Area in sq. feet</label>
        	            <input class="form-control area" type="text" name="area" value="{{ old('area') }}">
    	             </div>
	             </div>
	             <div class="form-group{{ $errors->has('construction_area') ? ' has-error' : '' }}" style="margin-bottom: 10px">
    	             <div class="form-group" style="width:80%; text-align:left;">
        	            <label for="area">Construction Area in sq. feet</label>
        	            <input type="hidden">
        	            <input class="form-control area" type="text" name="construction_area" value="{{ old('construction_area') }}">
    	             </div>
	             </div>
	             <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}" style="margin-bottom: 10px">
    	             <div class="form-group" style="width:80%; text-align:left;">
    	                @if(strcasecmp(\Session::get('publication')->category, 'sale') == 0)
            	            <label for="price">Total Price (USD)</label>
            	            <input class="form-control money-total" type="text" name="price" value="{{ old('price') }}">
        	            @else
        	                <label for="area">Price per Month (USD)</label>
            	            <input class="form-control money-rent" type="text" name="price" value="{{ old('price') }}">
        	            @endif
    	             </div>
	             </div>
	             </center>
	        </div>
	    </div>
	    <div class="col-sm-4">
	         <div class="thumbnail" style="text-align:left; background-color:white; box-shadow:2px 2px 2px lightgrey; height:300px;padding:15px; padding-top:0;">
	             <h4><b>4. Description</b> <b id="description-count" style="color:red;" class="pull-right"> 0/190</b></h4>
	             <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}" style="margin-bottom: 10px">
    	             <div class="form-group">
    	                 <label for="title">Title</label>
    	                 <input class="form-control" type="text" name="title" value="{{ old('title') }}">
    	             </div>
	             </div>
	             <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}" style="margin-bottom: 10px">
    	             <div class="form-group">
    	                 <label for="description">Description</label>
    	                 <textarea id="description-area" name="description" class="form-control" style="height:135px;">{{ old('description') }}</textarea>
    	             </div>
	             </div>
	         </div>
	    </div>
	    <div class="col-sm-4">
	         <div class="thumbnail" style="text-align:left; background-color:white; box-shadow:2px 2px 2px lightgrey; height:300px;padding:15px; padding-top:0;">
	             <h4><b>5. Set your contact info (Optional)</b></h4>
	             <center>
    	             <div class="form-group" style="width:80%; text-align:left;">
    	                <div class="form-group{{ $errors->has('telephone') ? ' has-error' : '' }}" style="margin-bottom: 5px"> 
            	            <label for="telephone">Telephone</label>
            	            <input class="form-control phone_us" type="text" name="telephone" value="{{ old('telephone') }}">
        	            </div>
        	            <div class="form-group{{ $errors->has('alternate_telephone') ? ' has-error' : '' }}" style="margin-bottom: 5px">
            	            <label for="alternate_telephone">Alternate Telephone</label>
            	            <input type="hidden">
            	            <input class="form-control phone_us" type="text" name="alternate_telephone" value="{{ old('alternate_telephone') }} }}">
        	            </div>
        	            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}" style="margin-bottom: 5px">
            	            <label for="email">Email</label>
            	            <input class="form-control" type="text" name="email" 
            	            value = @if(!is_null(old('email'))) "{{ old('email') }}" @else"{{ \Auth::user()->email }}" @endif>
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
	             <h4><b>6. Submit</b></h4>
	             <center>
    	             <h4 style="margin-top:0px; padding-top:0px; margin-bottom:0px"><b>If you are pleased with your description please accept and submit.</b></h4>
    	             <div class="form-group{{ $errors->has('accept') ? ' has-error' : '' }}" style="margin-bottom: 5px">
        	             <div  class="checkbox" style="text-align:left;">
        	                 <label><input id="accept" name="accept" type="checkbox" value="accepted">I accept the</label><a style="text-decoration:none; cursor:pointer"> Conditions of Use </a>
        	                 and the <a>Privacy Notice</a>.
        	             </div>
        	         </div>
                     <div>
                        <img class="needs-acceptance" src="https://counselgo-static.s3.amazonaws.com/sl-fileupload/upload-complete.png" style="width:100px; height:100px;">
                     </div>
    	             <button class="btn btn-primary needs-acceptance" type="submit">Submit</button>
	             </center>
	         </div>
	    </div>
	    
	</div>
	
	</form>
	
</div>

@endsection