$(document).ready(function() 
{
	function drag_drop()
	{
		dragula([document.getElementById("to-do")])
		  .on("drag", function(el) {
			el.className.replace("ex-moved", "");
		  })
		  .on("drop", function(el) {
			el.className += "ex-moved";
			//console.log(el);
			setPriority();
		  })
		  .on("over", function(el, container) {
			container.className += "ex-over";
		  })
		  .on("out", function(el, container) {
			container.className.replace("ex-over", "");
		  });
	}
	drag_drop();
	$(document).ajaxComplete(function()
	{
	  drag_drop();
	});
	
	$(document).on( "click","[name='project']", function(event) 
	{
		event.preventDefault();
		$("#services").load($(this).attr("href") +" #container");
		
	});
	
	function ajax(type,url,processData,contentType,form,callback)
	{
		var result;
		$.ajax
		({
			type: type, //THIS NEEDS TO BE GET
			url: url,
			dataType: 'json',
			data: form,
			async: false, // to make js wait unitl ajax finish
			processData: processData,
			contentType: contentType,

			success: function (data) 
			{
				result = data;
				$("#services").load($("#container").attr("data-url") +" #container");
			},
			error:function(data)
			{ 
				result = data;
			}
		});
		return result;

	}
	
	
	$(document).on( "submit",".validate-form", function(event) 
	{
		event.preventDefault(); 

		var url = $(this).data('url');
		var form = '#'+$(this).attr('id');
		var type = 'POST';
		var processData = false;
		var contentType = false;
		
		var formData = new FormData($(form)[0]);
		
		response = ajax(type,url,processData,contentType,formData,);


		if(response.hasOwnProperty("success") && !response.hasOwnProperty("responseJSON") )
		{
			if(response.success == "Updated Successfully"){$('.close').trigger('click');}
			
			swal(response.success, 
			{
			  icon: "success",
			  buttons: false,
			  timer: 1500,
			});
		}
		else
		{
			console.log(response);
			if(typeof response.responseJSON.errors !== 'undefined' )
			{
				$.each(response.responseJSON.errors, function (key, value) 
				{
					console.log(key , value);
					$('[name="' + key + '"]').parent().removeClass("has-valid true-validate");
					
					$('[name="' + key + '"]').parent().attr('data-validate',value);
					
					$('[name="' + key + '"]').parent().addClass("has-invalid alert-validate");
					

				});

			}
			else
			{
				swal(
					"Error",
					response.responseText,
				);
				
			}
		}

	});
	$(document).on( "click",".delete-button", function(event) 
	{
		event.preventDefault(); 

		var url = $(this).data('url');
		var type = 'GET';
		var processData = true;
		var contentType = false;
		
		var formData = {};
		
		swal(
		{
		  title: "Do you want to delete this task?",
		  text: "If you delete it , you can not recover it",
		  icon: "warning",
		  buttons:  ["Cancel", "Ok"],
		  dangerMode: true,
		})
		.then((willDelete) => 
		{
		  if (willDelete) 
		  {
			var response = ajax(type,url,processData,contentType,formData);
			if(response.success == "Deleted Successfully")
			{
				swal(response.success, 
					{
					  icon: "success",
					  buttons: false,
					  timer: 1500,
					});
			}
			else
			{
				console.log(response);
				swal(
						"Error Not Deleted", 
						"Error: "+ response.responseJSON.message
					);
			}
		  }
		  else 
		  {
			swal("Your task is safe",{buttons: false,
					  timer: 1000,});
		  }
		});
		
	});
	
	
	function setPriority()
	{
		var divs = $("#to-do").find('.task');
		var numbers=[];
		$.each(divs, function( index, value ) 
		{
			//console.log($(this).data("priority"));
			numbers.push({
				id:   $(this).data("id")
			});
		});
		//console.log(numbers);
		var url = $("#to-do").data('url');
		url = url.replace(':numbers', JSON.stringify(numbers));
		//console.log(url);
		var type = 'GET';
		var processData = true;
		var contentType = false;
		var formData = {proj_id:$("[name='proj_id']").val()};
		response = ajax(type,url,processData,contentType,formData);
		if(response.hasOwnProperty("success") && !response.hasOwnProperty("responseJSON") )
		{
			swal(response.success, 
			{
			  icon: "success",
			  buttons: false,
			  timer: 1500,
			});
		}
		else
		{
			swal(
					"Error",
					response.responseText,
				);
			
		}
		
	}
	
	
	
	
});