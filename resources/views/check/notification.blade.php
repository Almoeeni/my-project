<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <form method="post" action="{{url('notification')}}">
    @csrf
    <input type="checkbox" name="option[]" value="1"  @if(in_array("1", $pluckedDetails )) checked @endif >
    <input type="checkbox" name="option[]" value="2"  @if(in_array("2", $pluckedDetails )) checked @endif >
    <input type="checkbox" name="option[]" value="3"  @if(in_array("3", $pluckedDetails )) checked @endif >
    <input type="checkbox" name="option[]" value="4"  @if(in_array("4", $pluckedDetails )) checked @endif >

  <button type="submit" class="btn btn-success" style="margin-left:38px">Submit</button>
    </form>


</body>
</html>