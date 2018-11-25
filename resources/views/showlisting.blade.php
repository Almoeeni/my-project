@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            
                <div class="card-header">{{$listing->company}} <a href="/" class="btn btn-outline-primary btn-xs float-right"> Go back</a></div>

                <div class="card-body">
                  <ul class="list-group">
                  <li class="list-group-item">Website : {{$listing->website}}</li>
                  </ul>
                    <hr>

                    <div class="card card-body bg-light">
                    {{$listing->bio}}
                    </div>                            
                  
                </div>
            </div>
        </div>
        
    </div>
    
@endsection