@extends('layouts.app')

@section('content')

 <div  class="card-header">Latest business Listing
 

 
 <a   href="/listing/create" class="float-right btn btn-success btn-xs">Add listing</a> 
 
  
   </div>

<table class="table table-striped">
                    <tr>
                    <th>Company</th>
                    <th>Website</th>
                    <th>bio</th>
                    </tr>
                    @foreach($listing as $listings)
                    <tr>
                    <td> <a href="/listing/{{$listings->id}}"> {{$listings->company}}</a> </td>
                    <td> {{$listings->website}} </td>
                    <td>{{$listings->bio}}</td>                   
                    
                    
                    </tr>                                
                    @endforeach
                    </table>

{{$listing->links()}}

@endsection
