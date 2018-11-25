@extends('layouts.app')
@section('content')

<h3>Upload Photo</h3>

{!! Form::open(['action' => 'PhotosController@store' , 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                    {{Form ::bsText('title','',['placeholder'=> 'title'])}}
                    {{Form ::bsTextArea('description','',['placeholder'=> 'Description'])}}
                   
                    {{Form ::file('photo')}}
<br><br>            {{Form::hidden('album_id',$album_id)}}
                    {{Form ::bsSubmit('submit')}}
                
                
                {!! Form::close() !!}

@endsection