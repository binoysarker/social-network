<?php

namespace App\Traits;


use App\Friendship;

trait Friendable
{
    public function add_friend($user_requested_id)
    {
        if ($this->is_friends_with($user_requested_id) === 1){
            return 'already friend';
        }
        if ($this->id == $user_requested_id){
            return 0;

        }
        if ($this->has_pending_friend_request_sent_to($user_requested_id) === 1){
            return 'already sent a friend request';
        }
        if ($this->has_pending_friend_request_from($user_requested_id) === 1){
            return $this->accept_friend($user_requested_id);
        }
        $friendship = Friendship::create([
            'requester' => $this->id,
            'user_requested' => $user_requested_id,
        ]);

        if ($friendship){
            return 1;
        }
        else{
            return 0;
        }
    }

    public function accept_friend($requester)
    {
        if ($this->has_pending_friend_request_from($requester) === 0){
            return 0;
        }
        $friendship = Friendship::where('requester',$requester)->where('user_requested',$this->id)->first();

        if ($friendship){
            $friendship->update([
                'status' => 1
            ]);
            return 1;

        }
        else{
            return 0;
        }

    }

    public function all_friends()
    {
        $friends = [];
        $f1 = Friendship::where('status',1)->where('requester',$this->id)->get();

        foreach ($f1 as $friendship) {
            array_push($friends,\App\User::find($friendship->user_requested));
        }

        $friends2 = [];
        $f1 = Friendship::where('status',1)->where('user_requested',$this->id)->get();

        foreach ($f1 as $friendship) {
            array_push($friends2,\App\User::find($friendship->requester));
        }

        return array_merge($friends,$friends2);


    }
    public function show_friend_request()
    {
        $friends = [];
        $f1 = Friendship::where('status',0)->where('requester',$this->id)->get();

        foreach ($f1 as $friendship) {
            array_push($friends,\App\User::find($friendship->user_requested));
        }

        $friends2 = [];
        $f1 = Friendship::where('status',0)->where('user_requested',$this->id)->get();

        foreach ($f1 as $friendship) {
            array_push($friends2,\App\User::find($friendship->requester));
        }

        return array_merge($friends,$friends2);


    }

    public function friends_id()
    {
        return collect($this->all_friends())->pluck('id');
    }

    public function is_friends_with($user_id)
    {
        if (in_array($user_id,$this->friends_id()->toArray())){

            return 1;
        }
        else{
            return 0;
        }
    }
    public function has_pending_request()
    {
        $users = [];
        $f1 = Friendship::where('status',0)->where('user_requested',$this->id)->get();

        foreach ($f1 as $friendship) {
            array_push($users,\App\User::find($friendship->requester));
        }
        return $users;
    }
    public function has_pending_request_sent()
    {
        $users = [];
        $f1 = Friendship::where('status',0)->where('requester',$this->id)->get();

        foreach ($f1 as $friendship) {
            array_push($users,\App\User::find($friendship->user_requested));
        }
        return $users;
    }
    public function pending_friend_request_sent_ids()
    {
        return collect($this->has_pending_request_sent())->pluck('id')->toArray();
    }

    public function pending_friend_request_ids()
    {
        return collect($this->has_pending_request())->pluck('id')->toArray();
    }

    public function has_pending_friend_request_from($user_id)
    {
        if(in_array($user_id,$this->pending_friend_request_ids())){

            return 1;
        }
        else{
            return 0;
        }
    }
    public function has_pending_friend_request_sent_to($user_id)
    {
        if(in_array($user_id,$this->pending_friend_request_sent_ids())){

            return 1;
        }
        else{
            return 0;
        }
    }
}
