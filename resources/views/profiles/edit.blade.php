@extends('layouts.app')
@section('title')
    Edit Profile
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-lg-offset-4">
                {{--message section--}}
                @if(session()->has('success'))
                    <h1 class="alert alert-success">{{session()->get('success')}}</h1>
                @endif
                @foreach($users as $user)
                <form action="{{url('/profile/'.$user->user->id)}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    {{method_field('PUT')}}
                        <legend>Edit {{$user->user->name}}'s pfofile</legend>
                        <fieldset>
                            <label for="location">Location</label>
                            <input type="text" id="location" class="form-control" name="location" value="{{$user->location}}" required>
                        </fieldset>
                        <fieldset>
                            <label for="avater">Avater</label>
                            <input type="file" id="avater" class="form-control" name="avater" accept="image/*">
                        </fieldset>
                        <fieldset>
                            <label for="about">About</label>
                            <textarea name="about" id="" class="form-control" id="about" cols="30" rows="10" required>{{$user->about}}</textarea>
                        </fieldset>
                        <fieldset>
                            <input type="submit" class="btn btn-primary" value="Submit">
                        </fieldset>

                </form>
                @endforeach
            </div>
        </div>
        </div>
    </div>
@endsection