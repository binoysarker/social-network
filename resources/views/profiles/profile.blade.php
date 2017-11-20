@extends('layouts.app')
@section('title')
    Profile
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-lg-offset-4">
               <div class="panel panel-default">
                       <div class="panel-heading text-center">
                           <img src="{{Storage::url(''.$user->avater)}}" style="width: 70px;height: 70px;border-radius: 50%;" alt="">
                           <h3>{{$user->name}}</h3>
                           <p>{{$user->profile->location}}</p>
                       </div>
                   <div class="panel-body">
                       <h3 class="text-center">About Me</h3>
                       <p class="text-center">{{$user->profile->about}}</p>
                   </div>
                   <div class="panel-body">
                       <p class="text-center">
                           @if(auth()->id() == $user->id)
                               <a href="{{url('/profile/'.$user->id.'/edit')}}" class="btn btn-lg btn-primary">Edit Profile</a>
                           @endif
                       </p>
                   </div>
               </div>
            </div>
        </div>
        </div>
    </div>
@endsection