<!DOCTYPE html>
<html>
<head>
	<title>Laravel Ajax Validation Example</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
	<meta name="_token" content="{{csrf_token()}}" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
</head>
<body>


<div class="container">
	<h2>Laravel Ajax Validation</h2>

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
		<div class="form-group">
			<label> Name:</label>

			<input type="text" id="name" name="name" class="form-control">
			<span id="nam"></span>
			
		</div>


		<div class="form-group">
			<strong>Email:</strong>
			<input type="text" id="email" name="email" class="form-control" >
			<span id="eml"></span>
		</div>


		<div class="form-group">
			<strong>Password:</strong>
            <input type="password" id="password" name="password" class="form-control">
			<span id="pass"></span>
		</div>
        <div class="form-group">
			<strong> Confirm Password:</strong>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
		</div>


		<div class="form-group">
			<button class="btn btn-success btn-submit">Submit</button>
		</div>
	</form>
</div>


<script >


	$(document).ready(function() {
	    $(".btn-submit").click(function(e){
	    	e.preventDefault();
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
						//console.log(data.error[0]);
	                	 //printErrorMsg(data.error);
					//	$("#done").html(data.error);
				//	$("#done").html(data.error[0]);
					
					// $("#nam").html(data.error[0];
					// if(data.error[0] ){
					// 	$("#nam").html(data.error[0]);
					// }
					// if(data.error[1]){
					// 	$("#eml").html(data.error[1]);
					// }
					// if(data.error[2]){
					// 	$("#pass").html(data.error[2]);
					// }
					
					// $("#eml").html(data.error[1]);
					// $("#pass").html(data.error[2]);

					$(".print-error-msg").find("ul").html('');
					$(".print-error-msg").css('display','block');
					$.each( data.error, function( key, value ) {
					$(".print-error-msg").find("ul").append('<li>'+value+'</li>');
					});

	               }
				
				  },
				 
	          
	        });


	    });
	
	});



</script>

</body>
</html>