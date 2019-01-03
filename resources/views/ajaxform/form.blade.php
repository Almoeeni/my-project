<!DOCTYPE html>
<html>
<head>
	<title>Ajax Validation Example</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
	<meta name="_token" content="{{csrf_token()}}" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
</head>

<style>
.bcolor {
	border: 1px solid green;
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



	<form action="/ajaxform" method="post">
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
		
		$("#email").on('keypress',function()  {
    if ($(this).val() != null) {
      
        $("input[type=email]").css('border','1px solid green');
    } else  {

        $("input[type=email]").css('border','1px solid white');
    }
});
		//$('.help-block').removeClass('hide');
		// $('input').keypress(function(){
		// 	$('input').css("border-color" ,"green");
		// })
	
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