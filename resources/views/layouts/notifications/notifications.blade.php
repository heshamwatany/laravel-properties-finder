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
                    <div id="poster-{{ $notification->id }}">
                    <b>From:</b> {{ $notification->name }} {{ $notification->last_name }}
                    </div>
                    <div>
                    <b>Email:</b> {{ $notification->email }}
                    </div>
                    <div>
                    @if($notification->telephone)
                        <b>Telephone:</b> {{ $notification->telephone }}
                    @endif
                    </div>
                </div>
                <div class="col-sm-7">
                    <div>
                        <b>Date:</b>{{ $notification->updated_at }}
                    </div>
                    <div>
                        <b>Property:</b> {{ App\Residence::find($notification->residence_id)->street_adress }},
                        {{ App\Residence::find($notification->residence_id)->city }},
                        {{ App\Residence::find($notification->residence_id)->state }},
                        {{ App\Residence::find($notification->residence_id)->zip_code }}
                    </div>
                    <div id="comment-{{$notification->id}}">
                        <b>Comment:</b> {{ $notification->comment }}
                    </div>
                </div>
                <div class="col-sm-2" id="btn-container-{{$notification->id}}">
                    <button id="{{ $notification->id }}" type="button" data-toggle="modal" onclick="setNotification(this)" data-target="#myModal" class="btn btn-primary" style="width:100%;">Reply</button>
                </div>
            </div>
        </div>
        @endforeach
        
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
                            <label for="comment">Comments / Answers</label>
                            <textarea id="comment-modal" class="form-control" type="text" name="comment"></textarea>
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

        <center>
              <center>{{ $results->links() }}</center>
        </center>
        
    </div>
</div>
    

@endsection

@section('scripts')

<script>

var notification;

function setNotification(object)
{
    notification = object.id;
    var notificationPoster = $('#poster-'+object.id).html();
    var notificationComment = $('#comment-'+object.id).html();
    
    $('.modal-body').html('<center><form name="modal-form"><div class="form-group" style="width:80%; text-align:left;"><div class="alert alert-danger" id="errors-div" style="display:none"></div><div>' + notificationPoster + '</div><div>' + notificationComment + '</div><hr><label for="comment">Comments / Answers</label><textarea id="comment-modal" class="form-control" type="text" name="comment"></textarea></div></form></center>');
            
    $('#modal-center').html('<button id="sub-but" onclick="submitModalForm()" type="button" class="btn btn-primary">Send <i class="fa fa-envelope-o"></i></button>');
}

function submitModalForm()
{
    var comment = $('#comment-modal');
    
    var url = '/answer/' + notification;
    
    var id = '#btn-container-' + notification;
    
    $.post(url,{
        _token:window.Laravel.csrfToken, 
        comment:comment.val()
       }, function(data){
        
            $('.modal-body').html('<div class="alert alert-success"><center><b>'
                + data + '</b></center></div>');
            
            $('#modal-center').html('<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>');
            
            $(id).html('<button type="button" class="btn btn-success disabled" style="width:100%; margin-bottom:5px;">Replied <i class="fa fa-check"></i></button>');
            
    }).fail(function(response){
        var errors = response.responseJSON;
        var msg = '';
        
        console.log(errors);
        
        if(typeof(errors.comment) != 'undefined')
        {
            msg = msg + errors.comment[0]; comment.css('border-color', 'red');
        }
        
        $('#errors-div').html(msg);
        $('#errors-div').css('display', 'block')
    });
   
}
</script>
@endsection