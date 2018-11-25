@extends('layouts.app')
@section('content')
<h1>This is album</h1>
<a class="btn btn-primary"  href="/album/create">Create Album</a>
<br><br>

<div class="grid-container">
  @if(count($album) > 0)


@foreach($album as $albums)

    
    {{$albums->name}}<br>
   <div class="grid-item"> <a href="/album/{{$albums->id}}"> <img class=" thumbnail" src="/storage/album_covers/{{$albums->cover_image}}" width="197px" alt=""></a></div>

@endforeach

@endif
</div>
@endsection