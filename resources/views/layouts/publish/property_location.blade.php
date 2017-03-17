@extends('layouts.app')

@section('content')

<div class="container" id="holder">
     <div class="row" style="margin-bottom:10px;">
        <div class="col-sm-12">
            <ul class="nav nav-pills nav-justified">
                <li><a href="publish_property" id="step-1" class="yes-active">
                    <h4 class="list-group-item-heading">Step 1 <i class="fa fa-check" style="color:green"></i></h4>
                    <p class="list-group-item-text">Select type & category</p>
                </a></li>
                <li><a onclick="pageRefresh()" id="step-2" class="yes-active">
                    <h4 class="list-group-item-heading">Step 2</h4>
                    <p class="list-group-item-text">Locate your residence</p>
                </a></li>
                <li><a id="step-3" class="not-active">
                    <h4 class="list-group-item-heading">Step 3</h4>
                    <p class="list-group-item-text">Describe your residence</p>
                </a></li>
                <li><a id="step-4" class="not-active">
                    <h4 class="list-group-item-heading">Step 4</h4>
                    <p class="list-group-item-text">Set price & submit</p>
                </a></li>
            </ul>
        </div>
	</div>
    <div class="row">
        <div id="locator-div" class="col-sm-6">
            <div class="thumbnail" style="height: 417px; background-color:white; width:100%; box-shadow:2px 2px 2px lightgrey">
                <center>
                    <form nam="smarty_street" style="width:80%; text-align:left;">
                      <h4><b>Locate your Residence</b></h4>
                      <div class="form-group">
                          <label for="street" style="text-align:left;">Street</label>
                          <input class="form-control" type="text" id="street-address" name="street" placeholder="Ex: 716 N Husband">
                      </div>
                      <div class="form-group">
                          <label for="city" style="text-align:left; width:100%">City</label>
                          <input class="form-control" type="text" id="city" name="city" placeholder="Ex: Stillwater">
                      </div>
                      <div class="form-group">
                          <label for="state" style="text-align:left; width:100%">State</label>
                          <input class="form-control" type="text" id="state" name="state" placeholder="Ex: OK">
                      </div>
                      <div class="form-group">
                          <label for="zip" style="text-align:left; width:100%">Zipcode</label>
                          <input class="form-control" type="text" id="zip" name="ZIP" placeholder="Ex: 74075">
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
                        <div id="map" onload="initMap()"></div>
                    </center>
                </div>
        </div>
    </div>
    @if(count($errors->all()) > 0)
    <div class="row">
        <div class="alert alert-danger colscol-sm-12">
              @foreach($errors->all() as $message) 
                  {{ $message }}
              @endforeach
        </div>
    </div>
    @endif
    <div class="row" id="acceptance-div">
        <center>
            <div class="col-sm-12">
                <div class="thumbnail col-sm-12" style="background-color:white; box-shadow:2px 2px 2px lightgrey; padding:15px;">
                    <div class="col-sm-6" style="text-align:left;">
                        <div>
                            <h4 style="margin-top:0px; padding-top:0px; margin-bottom:8px"><b>Please verify the information below:</b></h4>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <b>Type:</b> {{ title_case(str_replace('_',' ',\Session::get('publication')->type)) }}
                            </div>
                            <div class="col-sm-6">
                                <b>Category:</b> {{ title_case(str_replace('_',' ',\Session::get('publication')->category)) }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6" id="populate-street"></div>
                            <div class="col-sm-6" id="populate-city"></div>
                        </div>
                        <div id="populate-state"></div>
                        <div id="populate-zipcode"></div>
                        <div id="verification-status">
                            
                        </div>
                        <div id="acceptance-status">
                            <b>Acceptance Status:</b> Accepted <i class="fa fa-check" style="color:green"></i>
                        </div>
                    </div>
                    <form method="GET" action="/describe_property" name="location-form">
                        {{ csrf_field() }}
                        <input id="street_adress" type="hidden" name="street_adress">
                        <input id="city_input" type="hidden" name="city_input">
                        <input id="state_input" type="hidden" name="state_input">
                        <input id="zip_code_input" type="hidden" name="zip_code_input">
                        <button type="submit" id="location-form-submit" style="display:none;"></button>
                    </form>
                    <div class="col-sm-6" >
                        <h4 style="margin-top:0px; padding-top:0px; margin-bottom:0px"><b>If you are happy with your location please continue.</b></h4>
                        <div>
                            <img src="/public_images/check-mark.png" style="width:100px; height:100px;">
                        </div>
                        <button id="trigger-sub-btn" type="button" class="btn btn-primary">Continue</button>
                    </div>
                </div>
            </div>
        </center>
    </div>
</div>

@endsection

@section('scripts')
<script src="//d79i1fxsrar4t.cloudfront.net/jquery.liveaddress/3.2/jquery.liveaddress.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCEZbTqFLGAurA88s8oFkdtWSHbrD-ZD-8&callback=initMap"
        async defer></script>
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
            $('#acceptance-div').css('display', 'block');
            
            $('#populate-street').html('<b>Street:</b>' + ' ' + $('#street-address').val());
            $('#populate-city').html('<b>City:</b>' + ' ' + $('#city').val());
            $('#populate-state').html('<b>State:</b>' + ' ' + $('#state').val());
            $('#populate-zipcode').html('<b>Zipcode:</b>' + ' ' + $('#zip').val());
            
            if( verificationStatus == true) $('#verification-status').html("<b>Verification Status:</b> Verified <i class='fa fa-check' style='color:green'></i>");
            else $('#verification-status').html("<b>Verification Status:</b> Not Verified <i class='fa fa-times' style='color:red'></i>");
            
            $('#acceptance-status').html('<b>Acceptance Status:</b> Accepted <i class="fa fa-check" style="color:green"></i>')
            
            $('#street_adress').val($('#street-address').val());
            $('#city_input').val($('#city').val());
            $('#state_input').val($('#state').val());
            $('#zip_code_input').val($('#zip').val());
            
        }
    }
    
</script>


@endsection