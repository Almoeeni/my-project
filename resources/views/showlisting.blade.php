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
    <hr>
    <div class="card" style="    width: 50%;
    margin-left: 25ox;
    height: 146px;
    left: 188px;">
            <div class="card-block" style="margin-left: 197px;
    height: 55%;">
              <div class="form-group">
              <form method="Post" action="/listing/{{$listing->id}}/comment">
              @csrf


                <textarea name="body" class="form-control"  cols="30" rows="5" placeholder=" type your comments here" required></textarea>

          
              <input type="submit" class="btn btn-primary" value="submit">
              
              </form>
              
              </div>
            </div>
            </div>

            <hr>

            <div class="card" style="    text-align: center;">
            @foreach($comments as $commen)
             <div>
                <li> {{$commen->body}} by {{$commen->user->name}}</li>   
                <strong>{{$commen->created_at->diffForHumans()}}</strong> 

             </div>
             
                @endforeach

               {{$comments->links()}}
              
            </div>
@endsection