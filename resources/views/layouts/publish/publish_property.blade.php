@extends('layouts.app')

@section('content')

<div id="holder" class="container">
    <div class="row" style="margin-bottom:10px;">
        <div class="col-sm-12">
            <ul class="nav nav-pills nav-justified">
                <li><a onclick="pageRefresh()" id="step-1" class="yes-active">
                    <h4 class="list-group-item-heading">Step 1</h4>
                    <p class="list-group-item-text">Select type & category</p>
                </a></li>
                <li><a id="step-2" class="not-active">
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
        <form method="GET" action="/set_location">
            {{ csrf_field() }}
            <div class="col-sm-4 form-group">
                <div class="thumbnail" style="text-align:left; background-color:white; box-shadow:2px 2px 2px lightgrey; height:300px; padding:15px; padding-top:0;">
                    <div class="radio">
                      <h3>Residence Type:</h3>
                    </div>
                    <div class="radio">
                      <label><input desc="House" class="type-input" type="radio" name="type" value="house">House</input></label>
                    </div>
                    <div class="radio">
                      <label><input desc="Appartment" class="type-input" type="radio" name="type" value="appartment">Appartment</input></label>
                    </div>
                    <div class="radio">
                      <label><input desc="Commercial Space" class="type-input" type="radio" name="type" value="commercial_space">Commercial Space</input></label>
                    </div>
                    <div class="radio">
                      <label><input desc="Office Space" class="type-input" type="radio" name="type" value="office_space">Office Space</input></label>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 form-group">
                <div class="thumbnail" style="text-align:left; background-color:white; box-shadow:2px 2px 2px lightgrey; height:300px; padding:15px; padding-top:0;">
                    <div class="radio">
                      <h3>Residence Category:</h3>
                    </div>
                    <div class="radio">
                      <label><input desc="Rent" class="category-input" type="radio" name="category" value="rent">Rent</input></label>
                    </div>
                    <div class="radio">
                      <label><input desc="Lease Takeover" class="category-input" type="radio" name="category" value="lease_takeover">Lease Takeover</input></label>
                    </div>
                    <div class="radio">
                      <label><input desc="Shared Rent" class="category-input" type="radio" name="category" value="shared_rent">Shared Rent</input></label>
                    </div>
                </div>
            </div>
            <div class="col-sm-4" id="both-checked">
                <div class="thumbnail" style="background-color:white; box-shadow:2px 2px 2px lightgrey; height:300px; padding:15px; padding-top:0;">
                    <center>
                        <h3 id="type-category">House for Sale</h3>
                    </center>
                    <center>
                        <img src="/public_images/check-mark.png" style="width:100px; height:100px;">
                    </center>
                    <center><button type="submit" class="btn btn-primary" style="font-size:20px; margin:20px;">Continue</button></center>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection