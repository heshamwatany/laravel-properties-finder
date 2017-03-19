@extends('layouts.app')

@section('content')
<div id="holder" class="container">
    <div class="row">
    <div class="container">
      <button type="button" 
        data-toggle="collapse"
        id="filters-collapsed"
        data-target="#filters" 
        class="btn btn-normal collapsed">
          Filters <a class="pull-right"></a>
      </button>
    </div>
      <div id="filters" class="col-sm-3 container div-collapse collapse">
        
          <div id="refine-search">
            Refine your Search
          </div>
        
          <form id="filter-form" method="GET" action="/search">
          
          @if(count($appliedFilters) > 0 && !in_array("", $appliedFilters))
          
          <button id="reset-filters-button" type="button" onclick="resetAllFilters();" class="btn btn-success"><b>Reset Filters</b></button>
          
          <div id="filter-thumb" class="thumbnail">
              
              <div id="applied-filters">
                Applied Filters: <a data-toggle="collapse" data-target="#filters-id"   class="pull-right" style="cursor:pointer"><i class="fa fa-chevron-down" ></i></a>
              </div>
              
              <div id="filters-id" class="collapse in">
              @for($i = 0; $i < count($appliedFilters); $i++)
                
                <div  class="checkbox pod">
                  <a class="app_filters" onclick="resetFilter('{{ array_keys($appliedFilters)[$i] }}')">
                    @if(array_values($appliedFilters)[$i] == 1 && strcasecmp(array_keys($appliedFilters)[$i], 'parking_spots') && strcasecmp(array_keys($appliedFilters)[$i], 'number_of_rooms') && strcasecmp(array_keys($appliedFilters)[$i], 'number_of_bathrooms') != 0 && strcasecmp(array_keys($appliedFilters)[$i], 'area_range') != 0 && strcasecmp(array_keys($appliedFilters)[$i], 'price_range') != 0 && strcasecmp(array_keys($appliedFilters)[$i], 'construction_area_range') != 0)
                      {{ title_case(str_replace('_', ' ',array_keys($appliedFilters)[$i])) }}: Yes <i class="fa fa-times" aria-hidden="true" style="color:red;"></i>
                    @else
                      {{ title_case(str_replace('_', ' ',array_keys($appliedFilters)[$i])) }}: {{ title_case(str_replace('_', ' ',array_values($appliedFilters)[$i])) }} <i class="fa fa-times" aria-hidden="true" style="color:red;"></i>
                    @endif
                  </a>
                </div>
                
              @endfor
              </div>
          </div>
          
          @endif
            
          {{ csrf_field() }}
          
          <input type="hidden" name="query" value="{{ $keywords }}">
          <input type="hidden" name="sortBy" id="sortBy" value="{{ $indexNum }}">  

          @foreach($facets as $key => $facet)
          
              @if(count($facet) > 1 || array_key_exists($key, $appliedFilters))
              
              <div class="thumbnail faceting">
                <div class="facet-title">
                  {{ title_case(str_replace('_', ' ', $key)) }} <a data-toggle="collapse" data-target="#{{ $key }}-id"   class="pull-right" style="cursor:pointer"><i class="fa fa-chevron-down" ></i></a>
                </div>
                <div id="{{ $key }}-id" class="collapse in set-height">
                @foreach($facet as $attr => $val)
                <div class="checkbox pod">
                    @if($attr != false)
                      @if(array_key_exists($key, $appliedFilters) && $appliedFilters[$key] == $attr)
                          <label style="width:100%;"><input class="checked-filters" id="checked-filters-{{ $key }}" onchange="submitFilters()" class="input-submit" name="{{ $key }}" type="checkbox" value="{{ $attr }}" checked>@if($attr == 1 && strcasecmp($key, 'parking_spots') && strcasecmp($key, 'number_of_rooms') && strcasecmp($key, 'number_of_bathrooms') != 0 && strcasecmp($key, 'area_range') != 0 && strcasecmp($key, 'price_range') != 0 && strcasecmp($key, 'construction_area_range') != 0) Yes ({{ $val }})@else{{ title_case(str_replace('_',' ',$attr)) }} ({{ $val }})@endif</label>
                      @else
                          <label style="width:100%;"><input onchange="submitFilters()" class="input-submit" name="{{ $key }}" type="checkbox" value="{{ $attr }}">@if($attr == 1 && strcasecmp($key, 'parking_spots') && strcasecmp($key, 'number_of_rooms') && strcasecmp($key, 'number_of_bathrooms') != 0 && strcasecmp($key, 'area_range') != 0 && strcasecmp($key, 'price_range') != 0 && strcasecmp($key, 'construction_area_range') != 0) Yes ({{ $val }})@else{{ title_case(str_replace('_',' ',$attr)) }} ({{ $val }})@endif</label>
                      @endif
                    @endif
                </div>
                @endforeach
                </div>
              </div>
              
              @endif
              
          @endforeach
          
          
          <button id="submit-button" type="submit" style="display:none;"></button>
          
          </form>
      </div>
      <div class="col-sm-9">
         
          <div class="row" style="margin-top:10px;">
              <div class="form-inline" style="width:100%;">
                <div class="col-sm-6">
                  We found <em style="color:red;">{{ $nbHits }}</em> results for <em style="color:red;">{{ $keywords }}</em>
                </div>
                <div id="sort-div" class="col-sm-6">
                  Sort by: <select id="sortBySelect" onchange="selectSort()" class="form-control">
                    @if($indexNum == 4)
                      <option value="4">Area (high to low)</option>
                      <option value="3">Price (high to low)</option>
                      <option value="0">Relevance</option>
                      <option value="1">Price (low to high)</option>
                      <option value="2">Area (low to high)</option>
                    @elseif($indexNum == 3)
                      <option value="3">Price (high to low)</option>
                      <option value="4">Area (high to low)</option>
                      <option value="0">Relevance</option>
                      <option value="1">Price (low to high)</option>
                      <option value="2">Area (low to high)</option>  
                    @elseif($indexNum == 2)
                      <option value="2">Area (low to high)</option>
                      <option value="3">Price (high to low)</option>
                      <option value="4">Area (high to low)</option>
                      <option value="0">Relevance</option>
                      <option value="1">Price (low to high)</option>
                    @elseif($indexNum == 1)
                      <option value="1">Price (low to high)</option>
                      <option value="2">Area (low to high)</option>
                      <option value="3">Price (high to low)</option>
                      <option value="4">Area (high to low)</option>
                      <option value="0">Relevance</option>
                    @else
                      <option value="0">Relevance</option>
                      <option value="1">Price (low to high)</option>
                      <option value="2">Area (low to high)</option>
                      <option value="3">Price (high to low)</option>
                      <option value="4">Area (high to low)</option>
                    @endif
                  </select>
                </div>
              </div>
          </div>
          
          @foreach($items as $item )
          
          <div id="thumb-row" class="row thumbnail thumb-row">
              <center><div id="thumb-img" class="col-sm-4 thumb-img">
                <img class="img-responsive" style="height:196px; width:100%;" src="https://img.clipartfest.com/5f4ec6f8745b5dbc47b6a57a875f226a_simple-orange-house-clip-art-house-clipart-images-png_298-282.png">  
              </div></center>
              <div id="thumb-desc" class="col-sm-8 thumb-desc">
                  <div>
                    {{ title_case(str_replace('_', ' ',$item['category'])) }} for {{ title_case(str_replace('_', ' ',$item['type'])) }}
                  </div>
                  <div>
                    {{ $item['state'] }}, {{ $item['city'] }}
                  </div>
                  <div>
                    {{ $item['street_adress'] }}, {{ $item['zip_code'] }}
                  </div>
                  <div>
                    {{ $item['number_of_rooms'] }} rooms, {{ $item['number_of_bathrooms'] }} bathrooms & {{ $item['parking_spots'] }} parking spots
                  </div>
                  <div>
                    {{ $item['construction_area'] }} constructed ft.<sup>2</sup> & {{ $item['area'] }} land ft.<sup>2</sup>
                  </div>
                  <div>
                    $ {{ $item['price'] }} @if($item['is_direct'] == 0) Deal Through Agent @else Direct Deal @endif
                  </div>
                  <div>
                    @if($item['has_garden'] == 1) <i style="font-size:28px; color:#00CD66;" class="fa fa-leaf"></i> @endif
                    @if($item['has_pool'] == 1) <i style="font-size:28px; color:#00B2EE;" class="fa fa-tint"></i> @endif
                    @if($item['wifi_included'] == 1) <i style="font-size:28px; color:gray;" class="fa fa-wifi"></i> @endif
                    @if($item['pet_friendly'] == 1) <i style="font-size:28px; color:brown;" class="fa fa-paw"></i> @endif
                    @if($item['utilities_included'] == 1) <i style="font-size:28px; color:yellow;" class="fa fa-lightbulb-o "></i> @endif
                    @if($item['laundry'] == 1) <i style="font-size:28px; color:blue;" class="fa fa-shirtsinbulk"></i> @endif
                    @if($item['furniture_included'] == 1) <i style="font-size:28px; color:purple;" class="fa fa-bed"></i> @endif
                    <i style="font-size:26px; color:red;" class="fa fa-heart pull-right"></i>
                  </div>
              </div>
          </div>

          @endforeach
          
          <center>
            <div class="row thumbnail item">
              <h1 style="margin-top:10px; margin-bottom:10px;"><a onclick="pageRefresh()" style="cursor:pointer; text-decoration:none;">Reset your search</a> or go to another page.</h1>
              <center>{{ $results->links() }}</center>
            </div>
          </center>

      </div>

    </div>
</div>
@endsection

@section('scripts')

<script>
$(function(){
  $(document).ready(function()
  {
      $('.pagination').find('a').each(function() {
          $(this).attr('data', 'data-pjax-pages');
      });
  });
});
</script>


@endsection