
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>





<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#"> Drap and Drop</a>
    </div>
    @foreach($menu as $menus)
    <ul class="nav navbar-nav">
      <li><a href="#">{{$menus->home}}</a></li>
      <li><a href="#">{{$menus->contact}}</a></li>
      <li><a href="#">{{$menus->about}}</a></li>
     
    </ul>
    @endforeach
  </div>
</nav>


<div class="container">
<table class="table table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>status</th>
        <th >Sorting</th>
        <th>created at</th>
        <th>updated at</th>
      </tr>
    </thead>
    <tbody>
    @foreach($sort as $sorts)
      <tr>
      <td>{{$sorts['id']}}</td>
        <td>{{$sorts['name']}}</td>
        <td>{{$sorts['status']}}</td>
        <td>{{$sorts['sorting']}}</td>
        <td>{{$sorts['created_at']->diffForHumans()}} </td>
        <td>{{$sorts['updated_at']->diffForHumans()}} </td>
      </tr>
      @endforeach
    </tbody>
  </table>

  </div>

</body>
</html>

