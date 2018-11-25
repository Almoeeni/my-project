@extends('layouts.app')
@section('content')


<h1>{{$photo->title}}</h1>
<a href="/album/{{$photo->album_id}}" class="btn btn-secondary">Go back</a>
<hr>

<img width="500px" src="/storage/photos{{$photo->album_id}}/{{$photo->photo}}" alt="">
<br><br>

{!! Form::open(['action' => ['PhotosController@destroy', $photo->id],'method' => 'POST']) !!}

{{Form::hidden('_method','DELETE')}}
{{Form::bsDelete('delete')}}
{!! Form::close() !!}
<hr>




Size: {{$photo->size}}
@endsection