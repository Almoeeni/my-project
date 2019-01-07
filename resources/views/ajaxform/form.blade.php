<!DOCTYPE html>
<html>
<head>
	<title>Ajax Validation Example</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
	<meta name="_token" content="{{csrf_token()}}" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
	<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>
	<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/additional-methods.min.js"></script>
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->

<!-- Latest compiled JavaScript -->
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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



<div class="table-responsive text-center">
<table class="table table-borderless" id="table">
<thead>
<tr>
<th class="text-center">#</th>
<th class="text-center">Name</th>
<th class="text-center">Email</th>
<th class="text-center">Actions</th>

</tr>
</thead>
@foreach($data as $item)
<tr class="item{{$item->id}}">
<td>{{$item->id}}</td>
<td>{{$item->name}}</td>
<td>{{$item->email}}</td>
<td>   
<button class="btn btn-info open-modal" data-id="{{$item->id}}" data-name="{{$item->name}}" data-email="{{$item->email}}">Edit</button>
<button class="btn btn-danger delete-link" value="{{$item->id}}">Delete</button>
</td>
</tr>
@endforeach
</table>

</div>
{{ $data->links() }}
</div>

<div class="modal fade" id="linkEditorModal" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="linkEditorModalLabel">Update form </h4>
                        </div>
                        <div class="modal-body">
                            <form id="modalFormData" name="modalFormData" class="form-horizontal" method="post">
						  		<input name="_method" type="hidden" value="PATCH">
 
                                <div class="form-group">
                                    <label for="inputLink" class="col-sm-2 control-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="mname" name="name"
                                              value="">
                                    </div>
                                </div>
 
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="memail" name="email"
                                              value="">
                                    </div>
                                </div>
							
                            </form>
                        </div>
                        <div class="modal-footer">
						<button type="submit" class="btn btn-primary" id="btn-update" value="add">Save changes
                            </button>
                            <input type="hidden" id="link_id" name="link_id" value="0">
                        </div>
                    </div>
                </div>
            </div>
        
   <!-- Form Edit and Delete Post        -->
   <div id="myModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="model-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					 <h4 class="modal-title"></h4>
				</div>
				<div class="modal-body">
					<form  class="form-horizontal" role="modal">

						<div class="form-group">
							<label class="control-label col-sm2" for="id">ID</label>
							<input type="text" class="form-control" id="fid" disabled>
						</div>
						<div class="form-group start">
							<label class="control-label" for="inputSuccess1">Name:</label>
							<input type="text" id="t" name="name" class="form-control" aria-describedby="helpBlock2">		
						</div>
						<div class="form-group start">
							<label for="inputSuccess1" class="control-label">Email</label>
							<input type="email" class="form-control" id="b" name="email" aria-describedby="helpBlock2">

						</div>
					</form>
				</div>
				<div class="modal-footer" >
				 <button type="button"   class=" btn actionBtn" data-dismiss='modal'>
					<span id="footer_action_button" class="glyphicon"></span>
				 </button>	
				 <button type="button" class="btn btn-warning" data-dismiss="modal">
				 	<span class="glyphicon glyphicon"></span>Remove
				 </button>		
				</div>
			</div>
		</div>
   </div>


		  
<script >


	$(document).ready(function() {

	// 	$('body').on('click', '.open-modal', function () {
    //     var link_id = $(this).val();
    //     $.get('links/' + link_id, function (data) {
    //         $('#link_id').val(data.id);
    //         $('#mname').val(data.name);
    //         $('#memail').val(data.email);
    //         $('#btn-save').val("update");
	// 		$('#linkEditorModal').modal('show');
    //     })
    // });

	$(document).on('click', '.open-modal',function(){
		$('#footer_action_button').text('update post');
		$('#footer_action_button').addClass('glyphicon-check');
		$('#footer_action_button').removeClass('glyphicon-trash');
		$('#actionBtn').addClass('btn-success');
		$('#actionBtn').removeClass('btn-danger');
		$('#actionBtn').addClass('edit');
		$('.modal-title').text('Post Edit');
		$('.deleteContent').hide();
		$('.form-horizontal').show();
		$('#fid').val($(this).data('id'));
		$('#t').val($(this).data('name'));
		$('#b').val($(this).data('email'));
		$('#myModal').modal('show');		
		
	});


	$('.modal-footer').on('click',  function(){
		var link_id = $('#fid').val();
		console.log(link_id);
		$.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              });
		$.ajax({
			type: 'POST',
			url: 'ajaxupdate/'+link_id,
			data:{
				
				'id' : $('#fid').val(),
				'name': $('#t').val(),
				'email': $('#b').val()
			},
			success:function(data){
				$("#done").html(data.success);
			}
		});
	});




		
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
		
		

		var validator = $('#myform ').validate({
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

		// Update ajax modal form
		 
		//  $('#modalFormData').click(function(e){
		// 	 e.preventDefault();
		// 	$.ajaxSetup({
        //           headers: {
        //               'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        //           }

		// $.ajax({

		// 		  });
        //       });
		//  });



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