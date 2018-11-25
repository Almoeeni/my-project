@extends('layouts.app')
@section('content')
<h1>This is album create</h1>



<div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                {!! Form::open(['action' => 'AlbumsController@store' , 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                    {{Form ::bsText('name','',['placeholder'=> 'Name'])}}
                    {{Form ::bsTextArea('description','',['placeholder'=> 'Description'])}}
                    {{Form ::file('cover_image')}}
<br><br>
                    {{Form ::bsSubmit('submit')}}
                
                
                {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>







@endsection