@extends('layouts.app')
@section('title')
    Edit Profile
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-lg-offset-4">
                {{--error message--}}
                @if($errors->any())
                    @foreach($errors->all() as $error)
                        <ul>
                            <li class="alert alert-danger">{{$error}}</li>
                        </ul>
                    @endforeach
                @endif
                {{--@foreach($users as $user)--}}
                <form action="{{url('/profile/'.$profile->user->id)}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    {{method_field('PUT')}}
                        <legend>Edit {{$profile->user->name}}'s pfofile</legend>
                        <fieldset>
                            <label for="location">Location</label>
                            <input type="text" id="location" class="form-control" name="location" value="{{$profile->location}}" required>
                        </fieldset>
                        <fieldset>
                            <label for="avater">Avater</label>
                            <input type="file" id="avater" class="form-control" name="avater" accept="image/*">
                        </fieldset>
                        <fieldset>
                            <label for="cover_photo">Cover Photo</label>
                            <input type="file" id="cover_photo" class="form-control" name="cover_photo" accept="image/*">
                        </fieldset>
                        
	                    <fieldset>
                            <label for="about">About</label>
                            <textarea name="about" id="" class="form-control" id="about" cols="30" rows="10" required>{{$profile->about}}</textarea>
                        </fieldset>
	                    
	                    <fieldset>
                            <label for="address">Address</label>
                            <textarea name="address" id="" class="form-control" id="address" cols="30" rows="10" required>{{$profile->address}}</textarea>
                        </fieldset>
	                    
	                    
                        <fieldset>
                            <input type="submit" class="btn btn-primary" value="Submit">
                        </fieldset>

                </form>
                {{--@endforeach--}}
            </div>
        </div>
        </div>
    </div>




@endsection