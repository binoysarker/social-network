<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class FriendshipController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /*
     *to search all the users from the users table
     */
    public function searchAll($slug)
    {
        $user = User::where('name','like','%'.$slug.'%')->get();
        return $user;
    }

    /*
     *This section is only for controlling the friendship
     * with single specific functions
     */


    public function add_friend($requester,$user_requested)
    {
        return User::find($requester)->add_friend($user_requested);
    }
    public function accept_friend($requester,$user_requested)
    {
        return User::find($requester)->accept_friend($user_requested);
    }
    public function remove_friend($requester,$user_requested)
    {
        return User::find($requester)->remove_friend($user_requested);
    }
    public function all_friends($requester)
    {
        return User::find($requester)->all_friends();
    }
    public function show_friend_request($requester)
    {
        return User::find($requester)->show_friend_request();
    }
    public function friends_id($requester)
    {
        return User::find($requester)->friends_id();
    }
    public function is_friends_with($requester,$friend_id)
    {
        return User::find($requester)->is_friends_with($friend_id);
    }
    public function has_pending_request($requester)
    {
        return User::find($requester)->has_pending_request();
    }
    public function has_pending_request_sent($requester)
    {
        return User::find($requester)->has_pending_request_sent();
    }
    public function has_pending_friend_request_from($requester,$friend_id)
    {
        return User::find($requester)->has_pending_friend_request_from($friend_id);
    }
    public function has_pending_friend_request_sent_to($requester,$friend_id)
    {
        return User::find($requester)->has_pending_friend_request_sent_to($friend_id);
    }




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
