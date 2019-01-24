<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script>
    $(function(){
      $("#menu").sortable({
     
        stop: function(){
              
         
             updateToServer();
        //   $.map($("#menu").find('li'), function(el) {
              
        //     var itemID = el.id;
        //     var itemIndex = $(el).index();
        //     $.ajax({
        //       url:'{{URL::to("order-menu")}}',
        //       type:'GET',
        //       dataType:'json',
        //     //  data: $(this).sortable("serialize"),
        //     //data:{itemID:itemID, itemIndex: itemIndex.serialize(),
        //       data: {itemID:itemID, itemIndex: itemIndex , _token: '{{csrf_token()}}'},
        //     })
        //   });
        }
      });

      function updateToServer(){
          var order = [];
          $('li.row1').each(function(index,el){
              order.push({
                    id: $(this).attr('data-id'),
                    position: $(el).index() 
              });

          });
          $.ajax({
                type: "GET",
                datatype: "json",
                url:'{{URL::to("order-menu")}}',
                data: {
                    order:order
                },
                beforeSend: function(){
                $('.center').removeClass('hide');
                    },
                success: function(response) {
                    $('.center').addClass('hide');
                  // $('.center').delay(1000).slideUp(400);
            if (response.status == "success") {
              
              console.log(response);
            } else {
              console.log(response);
            }
        }
          });

      }


    });
</script>
<style>
	#menu {
	padding: 0px;
}
#menu li {
    counter-increment: my-awesome-counter;
	list-style: none;
	margin-bottom: 10px;
	border: 1px solid #d4d4d4;
			-webkit-border-radius: 3px;
			-moz-border-radius: 3px;
			border-radius: 3px;
			border-color: #D4D4D4 #D4D4D4 #BCBCBC;
			padding: 6px;
			cursor: move;
			background: #f6f6f6;
			background: -moz-linear-gradient(top,  #ffffff 0%, #f6f6f6 47%, #ededed 100%);
			background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#ffffff), color-stop(47%,#f6f6f6), color-stop(100%,#ededed));
			background: -webkit-linear-gradient(top,  #ffffff 0%,#f6f6f6 47%,#ededed 100%);
			background: -o-linear-gradient(top,  #ffffff 0%,#f6f6f6 47%,#ededed 100%);
			background: -ms-linear-gradient(top,  #ffffff 0%,#f6f6f6 47%,#ededed 100%);
			background: linear-gradient(to bottom,  #ffffff 0%,#f6f6f6 47%,#ededed 100%);
			filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#ededed',GradientType=0 );
}
ul {
  /* Set "my-sec-counter" to 0 */
  counter-reset: my-sec-counter;
}
li::before {
  /* Increment "my-sec-counter" by 1 */
  counter-increment: my-sec-counter;
  content:  counter(my-sec-counter) ". ";
}

.center {
   width: 300px;
   height: 300px;
   position: absolute;
   left: 50%;
   top: 50%; 
   margin-left: -150px;
   margin-top: -150px;
}

</style>

<div class="box-body table-responsive">
				@if(isset($menu))
				@if(count($menu) > 0)
				<ul id="menu" class="sortable">
						@foreach($menu as $menus)
						<li class='row1' data-id="{{$menus->id}}">
							<a>{{$menus->name}}</a> 
						</li>
						@endforeach
					</ul>
					@endif
					@endif
                    <div class="center hide"><h1> <strong> Please Wait</strong></h1></div>
				</div>