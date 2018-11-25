 @extends('layouts.app')
@section('content')
<div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Lisiting</div>
                <div class="card-body">
                {!! Form::open(['action' => ['ListingsController@update', $listing->id] , 'method' => 'POST']) !!}
                    {{Form ::bsText('company',$listing->company,['placeholder'=> 'company Name'])}}
                    {{Form ::bsText('email',$listing->email,['placeholder'=> 'Email'])}}
                    {{Form ::bsText('website',$listing->website,['placeholder'=> 'Website'])}}
                    {{Form ::bsTextArea('bio',$listing->bio,['placeholder'=> 'Bio'])}}
                    {{Form::hidden('_method' , 'PUT')}}
                    {{Form ::bsSubmit('submit')}}
                
                
                {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>




@endsection 
