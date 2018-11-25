@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                {!! Form::open(['action' => 'ListingsController@store' , 'method' => 'POST']) !!}
                    {{Form ::bsText('company','',['placeholder'=> 'company Name'])}}
                    {{Form ::bsText('email','',['placeholder'=> 'Email'])}}
                    {{Form ::bsText('website','',['placeholder'=> 'Website'])}}
                    {{Form ::bsTextArea('bio','',['placeholder'=> 'Bio'])}}
                    {{Form ::bsSubmit('submit')}}
                
                
                {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>




@endsection