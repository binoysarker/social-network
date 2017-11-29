@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Home Page</div>

                @if(auth()->check())
                    <div class="panel-body">
                        <ul class="list-group">
                            @foreach($users as $user)
                                <li class="list-group-item">
                                    <span><img src="{{Storage::url(''.$user->avater)}}" style="width:70px;height: 70px;border-radius: 50%;" alt=""></span>
                                    <span class="text-info">{{$user->name}}</span>
                                    <nav class="navbar navbar-right">
                                        <a href="{{url('/add-friend/'.auth()->id().'&'.$user->id)}}" class="btn btn-primary navbar-link">add friend</a>
                                        <a href="{{url('/accept-friend/'.$user->id.'&'.auth()->id())}}" class="btn btn-primary navbar-link">accept friend</a>
                                        <a href="" class="btn btn-primary navbar-link">link1</a>
                                    </nav>
                                </li>
                            @endforeach
                        </ul>
                        {{$users->links()}}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
