@extends('layouts.app')
@section('content')

<h2> {{$album->name}}</h2> 
<br>
<a href="/album" class="btn btn-primary">Go Back </a>  <a href="/photo/create/{{$album->id}}" class=" btn btn-secondary">Upload Photo in this album</a>
    <hr>

@foreach($album->photos as $photo)
    
  
  <a href="/photo/{{$photo->id}}">  <img width="500px" src="/storage/photos{{$photo->album_id}}/{{$photo->photo}}" alt="{{$photo->title}}"></a>

    @endforeach

@endsection