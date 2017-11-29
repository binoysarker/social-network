<?php

namespace App\Traits;


use App\Models\Friendship;

trait Friendable
{
    public function add_friend($user_requested_id)
    {
        if ($this->is_friends_with($user_requested_id)){
            $notification = array(
                'message' => 'already friend !'.$user_requested_id,
                'alert-type' => 'warning'
            );
            return redirect()->back()->with($notification);
        }
        if ($user_requested_id == $this->id){
            $notification = array(
                'message' => 'same person !',
                'alert-type' => 'warning'
            );
            return redirect()->back()->with($notification);

        }
        if ($this->has_pending_friend_request_sent_to($user_requested_id)){
            $notification = array(
                'message' => 'friend request is already sent !',
                'alert-type' => 'warning'
            );
            return redirect()->back()->with($notification);
        }
        if ($this->has_pending_friend_request_from($user_requested_id)){
            return $this->accept_friend($user_requested_id);
        }
        $friendship = Friendship::create([
            'requester' => $this->id,
            'user_requested' => $user_requested_id,
        ]);

        if ($friendship){
            $notification = array(
                'message' => 'request sent !',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }
        else{
            $notification = array(
                'message' => 'not sent !',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    public function accept_friend($user_requested_id)
    {
        /*if ($this->has_pending_friend_request_from($user_requested_id)){
            $notification = array(
                'message' => 'same friend !',
                'alert-type' => 'warning'
            );
            return redirect()->back()->with($notification);
        }*/
        $friendship = Friendship::where('requester',$user_requested_id)->where('user_requested',$this->id)->where('status',0)->first();

        if ($friendship){
            $friendship->update([
                'status' => 1
            ]);
            $notification = array(
                'message' => 'friend accepted !',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);

        }
        else{
            $notification = array(
                'message' => 'not accepted !',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

    }

    public function remove_friend($user_requested)
    {
        if ($this->id == $user_requested){
            $friendship1 = Friendship::where('user_requested',$this->id)->where('requester',$user_requested)->where('status',1)->first();
            if ($friendship1){
                $friendship1->delete();
                $notification = array(
                    'message' => 'friend removed !',
                    'alert-type' => 'warning'
                );
                return redirect()->back()->with($notification);

            }
        }
        else{
            $friendship = Friendship::where('user_requested',$user_requested)->where('requester',$this->id)->where('status',1)->first();
            if ($friendship){
                $friendship->delete();
                $notification = array(
                    'message' => 'friend removed !',
                    'alert-type' => 'warning'
                );
                return redirect()->back()->with($notification);

            }
            else{
                $notification = array(
                    'message' => 'not rejected !',
                    'alert-type' => 'error'
                );
                return redirect()->back()->with($notification);
            }
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
        $f2 = Friendship::where('status',1)->where('user_requested',$this->id)->get();

        foreach ($f2 as $friendship) {
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

    public function is_friends_with($user_requested_id)
    {
        if (in_array($user_requested_id,$this->friends_id()->toArray())){

            return true;
        }
        else{
            return false;
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
    public function has_pending_request_sent($user_requested_id)
    {
        $users = [];
        $f1 = Friendship::where('requester',$user_requested_id)->where('status',0)->get();

        foreach ($f1 as $friendship) {
            array_push($users,\App\User::find($friendship->user_requested));
        }
        return $users;
    }
    public function pending_friend_request_sent_ids($user_requested_id)
    {
        return collect($this->has_pending_request_sent($user_requested_id))->pluck('id')->toArray();
    }

    public function pending_friend_request_ids()
    {
        return collect($this->has_pending_request())->pluck('id')->toArray();
    }

    public function has_pending_friend_request_from($user_requested_id)
    {
        if(in_array($user_requested_id,$this->pending_friend_request_ids())){

            return true;
        }
        else{
            return false;
        }
    }
    public function has_pending_friend_request_sent_to($user_requested_id)
    {
        if(in_array($user_requested_id,$this->pending_friend_request_sent_ids($user_requested_id))){

            return true;
        }
        else{
            return false;
        }
    }
}
