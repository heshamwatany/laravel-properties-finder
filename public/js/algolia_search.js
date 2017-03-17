var timer; 
var count = 0; 
var httpRequest = false; 
var keyStatus = 3; 
var cnt = 0;
var numi = 0;
var isFocus = true;

function removeElements(letter, words)
{
    var cnt = 0;
    
    var result = [];
    
    words.forEach(function(e){
       if(e != letter)
       {
           result.push(e);
       }
    });
    
    return result;
    
}

function boldString(str, find)
{
    
    var regx = RegExp(find, 'g');
        
    return str.replace(regx, '<b>'+find+'</b>');

}
 
$('#query').keydown(function(){
    if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
        down();
    }
    else
    {
        up();    
    }
});

$('#query').keyup(function(){
    if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
        up();
    }
    else
    {
        down();    
    }
});
  
function up()
{
    timer = setTimeout(function(){
        
        var keywords = $('#query').val();
        
        var category = populateCategory();
        
        var type = populateType();
        
        var token = window.Laravel.csrfToken;
                 
        if(keywords.length > 0 && httpRequest == false)
        {
            if(keyStatus != 1)
            {
                $.get('/keywords_query', {_token:token, keywords:keywords, category:category, type:type}, function(data){
                    
                    $('#suggestions').html(data);
                    $('#suggestions').show();
                    var $listSuggestion = $('div.listSuggestion');
                        
                    for(var i = 0; i < $listSuggestion.length; i++ )
                    {
                        var inputs = document.getElementById('query').value.toLocaleLowerCase();
                        
                        var words = inputs.split(" ");

                        var initLength = words.length;
                        
                        words = removeElements('b', words);
                        
                        if(words.length != initLength)
                        {
                            words.unshift('b');
                        }
                        
                        words.forEach(function(e){
                            
                            if(e != "")
                            {
                                var letter = boldString($listSuggestion[i].innerHTML, e.toLowerCase());

                                $listSuggestion[i].innerHTML = letter;
                            }
                            
                        });
                        
                        
                    }
 
                }).fail(function(err, status){
                    console.log(status);
                    console.log(err);
                });
            }
        }
        else
        {
            $('#suggestions').hide();
        }
    }, 1);
    
}

function populateCategory()
{
    var category = $('#category').val()
    
    if(category == 'rent' || category == 'shared_rent' || category == 'lease_takeover')
    {
        return category;
    }
    else
    {
        return;
    }
    
}

function populateType()
{
    var type = $('#type').val()
    
    if(type == 'commercial_space' || type == 'house' || type == 'office' || type == 'appartment')
    {
        return type;
    }
    else
    {
        return;
    }
    
}

$('.a-categories').click(function(){
    
    var listItems = $('a.a-categories');
    var value = $(this).attr('value');
    
    $('#category').attr('checked', true);
    
    $('#category').val(value);
    
    listItems.each(function(){
        if($(this).attr('value') == value)
        {
            $(this).html($(this).attr('name') + '  <i class="fa fa-check"></i>')
        }
        else
        {
            $(this).html($(this).attr('name')); 
        }
    });

});

$('.a-types').click(function(){
    
    var listItems = $('a.a-types');
    var value = $(this).attr('value');
    
    $('#type').attr('checked', true);
    
    $('#type').val(value);
    
    listItems.each(function(){
        if($(this).attr('value') == value)
        {
            $(this).html($(this).attr('name') + '  <i class="fa fa-check"></i>')
        }
        else
        {
            $(this).html($(this).attr('name')); 
        }
    });
    
});

$('.a-reset').click(function(){
    var listTypes = $('a.a-types');
    
    listTypes.each(function(){
       $(this).html($(this).attr('name')); 
    });
    
    var listCategories = $('a.a-categories');
    
    listCategories.each(function(){
        $(this).html($(this).attr('name'));
    });
    
    $('#type').val("");
    $('#category').val("");
    $('#type').attr('checked', false);
    $('#category').attr('checked', false);
});

$('#query').bind('keypress keydown keyup', function(e)
{
	if((e.keyCode > 36 && e.keyCode < 41)  && cnt > 0)
    {
    	 keyStatus = 1;
    }
    else
    {
    	cnt = cnt + 1;
        keyStatus = 0; 
    }
    return keyStatus;
});

$("#query").click(function(event)
{
	var $listSuggestion = $('div.listSuggestion');
	event.stopPropagation();
});
    	
$('div.listSuggestion').click(function(event)
{   
    event.stopPropagation();
});

function down()
{
    clearTimeout(timer);    
}

function focusField(id)
{
    var inputField = document.getElementById(id);
    httpRequest = false;
    if(inputField != null && inputField.value.length != 0)
    {
    	if(inputField.createTextRange)
    	{
    		var FieldRange = inputField.createTextRange();
    		FieldRange.moveStart('character', inputField.value.length);
    		FieldRange.collapse();
    		FieldRange.select();
    	}
    	else if(inputField.selectionStart || inputField.selectionStart == '0')
    	{
    		var elemLen = inputField.value.length;
    		inputField.selectionStart = elemLen;
    		inputField.selectionEnd = elemLen;
    		inputField.focus();
    	}
    	else
    	{
    		inputField.focus();
    	}
    }
}

function changeColorUp(id)
{
	var $listSuggestion = $('div.listSuggestion');
    document.getElementById(id).style.backgroundColor = "lightgrey";
    count = Number(id);
    for(var j = 0; j < $listSuggestion.length; j++)
    {
    	if(Number($listSuggestion[j].id) != count)
    	{
    		document.getElementById(j + 1).style.backgroundColor = "white";
    	}
    }
    return count;
}

function changeColorDown(id)
{
	document.getElementById(id).style.backgroundColor = "white";
	count = 0;
	return count;
}

$('#query').keydown(function(e)
{
    		
    var $listSuggestion = $('div.listSuggestion');
	var key = e.keyCode,
	    $selected = $listSuggestion.filter('selected'),
	    $current;
    		
    if(key == 13)
    {
        httpRequest = true;
    }
    		
    if (key != 40 && key != 38 && key != 37 && key != 39)
    {
    	count = 0;
    	$listSuggestion.removeClass('selected');
    	return; 
    }
    else if(key == 40)
    {
    	count = count + 1;
    }
    else if(key == 38 && (count == 0 || count == 1))
    {
    	count = $listSuggestion.length;
    }
    else if(key == 38)
    {
    	count = count - 1;
    }
    							
    if ( key == 40 ) // Down key
    {
    	if ((! $selected.length || $selected.is(':last-child')) && count == 0) 
    	{									
    		$current = $listSuggestion.eq(count - 1);
    	}
    	else if ((! $selected.length || $selected.is(':last-child')) && count == $listSuggestion.length + 1)
		{
    		count = 1;
    		$current = $listSuggestion.eq(count - 1);
    	}
    	else if( (! $selected.length || $selected.is(':last-child')) && count != 0) 
    	{
    		$current = $listSuggestion.eq(count - 1);
    	}
    								
    }
    else if ( key == 38 ) // Up key
    {
    	if (!$selected.length || $selected.is(':first-child') && count == 0) 
    	{
    		$current = $listSuggestion.eq(count - 1);
    	}
    	else if ((! $selected.length || $selected.is(':last-child')) && count == $listSuggestion.length)
    	{
    		count = $listSuggestion.length - 1;
    		$current = $listSuggestion.eq(count - 1);
    	}
    	else if((!$selected.length || $selected.is(':last-child')) && count < $listSuggestion.length) 
    	{
    		$current = $listSuggestion.eq(count - 1);
    	}
    								
    	focusField('query');
    								
    }
    							
    document.getElementById('query').value = $current.addClass('selected').text();
    document.getElementById(count).style.backgroundColor = "lightgrey";
    		
    if(count > 1 && count < $listSuggestion.length)
    {
    	document.getElementById(count).style.backgroundColor = "lightgrey";
    	document.getElementById(count - 1).style.backgroundColor = "white";
    	document.getElementById(count + 1).style.backgroundColor = "white";
    }
    
    if(count == 1)
    {
    	document.getElementById(1).style.backgroundColor = "lightgrey";
    	document.getElementById($listSuggestion.length).style.backgroundColor = "white";
    			
    	if($listSuggestion.length > 1)
    	{
    		document.getElementById(2).style.backgroundColor = "white";
    	}
    }
    else
    {
    	document.getElementById(1).style.backgroundColor = "white";	
    }
    							
    if(count == $listSuggestion.length)
    {
    	document.getElementById($listSuggestion.length).style.backgroundColor = "lightgrey";
    	document.getElementById($listSuggestion.length - 1).style.backgroundColor = "white";
    	document.getElementById(1).style.backgroundColor = "white";
    }
    else
    {
    	document.getElementById($listSuggestion.length).style.backgroundColor = "white";	
    }
							
});
							
$('#query').focus(function()
{
    isFocus = false;
    httpRequest = false;
    var query = document.getElementById('query');
    		
    if(isFocus == false && query.value.length == 0)
    {
    	isFocus = true;
    }
    else if(isFocus == false && query.value.length > 0)
    {
    	isFocus = true;
    	keyStatus = 2;
    }
    		
    return isFocus;
    
});

$('#query').click(function()
{
	var query = document.getElementById('query').value;
    
    $('[data-toggle="dropdown"]').parent().removeClass('open');
    
	if(query.length > 0)
	{
		keyStatus = 2;
		up();
		return;
	}
	
});

function submitOrHide(current, isFocus)
{
	var $listSuggestion = $('div.listSuggestion');
    		
	if(!isNaN(Number(current)) && isFocus == true)
	{
		$('#suggestions').hide();
    	isFocus = false;
    	if($listSuggestion.length > 0 && current > 0)
    	{
        	var valRep = $listSuggestion[current - 1].innerHTML;
        	valRep = valRep.replace(/<b>/g,"");
        	valRep = valRep.replace(/<\/b>/g,"");
        	document.getElementById('query').value = valRep;
        	count = 0;
        	document.forms['search-form'].submit();
    	}
    }
    else if(isNaN(Number(current)) && isFocus == true)
    {
    	isFocus = false;
    	count = 0;
    	$('#suggestions').hide();
    }
    		
    for(i = 0; i < $listSuggestion.length; i++)
    {
        document.getElementById(i + 1).style.backgroundColor = "white";
    }
    
    return count;
}

$('#query').bind('keydown', function(e){
        
    if(e.keyCode == 38)
    {
       e.preventDefault(); 
    }
        
});

$('.dropdown-menu').on({
    "click":function(e){
      e.stopPropagation();
    }
});

function submitFilters(){
   $('#submit-button').trigger('click'); 
};

function resetFilter(key)
{
    var id = '#checked-filters-'.concat(key);
    $(id).prop('checked', false);
    submitFilters();
}

function resetAllFilters()
{
    var filterList = $('.checked-filters');
    
    filterList.each(function(){
        $(this).prop('checked', false);
    });
    
    submitFilters();
}

function pageRefresh()
{
    window.location.reload();
}

function selectSort(){
    $('#sortBy').val($('#sortBySelect option:selected').val());
    submitFilters();
}

$('.type-input').on('change', function(){
    
    var text;
    
    $('.category-input').each(function(){
       if($(this).is(':checked')) 
       {
           text = $(this).attr('desc');
           return false;
       }
    });
    
    $('#type-category').html(
        $(this).attr('desc') + ' for ' + text
    );
    
});

$('.category-input').on('change', function(){
    
    var text;
    
    $('.type-input').each(function(){
       if($(this).is(':checked')) 
       {
           text = $(this).attr('desc');
           return false;
       }
    });
    
    $('#type-category').html(
         text + ' for ' + $(this).attr('desc')
    );
    
});

$('#trigger-sub-btn').click(function(){
    $('#location-form-submit').trigger('click');
});

$('#description-area').keydown(function(e){
    if($(this).val().length >= 190 && e.which != 8) e.preventDefault()
});

$('#description-area').keyup(function(e){
    var word_count = $(this).val().length;
    if(word_count > 5) e.preventDefault()
    $('#description-count').html(word_count + '/190');
});

$(document).ready(function(){

    if($('.phone_us').length) $('.phone_us').mask('(999) 999-9999');
    
    if($('.area').length) $('.area').mask('99?999999 sq. feet')
    
    if($('.money-total').length) $('.money-total').mask('99?9999999 dls.', {reverse: true})
    if($('.money-rent').length) $('.money-rent').mask('99?999999 dls.', {reverse: true})
    
});

$('#accept').change(function(){
   if(this.checked) 
   {
       $('.needs-acceptance').css('display', 'block');
   }
   else
   {
       $('.needs-acceptance').css('display', 'none');
   } 
});
    
$('.category-input').on('click', function(){
    numi++;
    if(numi == 2)
    {
        $('#both-checked').css('display', 'block');
    }
});
    
$('.type-input').on('click', function(){
    numi++;
    if(numi == 2)
    {
        $('#both-checked').css('display', 'block');
    }
});

$('#zip').keyup(function(e){
    
    if(e.which == 13)
    {
        $('#submit-btn').trigger('click');
    }
    
});