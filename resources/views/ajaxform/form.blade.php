<!DOCTYPE html>
<html>
<head>
	<title>Ajax Validation Example</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
	<meta name="_token" content="{{csrf_token()}}" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
	<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>
	<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/additional-methods.min.js"></script>
</head>

<style>
.bcolor {
	border: 1px solid green;
}
.help-block {
	font-weight: 100;
}
</style>
<body>


<div class="container">
	<h2>Ajax Validation</h2>

	<!-- <div class="alert alert-danger" style="display:none">
	<p>success</p>
	</div> -->
	<div class="alert alert-danger print-error-msg" style="display:none">
        <ul></ul>
    </div>

<div id="done">


</div>



	<form action="/ajaxform" method="post" id="myform">
		{{ csrf_field() }}


		


		<div class="form-group start">
			<label class="control-label" for="inputSuccess1">Name:</label>
			<input type="text" id="name" name="name" class="form-control" id="inputSuccess1" aria-describedby="helpBlock2">		
		</div>

	
		<div class="form-group start">
			<label class="control-label" for="inputSuccess1">Email:</label>
			<input type="email" id="email" name="email" class="form-control" id="inputSuccess1" aria-describedby="helpBlock2">
		</div>


		<div class="form-group start">
			<label class="control-label" for="inputSuccess1">Password:</label>
            <input type="password" id="password" name="password" class="form-control" id="inputSuccess1" aria-describedby="helpBlock2">			
		</div>

        <div class="form-group start">
			<label class="control-label" for="inputSuccess1">Confirm Password:</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control"id="inputSuccess1" aria-describedby="helpBlock2">		
		</div>


		<div class="form-group">
			<button class="btn btn-success btn-submit">Submit</button>
		</div>


	
	</form>
</div>


<script >


	$(document).ready(function() {
		
		$.validator.setDefaults({
			errorClass: 'help-block',
			highlight: function(element){
				$(element)
				.closest('.form-group')
				.removeClass('has-success')
				.addClass('has-error');
			},
			unhighlight: function(element){
				$(element)
				.closest('.form-group')
				.removeClass('has-error')
				.addClass('has-success');
			}
		});
		$.validator.addMethod('strongPassword', function(value , element){

				return this.optional(element)
				|| value.length >=8
				&& /\d/.test(value)
				&& /[A-z]/i.test(value);
				// && /^[a-zA-Z\s]+$/.test(value);
		}, 'Your password must be at at least 8 characters long and contains at lest one number and one special char\'.');
		
		

		var validator = $('#myform').validate({
			rules: {
				name: {
					required : true,
				

					},
				email: {
					
					email: true,

				},
				password: {
					required : true,
					minlength: 8,
					strongPassword: true
				
				},
				password_confirmation : {
					equalTo : "#password"
				}

			}

		});
	
	    $(".btn-submit").click(function(e){
			
			//$('.help-block').addClass('hide');
			$('.help-block').show();
	    	e.preventDefault();
			resetErrors();
			$.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              });


	        $.ajax({
	            url: "/ajaxform",
	            type:'POST',
				
				data: {
                     name: $('#name').val(),
                     email: $('#email').val(),
                     password: $('#password').val(),
					 password_confirmation: $('#password_confirmation').val()					
                  },
				  
				  success: function(data){
					if($.isEmptyObject(data.error)){
						$("#done").html(data.success);
						$(".print-error-msg").hide();
					
					

	                }else{
					
					
					$.each( data.error, function( i, v ) {
						console.log(i + " => " + v);						
						var err = '<span id="helpBlock2" class="help-block" for="'+i+'">'+v+'</span>';  										
                        $('input[name="' + i + '"]').after(err).parent('div.start').addClass('has-error');
						
					});

					
				//print(data.error);


	               }
				
				  },
				 
	          
	        });


	    });

		function print(msg){
			$(".print-error-msg").find("ul").html('');
					$(".print-error-msg").css('display','block');
					$.each( msg, function( key, value ) {
					$(".print-error-msg").find("ul").append('<li>'+value+'</li>');
					});

		}

		function resetErrors() 
		{
   			 $('div.start').removeClass('has-error');
			
   			 $('span.help-block').remove();
				
		}
	
	});




</script>

</body>
</html>