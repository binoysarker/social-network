<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\User;
use Illuminate\Http\Request;

class profilesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(4);
        return view('profiles.home',compact('users'));
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
    public function show($slug)
    {
        $user = User::where('slug',$slug)->with('profile')->first();
        return view('profiles.profile',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $profile = Profile::where('user_id',$id)->with('user')->first();
        return view('profiles.edit',compact('profile'));
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
        $this->validate($request,[
            'location' => 'required|max:55',
            'about'    =>  'required|max:1024',
	          'avatar'   =>   'file|image|max:30|min:10',
	          'cover_photo'   =>   'file|image|max:200|min:110',
        ]);
        $profile = Profile::where('user_id',$id)->with('user')->first();
	
	    if($request->hasFile('cover_photo')){
		    
		    $profile->user->update([
		    		'cover_photo'   => $request->file('cover_photo')->store('public/users/avatars/')
		    ]);
	    }
	    if ($request->hasFile('avatar')){
		    
		    $profile->user->update([
		    		'avatar'    => $request->file('avatar')->store('public/users/avatars/')
		    ]);
	    }
	    
	    $profile->update([
	    		'location' => $request->location,
	    		'about' => $request->about,
	    ]);
     
	    $notification = array(
            'message' => 'Profile Updated!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);


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
