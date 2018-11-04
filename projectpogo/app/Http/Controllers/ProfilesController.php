<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;
use Illuminate\Support\Facades\Storage;

class ProfilesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profiles = Profile::orderBy('created_at', 'desc')->paginate(4);
        return view('profiles.index')->with('profiles', $profiles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('profiles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'level' => 'required',
            'team' => 'required',
            'city' => 'required',
            'friendcode' => 'required',
            'profile_images' => 'image|nullable|max:1999',
            'profile_qr' => 'image|nullable|max:1999'
        ]);

        // Handle File Upload Profile Image
        if($request->hasFile('profile_image')){
            // Get filename with extension
            $filenameWithExt = $request->file('profile_image')->getClientOriginalName(); 
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('profile_image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'_'.$extension;
            // Upload Image
            $path = $request->file('profile_image')->storeAs('public/profile_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage2.jpg';
        }

        // Handle File Upload Profile QR
        if($request->hasFile('profile_qr')){
            // Get filename with extension
            $filenameWithExt2 = $request->file('profile_qr')->getClientOriginalName(); 
            // Get just filename
            $filename2 = pathinfo($filenameWithExt2, PATHINFO_FILENAME);
            // Get just ext
            $extension2 = $request->file('profile_image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore2= $filename2.'_'.time().'_'.$extension2;
            // Upload Image
            $path2= $request->file('profile_qr')->storeAs('public/profile_qr', $fileNameToStore2);
        } else {
            $fileNameToStore2 = 'noimage3.jpg';
        }

        //Create Profile
        $profile = new Profile;
        $profile->name = $request->input('name');
        $profile->level = $request->input('level');
        $profile->team = $request->input('team');
        $profile->city = $request->input('city');
        $profile->friendcode = $request->input('friendcode');
        $profile->user_id = auth()->user()->id;
        $profile->profile_image = $fileNameToStore;
        $profile->profile_qr = $fileNameToStore2;
        $profile->save();

        return redirect('profiles/')->with('success', 'Profile Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $profile = Profile::find($id);
        return view('profiles.show')->with('profile', $profile);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $profile = Profile::find($id);

        // Check for correct user
        if(auth()->user()->id !==$profile->user_id){
            return redirect('/profiles')->with('error', 'Unauthorized Page');
        }
        return view('profiles.edit')->with('profile', $profile);
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
        $this->validate($request, [
            'name' => 'required',
            'level' => 'required',
            'team' => 'required',
            'city' => 'required',
            'friendcode' => 'required'
        ]);

        // Handle File Upload Profile Image
        if($request->hasFile('profile_image')){
            // Get filename with extension
            $filenameWithExt = $request->file('profile_image')->getClientOriginalName(); 
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('profile_image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'_'.$extension;
            // Upload Image
            $path = $request->file('profile_image')->storeAs('public/profile_images', $fileNameToStore);
        } 

         // Handle File Upload Profile QR
         if($request->hasFile('profile_qr')){
            // Get filename with extension
            $filenameWithExt2 = $request->file('profile_qr')->getClientOriginalName(); 
            // Get just filename
            $filename2 = pathinfo($filenameWithExt2, PATHINFO_FILENAME);
            // Get just ext
            $extension2 = $request->file('profile_qr')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore2 = $filename2.'_'.time().'_'.$extension2;
            // Upload Image
            $path2 = $request->file('profile_qr')->storeAs('public/profile_qr', $fileNameToStore2);
        } 

        //Update Profile
        $profile = Profile::find($id);
        $profile->name = $request->input('name');
        $profile->level = $request->input('level');
        $profile->team = $request->input('team');
        $profile->city = $request->input('city');
        $profile->friendcode = $request->input('friendcode');
        if($request->hasFile('profile_image')){
            $profile->profile_image = $fileNameToStore;
        }
        if($request->hasFile('profile_qr')){
            $profile->profile_qr = $fileNameToStore2;
        }
        $profile->save();

        return redirect('profiles/')->with('success', 'Profile Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $profile = Profile::find($id);

        // Check for correct user
        if(auth()->user()->id !==$profile->user_id){
            return redirect('/profiles')->with('error', 'Unauthorized Page');
        }

        // Do not destroy the noImage
        if($profile->profile_image != 'noimage2.jpg'){
            // Delete Image
            Storage::delete('public/profile_images/'.$profile->profile_image);

        }

        if($profile->profile_qr != 'noimage3.jpg'){
            // Delete Image
            Storage::delete('public/profile_qr/'.$profile->profile_qr);

        }
        
        $profile -> delete();

        return redirect('profiles/')->with('success', 'Profile Deleted');
    }

    public function search(Request $request)
        {
            $search = $request->input('search');

            if(empty($search))
                {
                    $profiles = Profile::orderBy('created_at', 'desc')->paginate(4);
                    return view('profiles/index')->with('profiles', $profiles);
                }
            else
                {
                    $profiles = Profile::where('name', 'LIKE', "%$search%")
                                ->orWhere('level', 'LIKE', "%$search%")
                                ->orWhere('team', 'LIKE', "%$search%")
                                ->orWhere('City', 'LIKE', "%$search%")
                                ->paginate(9);

                }
            return view('profiles/search')->with('profiles', $profiles);

         }
}
