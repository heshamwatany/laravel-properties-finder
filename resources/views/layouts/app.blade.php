<!DOCTYPE html>
<html lang="en" onclick="submitOrHide(this.id, isFocus)" style="min-height:100%">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Zupango') }}</title>

    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/algolia_search.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="/slick/slick-theme.css"/>
    <link rel="stylesheet" type="text/css" href="/css/footer-distributed.css"/>
    <link rel="stylesheet" type="text/css" href="/css/dropzone.css">
    
    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
    
</head>
<body style="min-height: 82vh;">
    
    <div id="app" style="min-height:inherit;">
 
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container" style="width:100%;">
                
                <div class="navbar-header">
                    <!-- Collapsed Hamburger -->
                    <button id="user-settings" type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <i class="fa fa-user-circle"></i>
                    </button>
                    <a class="navbar-brand" id="nav-custom" href="#"><i class="fa fa-question" aria-hidden="true"></i></a>
                </div>
                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a data="data-pjax-pages" href="{{ url('/login') }}" ><i class="fa fa-sign-in" aria-hidden="true"></i> Login</a></li>
                            <li><a data="data-pjax-pages" href="{{ url('/register') }}" ><i class="fa fa-user-plus" aria-hidden="true"></i> Register</a></li>
                            <li class="li-icon"><a id="a-icon-house" ><i class="fa fa-home" aria-hidden="true"></i></a></li>
                            <li class="li-icon"><a id="a-icon-heart" href="/my_favorites"><i class="fa fa-heart" aria-hidden="true"></i></a></li>
                        @else
                            <li><a href="/dashboard" data="data-pjax-pages" style="cursor:pointer;">{{ Auth::user()->name }}</a></li>
                            <li class="li-icon"><a id="a-icon-house" href="/publish_property"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                            <li class="li-icon"><a id="a-icon-heart" href="/my_favorites"><i class="fa fa-heart" aria-hidden="true"></i></a></li>
                            <li><a data="data-pjax-pages" a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out" aria-hidden="true" id="a-icon-signout"></i></a></li>
                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        
        <nav id="search-navbar" class="navbar navbar-default navbar-static-top" style="margin-bottom:10px; box-shadow: 0px 3px 2px lightgrey;">
            <div id="search-container" class="container">
                
                <center id="center-search-form">

                      <form id="search-form" name="search-form" method="GET"  action="/search">
                        {{ csrf_field() }}
                        <div class="input-group stylish-input-group" id="query-div">
                            <span class="input-group-addon">
                                <div class="dropdown">
                                  <button class="dropdown-toggle" type="button" data-toggle="dropdown" style="margin-left:0; padding-left:0; margin-right:0; padding-right:0;"><i class="fa fa-filter"></i></button>
                                  <ul class="dropdown-menu" id="search-dropdown" style="padding-top:0px; padding-bottom:0px;">
                                    <li class="categories" style="border-bottom:1px solid lightgrey;"><a class="a-reset" id="a-categories" name="reset">Reset All</a></li>
                                    <li class="categories"><a class="a-categories" id="a-categories" name="Rent" value="rent">Rent</a></li>
                                    <li class="categories"><a class="a-categories" id="a-categories" name="Shared Rent" value="shared_rent">Shared Rent</a></li>
                                    <li class="categories" style="border-bottom:1px solid lightgrey;"><a class="a-categories" id="a-categories" name="Lease Takeover" value="lease_takeover">Lease Takeover</a></li>
                                    <li class="categories"><a class="a-types" id="a-categories" name="Office" value="office">Office</a></li>
                                    <li class="categories"><a class="a-types" id="a-categories" name="Commercial" value="commercial_space">Commercial</a></li>
                                    <li class="categories"><a class="a-types" id="a-categories" name="Houses" value="house">Houses</a></li>
                                    <li class="categories"><a class="a-types" id="a-categories" name="Apartments" value="appartment">Apartments</a></li>
                                  </ul>
                                </div> 
                            </span>
                            
                            <input id="query" name="query" type="text" class="form-control" autocomplete="off" placeholder="Search by street, city, or state">
                            
                            <input style="display:none;" type="checkbox" name="type" id="type" value="">
                            <input style="display:none;" type="checkbox" name="category" id="category" value="">
                            
                            <span class="input-group-addon">
                                <button type="submit">
                                    <i class="fa fa-search"></i>
                                </button>  
                            </span>
                            
                        </div>
                        <div id="suggestions"></div>
                      </form>

                </center>
            </div>
        </nav>
    
        <div id="pjax-container">
            @yield('content')
        </div>
                
    </div>
    
    
    
<!-- Scripts -->
<script src="/js/app.js"></script>
<script src="/js/algolia_search.js"></script>
<script src="/slick/slick.min.js"></script>
<script src="/js/jquery.pjax.js"></script>
<script src="/js/hammer.min.js"></script>
<script src="/js/jquery.mask_plugin.min.js"></script>
<script src="/js/dropzone.js"></script>
<script>
    $(document).ready(function(){
      $('.slick-slider').slick({
          infinite: true,
          speed: 500,
          slidesToShow: 3,
          slidesToScroll: 3,
          autoplay: false,
          responsive: [
            {
              breakpoint: 1024,
              settings: {
                slidesToShow: 2,
                slidesToScroll: 2,
                infinite: true,
              }
            },
            {
              breakpoint: 600,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1
              }
            },
            {
              breakpoint: 480,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1
              }
            }
          ]
        });
        
        setPaginationLimit();
        
    });

    jQuery(function ($) {

        $(document).on('submit', '#search-form', function(event) {
          $.pjax.submit(event, '#pjax-container')
          $('#query').blur();
        });
        
        $(document).on('submit', '#filter-form', function(event) {
          $.pjax.submit(event, '#pjax-container')
          $('#query').blur();
        });
        
        $(document).on('pjax:error', function(event, xhr, textStatus, errorThrown, options){
            console.log(errorThrown);    
        });
        
        $(document).on('pjax:timeout', function(event) {
            // Prevent default timeout redirection behavior
            event.preventDefault();  
        });
        
        $(document).on('pjax:send', function(){
            $('#pjax-container').css('opacity', .5);
        });
        
        $(document).pjax("a[data='data-pjax-pages']", '#pjax-container');
        
        $(document).on('pjax:complete', function(){
            $('#pjax-container').css('opacity', 1);
            
            var thumbRows = $(".thumb-row");
    
            for(var i = 0; i < thumbRows.length; i++)
            {
                swipeItem(thumbRows[i]);    
            }
            
            setPaginationLimit();
            
            $('.pagination').find('a').each(function() {
                $(this).attr('data', 'data-pjax-pages');
            });
            
            $('.smarty-ui').css('display', 'none');
            
        });
            
        $(document).ready(function()
        {
            $('.pagination').find('a').each(function() {
                $(this).attr('data', 'data-pjax-pages');
            });
            
        });
        
    });
    
</script>

<script>

$(function(){ 
    
    var thumbRows = $(".thumb-row");
    
    for(var i = 0; i < thumbRows.length; i++)
    {
        swipeItem(thumbRows[i]);    
    }
    
});

function swipeItem(thumbRow){

    var hammer = new Hammer.Manager(thumbRow);
    
    var swipe = new Hammer.Swipe();

    hammer.add(swipe);
    
    hammer.get('swipe').set({ direction: Hammer.DIRECTION_HORIZONTAL });
    
    hammer.on('swipeleft', function(){
        thumbRow.style.display = "none";
    });
    
    hammer.on('swiperight', function(){
        thumbRow.style.display = "none";
    })
}

function setPaginationLimit(){
    $('.pagination').css('display',"inline-block");
}

</script>

<script>

var fileName =  null;
var photo_id = null; var photo1_id = null;
var photo2_id = null; var photo3_id = null;
var photo4_id = null; var photo5_id = null;
var photo6_id = null; var photo7_id = null;

Dropzone.options.profilePicForm = {
    maxFiles:1,
    maxFileSize: 3,
    acceptedFiles: '.jpg, .png, .jpeg',
    dictMaxFilesExceeded: "Maximum upload limit reached",
    dictInvalidFileType: "Upload only .jpg/.jpeg/.png",
    addRemoveLinks: true,
    success: function(file, response){
        residence_id = response['residence_id'];
        photo_id = response['photo_id'];
    },
    removedfile: function(file) {
        
        if(file.status == 'success')
        {
            $.ajax({
                url: "/uploads/delete/" + photo_id,
                type: "POST",
                data: { photo_id:photo_id, residence_id:residence_id, _token:window.Laravel.csrfToken },
                error: function(error, status){
                    console.log(error);
                    console.log(status);
                }
            });
        }
        
        var _ref;
        
        return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
    }
};

Dropzone.options.pic1Form = {
    maxFiles:1,
    maxFileSize: 3,
    acceptedFiles: '.jpg, .png, .jpeg',
    dictMaxFilesExceeded: "Maximum upload limit reached",
    dictInvalidFileType: "Upload only .jpg/.jpeg/.png",
    addRemoveLinks: true,
    success: function(file, response){
        residence_id = response['residence_id'];
        photo1_id = response['photo_id'];
    },
    removedfile: function(file) {
        
        if(file.status == 'success')
        {
            $.ajax({
                url: "/uploads/delete/" + photo1_id,
                type: "POST",
                data: { photo_id:photo1_id, residence_id:residence_id, _token:window.Laravel.csrfToken },
                error: function(error, status){
                    console.log(error);
                    console.log(status);
                }
            });
        }
        
        var _ref;
        
        return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
    }
};

Dropzone.options.pic2Form = {
    maxFiles:1,
    maxFileSize: 3,
    acceptedFiles: '.jpg, .png, .jpeg',
    dictMaxFilesExceeded: "Maximum upload limit reached",
    dictInvalidFileType: "Upload only .jpg/.jpeg/.png",
    addRemoveLinks: true,
    success: function(file, response){
        residence_id = response['residence_id'];
        photo2_id = response['photo_id'];
    },
    removedfile: function(file) {
        
        if(file.status == 'success')
        {
            $.ajax({
                url: "/uploads/delete/" + photo2_id,
                type: "POST",
                data: { photo_id:photo2_id, residence_id:residence_id, _token:window.Laravel.csrfToken },
                error: function(error, status){
                    console.log(error);
                    console.log(status);
                }
            });
        }
        
        var _ref;
        
        return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
    }
};

Dropzone.options.pic3Form = {
    maxFiles:1,
    maxFileSize: 3,
    acceptedFiles: '.jpg, .png, .jpeg',
    dictMaxFilesExceeded: "Maximum upload limit reached",
    dictInvalidFileType: "Upload only .jpg/.jpeg/.png",
    addRemoveLinks: true,
    success: function(file, response){
        residence_id = response['residence_id'];
        photo3_id = response['photo_id'];
    },
    removedfile: function(file) {
        
        if(file.status == 'success')
        {
            $.ajax({
                url: "/uploads/delete/" + photo3_id,
                type: "POST",
                data: { photo_id:photo3_id, residence_id:residence_id, _token:window.Laravel.csrfToken },
                error: function(error, status){
                    console.log(error);
                    console.log(status);
                }
            });
        }
        
        var _ref;
        
        return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
    }
};

Dropzone.options.pic4Form = {
    maxFiles:1,
    maxFileSize: 3,
    acceptedFiles: '.jpg, .png, .jpeg',
    dictMaxFilesExceeded: "Maximum upload limit reached",
    dictInvalidFileType: "Upload only .jpg/.jpeg/.png",
    addRemoveLinks: true,
    success: function(file, response){
        residence_id = response['residence_id'];
        photo4_id = response['photo_id'];
    },
    removedfile: function(file) {
        
        if(file.status == 'success')
        {
            $.ajax({
                url: "/uploads/delete/" + photo4_id,
                type: "POST",
                data: { photo_id:photo4_id, residence_id:residence_id, _token:window.Laravel.csrfToken },
                error: function(error, status){
                    console.log(error);
                    console.log(status);
                }
            });
        }
        
        var _ref;
        
        return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
    }
};

Dropzone.options.pic5Form = {
    maxFiles:1,
    maxFileSize: 3,
    acceptedFiles: '.jpg, .png, .jpeg',
    dictMaxFilesExceeded: "Maximum upload limit reached",
    dictInvalidFileType: "Upload only .jpg/.jpeg/.png",
    addRemoveLinks: true,
    success: function(file, response){
        residence_id = response['residence_id'];
        photo5_id = response['photo_id'];
    },
    removedfile: function(file) {
        
        if(file.status == 'success')
        {
            $.ajax({
                url: "/uploads/delete/" + photo5_id,
                type: "POST",
                data: { photo_id:photo5_id, residence_id:residence_id, _token:window.Laravel.csrfToken },
                error: function(error, status){
                    console.log(error);
                    console.log(status);
                }
            });
        }
        
        var _ref;
        
        return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
    }
};

Dropzone.options.pic6Form = {
    maxFiles:1,
    maxFileSize: 3,
    acceptedFiles: '.jpg, .png, .jpeg',
    dictMaxFilesExceeded: "Maximum upload limit reached",
    dictInvalidFileType: "Upload only .jpg/.jpeg/.png",
    addRemoveLinks: true,
    success: function(file, response){
        residence_id = response['residence_id'];
        photo6_id = response['photo_id'];
    },
    removedfile: function(file) {
        
        if(file.status == 'success')
        {
            $.ajax({
                url: "/uploads/delete/" + photo6_id,
                type: "POST",
                data: { photo_id:photo6_id, residence_id:residence_id, _token:window.Laravel.csrfToken },
                error: function(error, status){
                    console.log(error);
                    console.log(status);
                }
            });
        }
        
        var _ref;
        
        return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
    }
};

Dropzone.options.pic7Form = {
    maxFiles:1,
    maxFileSize: 3,
    acceptedFiles: '.jpg, .png, .jpeg',
    dictMaxFilesExceeded: "Maximum upload limit reached",
    dictInvalidFileType: "Upload only .jpg/.jpeg/.png",
    addRemoveLinks: true,
    success: function(file, response){
        residence_id = response['residence_id'];
        photo7_id = response['photo_id'];
    },
    removedfile: function(file) {
        
        if(file.status == 'success')
        {
            $.ajax({
                url: "/uploads/delete/" + photo7_id,
                type: "POST",
                data: { photo_id:photo7_id, residence_id:residence_id, _token:window.Laravel.csrfToken },
                error: function(error, status){
                    console.log(error);
                    console.log(status);
                }
            });
        }
        
        var _ref;
        
        return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
    }
};

</script>


<footer class="footer-distributed" style="min-height:18vh;">

			<div class="footer-right">

				<a href="#"><i class="fa fa-facebook"></i></a>
				<a href="#"><i class="fa fa-twitter"></i></a>
				<a href="#"><i class="fa fa-instagram"></i></a>

			</div>

			<div class="footer-left">

				<p class="footer-links">
					<a href="#">About</a>
					<a href="#">Contact</a>
				</p>

				<p>Company Name &copy; 2015</p>
			</div>
</footer>
@yield('scripts')
</body>
</html>