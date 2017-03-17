@extends('layouts.app')

@section('content')
<div class="container" id="holder">
    <div class="row" style="padding-top:10px;">
        
        <div class="col-sm-3">
            <div class="thumbnail" style="background-color:white; box-shadow:2px 2px 2px lightgrey;">
            
                @if(count($residence->photos()->where('is_profile', '=', true)->get()) > 0)
                <img class="img-responsive" 
                    src="{{ $residence->photos()->where('is_profile', '=', true)->get()->offsetGet(0)->path }}"
                    style="height:auto; width:100%; border-radius:3px;">
                @else
                <img class="img-responsive" 
                    src="https://img.clipartfest.com/5f4ec6f8745b5dbc47b6a57a875f226a_simple-orange-house-clip-art-house-clipart-images-png_298-282.png"
                    style="height:auto; width:100%; border-radius:3px;">
                @endif
                
                <h4 style="margin:5px;"><b>{{ title_case($residence->descriptions->title) }}</b></h4>
                
                <h5 style="margin:5px;"><b>{{ title_case(str_replace('_', ' ', $residence->type)) }} for {{ title_case(str_replace('_', ' ', $residence->category)) }}</b></h5>
                
                <h5 style="margin:5px;"><b>{{ title_case($residence->street_adress) }}, {{ $residence->city }}, {{ $residence->state }}, {{ $residence->zip_code }}</b></h5>
                
                @if(strlen($residence->contactInfos->telephone) > 0)
                    <h5 style="margin:5px;">
                        <b>Telephone 1:</b> {{ $residence->contactInfos->telephone }}
                    </h5>
                @endif
                
                @if(strlen($residence->contactInfos->alternate_telephone) > 0)
                    <h5 style="margin:5px;">
                        <b>Telephone 2:</b> {{ $residence->contactInfos->alternate_telephone }}
                    </h5>
                @endif
                
                @if(strlen($residence->contactInfos->email) > 0)
                    <h5 style="margin:5px;">
                        <b>Email:</b> {{ $residence->contactInfos->email }}
                    </h5>
                @endif
                
                <center>
                    
                    <div id="btn-container">
                        @if(\Session::has('residence' . $residence->id))
                            <button type="button" class="btn btn-success disabled" style="width:100%; margin-bottom:5px;">Contacted <i class="fa fa-check"></i></button>
                        @else
                            <button data-toggle="modal" data-target="#myModal" type="button" class="btn btn-success" style="width:100%; margin-bottom:5px;">
                                <i class="fa fa-address-book"></i> Contact
                            </button>
                        @endif
                    </div>
                    @if(\Auth::user() && count(\Auth::user()->favorites->favoriteItems()->get()->where('residence_id', '=', $residence->id)) == 0)
                        <button id="fav-button" onclick="submitToFavorites()" type="button" class="btn btn-primary" style="width:100%; margin-bottom:5px;">
                            Add to Favorites <i style="font-size:15px;" class="fa fa-heart"></i> 
                        </button>
                    @elseif(\Auth::user() && count(\Auth::user()->favorites->favoriteItems()->get()->where('residence_id', '=', $residence->id)) > 0)
                        <button type="button" class="btn btn-primary disabled" style="width:100%; margin-bottom:5px;">In Favorites <i class="fa fa-check"></i></button>
                    @else
                        <a type="button" href="/favorites/{{ $residence->id }}" class="btn btn-primary" style="width:100%; margin-bottom:5px;">
                            Add to Favorites <i style="font-size:15px;" class="fa fa-heart"></i> 
                        </a>
                    @endif
                </center>
            </div>

            <div class="thumbnail" style="background-color:white; box-shadow:2px 2px 2px lightgrey;">
                <h4 style="margin:5px;"><b>General Information:</b></h4>
                <h5 style="margin:5px;"><b>Number of Rooms:</b> {{ $residence->number_of_rooms }}</h5>
                <h5 style="margin:5px;"><b>Number of Bathrooms:</b> {{ $residence->number_of_bathrooms }}</h5>
                <h5 style="margin:5px;"><b>Parking Spots:</b> {{ $residence->parking_spots }}</h5>
                <h5 style="margin:5px;"><b>New:</b> @if($residence->is_used == 1) No @else Yes @endif</h5>
                <h5 style="margin:5px;"><b>Pool:</b> @if($residence->has_pool == 1) Yes @else No @endif</h5>
                <h5 style="margin:5px;"><b>Garden:</b> @if($residence->has_garden == 1) Yes @else No @endif</h5>
                <h5 style="margin:5px;"><b>Pet Friendly:</b> @if($residence->pet_friendly == 1) Yes @else No @endif</h5>
                <h5 style="margin:5px;"><b>Wifi Included:</b> @if($residence->wifi_included == 1) Yes @else No @endif</h5>
                <h5 style="margin:5px;"><b>Utilities Included:</b> @if($residence->utilities_included == 1) Yes @else No @endif</h5>
                <h5 style="margin:5px;"><b>Furniture Included:</b> @if($residence->furniture_included == 1) Yes @else No @endif</h5>
                <h5 style="margin:5px;"><b>Laundry:</b> @if($residence->wifi_included == 1) Yes @else No @endif</h5>
            </div>
            
            <div class="thumbnail" style="background-color:white; box-shadow:2px 2px 2px lightgrey;">
                <h4 style="margin:5px;"><b>Specifics:</b></h4>
                <h5 style="margin:5px;"><b>Area:</b> {{ $residence->area }} sq. feet</h5>
                <h5 style="margin:5px;"><b>Construction Area:</b> {{ $residence->construction_area }} sq. feet</h5>
                <h5 style="margin:5px;"><b>Price:</b> $ {{ $residence->price }} 
                @if(strcasecmp($residence->type, 'sale') != 0) per month @endif</h5>
            </div>
            
            <div class="thumbnail" style="background-color:white; box-shadow:2px 2px 2px lightgrey;">
                <h4 style="margin:5px;"><b>Description:</b></h4>
                <p style="margin:5px;">
                    {{ $residence->descriptions->description }}
                </p>
            </div>
            
            <div class="thumbnail" style="background-color:white; box-shadow:2px 2px 2px lightgrey;">
                <h4 style="margin:5px;"><b>Did you see something you didn't like?</b></h4>
                <p style="margin:5px;">
                    Please press the button below and we will take care of it?
                </p>
                @if($residence->is_reported == false)
                <button onclick="reportResidence()" id="report-btn" type="button" class="btn btn-danger" style="width:100%">
                        Report <i class="fa fa-eye-slash"></i>
                </button>
                @else
                <button id="report-btn" type="button" class="btn btn-danger disabled" style="width:100%">
                        Reported <i class="fa fa-check"></i>
                </button>
                @endif
            </div>
             
        </div>
        
        <div class="col-sm-9" style="min-height:500px;">

            <div class="thumbnail" style="min-height:500px; background-color:white; box-shadow:2px 2px 2px lightgrey; padding:15px; padding-top:0px;">
                <h3 style="margin-top:3px; padding-top:3px;"><b>{{ $residence->descriptions->title }}</b></h3>
                <div class="galleria" style="min-height:490px; border-radius:3px;">
                    @if(count($residence->photos()->get()))
                        @if(count($residence->photos()->where('is_profile', '=', true)->get()) > 0)
                            <img class="img-gal" src="{{ $residence->photos()->where('is_profile', '=', true)->get()->offsetGet(0)->path }}">
                        @endif
                        @foreach($residence->photos()->where('is_profile', '=', false)->get() as $photo)
                            <img class="img-gal" src="{{ $photo->path }}">
                        @endforeach
                    @else
                    <img class="img-gal" src="https://img.clipartfest.com/5f4ec6f8745b5dbc47b6a57a875f226a_simple-orange-house-clip-art-house-clipart-images-png_298-282.png">
                    @endif
                </div>
            </div>

            <div id="mapa" class="thumbnail" style="background-color:white; box-shadow:2px 2px 2px lightgrey; padding:15px; padding-top:0px;">
                <h3 style="margin-top:3px; padding-top:3px;">
                    <b id="location-adress">{{ title_case($residence->street_adress) }}, {{ title_case($residence->city) }},  {{ title_case($residence->state) }},  {{ title_case($residence->zip_code) }}</b>
                </h3>
                <center>
                    <div id="map" class="mapa" style="border-radius:3px; height:500px;"></div>
                </center>
            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close pull-right" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="exampleModalLabel"><b>Get in Touch</b></h5>
      </div>
      <div class="modal-body">
        <center>
            <form name="modal-form">
                
                <div class="form-group" style="width:80%; text-align:left;">
                    
                    <div class="alert alert-danger" id="errors-div" style="display:none"></div>
                    
            	    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}" style="margin-bottom: 5px"> 
                        <label for="name">First Name {{ $errors->first() }}</label>
                        <input id="name-modal" class="form-control" type="text" name="name" value="{{old('name')}}">
                    </div>
                    
                    <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}" style="margin-bottom: 5px"> 
                        <label for="last_name">Last Name</label>
                        <input id="last_name-modal" class="form-control" type="text" name="last_name" value="{{old('last_name')}}">
                    </div>
            	    
            	    <div class="form-group{{ $errors->has('telephone') ? ' has-error' : '' }}" style="margin-bottom: 5px"> 
                        <label for="telephone">Telephone</label>
                        <input id="telephone-modal" class="form-control phone_us" type="text" name="telephone" value="{{old('telephone')}}">
                    </div>
                    
                	<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}" style="margin-bottom: 5px">
                        <label for="email">Email</label>
                        <input id="email-modal" class="form-control" type="text" name="email" 
                        value = "{{ old('email') }}">
                    </div>
                    
                    <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}" style="margin-bottom: 5px">
                        <label for="comment">Comments / Questions</label>
                        <textarea id="comment-modal" class="form-control" type="text" name="comment"></textarea>
                    </div>
                    
            	</div>
            </form>
        </center>
      </div>
      <div class="modal-footer">
        <center id="modal-center">
            <button id="sub-but" onclick="submitModalForm()" type="button" class="btn btn-primary">Send <i class="fa fa-envelope-o"></i></button>
        </center>
      </div>
    </div>
  </div>
</div>


@endsection

@section('scripts')

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCEZbTqFLGAurA88s8oFkdtWSHbrD-ZD-8&callback="
        async defer></script>
<script>

$(function() {
    
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
    
    
    $('.img-gal').css('display', 'block');
    
    if($('#location-adress').length){
        geocodeAddress($('#location-adress').html());
    }
    
    
});


</script>
<script>
   function submitModalForm()
   {
        
        var name = $('#name-modal');
        var last_name = $('#last_name-modal');
        var email = $('#email-modal');
        var telephone = $('#telephone-modal');
        var comment = $('#comment-modal');
        
        $.post('/notification/{{ $residence->id }}',{
            _token:window.Laravel.csrfToken, 
            name:name.val(),   
            last_name:last_name.val(),
            email:email.val(),
            telephone:telephone.val(),
            comment:comment.val()
           }, function(data){
            
            $('.modal-body').html('<div class="alert alert-success"><center><b>'
                + data + '</b></center></div>');
            
            $('#sub-but').css('display', 'none');
            
            $('#modal-center').html('<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>');
            
            $('#btn-container').html('<button type="button" class="btn btn-success disabled" style="width:100%; margin-bottom:5px;">Contacted <i class="fa fa-check"></i></button>')
            
        }).fail(function(response){
            var errors = response.responseJSON;
            var msg = '';
            
            console.log(errors);
            
            if(typeof(errors.name) != 'undefined')
            {
                msg = errors.name[0]; name.css('border-color', 'red');
            }
            if(typeof(errors.last_name) != 'undefined')
            {
                msg = msg + '</br>' + errors.last_name[0]; last_name.css('border-color', 'red');
            }
            if(typeof(errors.email) != 'undefined')
            {
                msg = msg +  '</br>' + errors.email[0]; email.css('border-color', 'red');
            }
            if(typeof(errors.telephone) != 'undefined')
            {
                msg = msg + '</br>' + errors.telephone[0]; telephone.css('border-color', 'red');
            }
            if(typeof(errors.comment) != 'undefined')
            {
                msg = msg + '</br>' + errors.comment[0]; comment.css('border-color', 'red');
            }
            
            $('#errors-div').html(msg);
            $('#errors-div').css('display', 'block')
        });
       
   }
   
   var favSubmitted = false;
   
   function submitToFavorites()
   {
       if(favSubmitted == false)
       {
            $.get('/favorites/{{ $residence->id }}',{
            _token:window.Laravel.csrfToken, 
            }, function(data){
               
               $('#fav-button').html(data + ' <i class="fa fa-check">');
               $('#fav-button').addClass('disabled');
               favSubmitted = true;
               
           }).fail(function(response){
               console.log(response);
           });   
       }
            
   }
   
   var resReported = false;
   
   function reportResidence()
   {
       if(resReported == false)
       {
           $.get('/report/{{ $residence->id }}',{
            _token:window.Laravel.csrfToken, 
            }, function(data){
               $('#report-btn').html(data + ' <i class="fa fa-check">');
               $('#report-btn').addClass('disabled');
               resReported = true;
           }).fail(function(response){
               console.log(response);
           });
       }
   }
</script>

<script src="/galleria/galleria-1.5.5.min.js"></script>
<script src='/galleria/themes/classic/galleria.classic.min.js'></script>
<script src='/galleria/themes/fullscreen/galleria.fullscreen.min.js'></script>
<link rel="stylesheet" type="text/css" href="/galleria/themes/classic/galleria.classic.css"/>
<script>

    $(function() {
        Galleria.run('.galleria', {
            trueFullscreen: true,
            fullscreenCrop: true,
            theme: 'classic',
            extend: function()
            {
                var gallery = this;
                this.addElement('fscr');
                this.appendChild('stage','fscr');
                var fscr = this.$('fscr')
                    .click(function() {
                        gallery.toggleFullscreen();
                    });
                $('.galleria-fscr').html('<i class="fa fa-expand" style="color:lightgrey"></i>')
                this.addIdleState(this.get('fscr'), { opacity:0 });
            }
        });
    });

</script>
@endsection