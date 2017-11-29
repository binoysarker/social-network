@extends('layouts.app')
@section('title')
    {{strtoupper(auth()->user()->name)}}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">

            {{--main content section--}}
            <div class="col-lg-8">
               <div class="panel panel-default">
                   <div class="panel-body ">
                       <profile-cover >
                           <template slot="profile-cover">
	                           {{--profile image--}}
	                           <img src="{{Storage::url(''.$user->avatar)}}"
	                                alt="profile picture"
	                                @mouseover="isActive = !isActive"
	                                class="img-responsive profileImg">
	                           {{----}}
	                           <a href="/profile/{{$user->id}}/edit"
	                              title="Edit Photo"
	                              class=" navbar-inverse"
	                              :class="{ProfileEditIcon:isActive}"
	                              v-if="isActive" ><i class="fa fa-camera white" aria-hidden="true">Edit Profile Photo</i></a>
	                           <a href="/profile/{{$user->id}}/edit"
	                              title="Edit Photo"
	                              class=" navbar-inverse"
	                              :class="{CoverEditIcon:isAnotherActive}"
	                              v-if="isAnotherActive" ><i class="fa fa-camera white" aria-hidden="true">Edit Cover Image</i></a>
                               {{--cover image--}}
	                           <img src="{{Storage::url(''.$user->cover_photo)}}"
	                                class="img-responsive coverImg"
	                                @mouseover="isAnotherActive = !isAnotherActive"
	                                alt="cover Photo">
                           </template>
                           <template slot="cover-navbar">
                               <ul class="nav navbar-nav navbar-right">
                                   <li class="active"><router-link to="{{'/profile/'.$user->slug.'/time-line'}}">TimeLine</router-link></li>
                                   <li><router-link to="{{'/profile/'.$user->slug.'/about'}}">About</router-link></li>
                                   <li><router-link to="{{'/profile/'.$user->slug.'/friends'}}">Friends</router-link></li>
                                   <li><router-link to="{{'/profile/'.$user->slug.'/photos'}}">Photos</router-link></li>
                               </ul>
                           </template>
                       </profile-cover>
                   </div>
               </div>
                <div class="panel panel-default">
                    <router-view :user="{{$user}}">

                    </router-view>
                </div>

            </div>
            {{--right sidebar/chat section--}}
            <div class="col-lg-3 col-lg-offset-1">
                <div class="list-group">
                    <a href="#" class="list-group-item list-group-item-action active">Active item</a>
                    <a href="#" class="list-group-item list-group-item-action">Item</a>
                    <a href="#" class="list-group-item list-group-item-action disabled">Disabled item</a>
                </div>
            </div>

        </div>
        </div>
    </div>
@endsection