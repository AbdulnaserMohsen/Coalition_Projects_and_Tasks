


/*validation */

(function ($) {
    "use strict";

    /*==================================================================
    [ Focus Contact2 ]*/
    
	/* on blur required*/
	$(document).on( "blur",".validate-input input", function()
	{
		if(validate(this) == false)
		{
			$(this).parent().removeClass('has-valid').addClass('has-invalid');
		}
		else 
		{
			$(this).parent().removeClass('has-invalid').addClass('has-valid');
		}
	}); 
	
	
	
    /*==================================================================
    [ Validate after type ]*/
    
	/*on blur show required validate or show that true for required input*/
	$(document).on( "blur",".validate-input input", function()
	{
		if(validate(this) == false)
		{
		   showValidate(this);
		}
		else 
		{
			$(this).parent().addClass('true-validate');
		}
	});

	
	/*==================================================================
    [ Validate ]*/
    
	/*on sumbmit*/
	$(document).on( "submit",".validate-form", function(event)
    {
		var input = $(this).find('.validate-input input');
		var check = true;
		

        for(var i=0; i<input.length; i++) 
		{
            if(validate(input[i]) == false)
			{
			    showValidate(input[i]);
                check=false;
			}
        }
	
		if(!check)
			event.stopImmediatePropagation(); //to stop other functions have the same defination as i have function with the same defination in the blade that send the form via ajax this code to stop this function
        
		return check;
    });


    /*focus required*/
	$(document).on( "focus",".validate-input input", function()
	{
		hideValidate(this);
        $(this).parent().removeClass('true-validate');
	}); 
	
	

    function validate (input) 
	{
		if($(input).attr('name') == 'name') 
		{
			if($(input).val().trim().match(/^[a-zA-Z0-9]+$/)== null)//only English letters
				return false;
        }
	    else 
		{
            if($(input).val().trim() == '' && $(input).attr('type') != 'file')
			{
				return false;
            }
        }
    }
	
	
    function showValidate(input) 
	{
        var thisAlert = $(input);

        $(thisAlert).parent().addClass('alert-validate');
    }

    function hideValidate(input) 
	{
        var thisAlert = $(input);

        $(thisAlert).parent().removeClass('alert-validate');
    }
	
	
})(jQuery);