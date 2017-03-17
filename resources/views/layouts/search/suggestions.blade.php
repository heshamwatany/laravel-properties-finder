@for($i = 0; $i < count($query); $i++)
    @if($i == 10) 
        @break
    @endif
    <div class="row" style="width: inherit;">    
        <center style="text-align:left;" style="width:inherit">
            <div id="{{ $i + 1 }}" onmouseover = 'changeColorUp(this.id);' onmouseout = 'changeColorDown(this.id)' onclick = 'submitOrHide(this.id, isFocus);'>
                <div id="{{ $i + 1 }}" class="listSuggestion container">{{strtolower($query[$i])}}</div>
            </div>
        </center>
    </div>
@endfor
