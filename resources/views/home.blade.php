@extends('layouts.app')
@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard <span class="float-right"> <a href="/listing/create">Create list</a> </span></div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table table-striped">
                    <tr>
                    <th>Company</th>
                    <th>Bio</th>
                    <th></th>
                    </tr>
                    @foreach($user->listing as $listing)
                    <tr>
                    <td> {{$listing->company}} </td>
                    <td> {{$listing->bio}} </td>
                    <td> <a href="/listing/{{$listing->id}}/edit" class="btn btn-primary float-right"> Edit</a> </td>                   
                    
                    <td> {!! Form::open(['action' => ['ListingsController@destroy', $listing->id] , 'method' => 'POST',
                    'class' => 'float-right' , 'onsubmit' => 'return confirm("Are you sure want to delete? ")']) !!}                               
                               {{Form::bsDelete('Delete')}}
                                {{Form::hidden('_method' ,'DELETE')}}
                             {!! Form::close() !!}
                      </td>
                    </tr>                                
                    @endforeach
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
    
@endsection