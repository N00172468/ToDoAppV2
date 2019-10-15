<?php
# @Author: John Carlo M. Ramos
# @Date:   2019-10-15T14:21:40+01:00
# @Email:  !!!!!---CTRL + ALT + C = Colour Picker---!!!!!
# @Last modified by:   John Carlo M. Ramos
# @Last modified time: 2019-10-15T14:55:35+01:00




namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Auth;
use Hash;
use Storage;

class ProfileController extends Controller
{
    public function __construct(){
      $this->middleware('auth');
    }

    public function index(){
      return view('user.profile');
    }

    public update(){
      $rules = [
        'name' => 'required|string|min:3|max:191',
        'email' => 'required|email|min:3|max:191',
        'password' => 'nullable|string|min:5|max:191',
        'image' => 'nullable|image|max:1999',
      ];
      $request->validate($rules);

      $user = Auth::user();
      $user->name = $request->name;
      $user->email = $request->email;

      if($request->hasFile('image')){
        $image = $request->image;
        $ext = $image->getClientOriginalExtension();
        $filename = uniqid().'.'.$ext;
        
        $image->storeAs('public/images',$filename);
        Storage::delete("public/images/{$user->image}");
        $user->image = $filename;
      }

      if($request->password){
        $user->password = Hash::make($request->password);
      }

      $user->save();
      return redirect()
        ->route('profile.index')
        ->with('status','Your profile has been updated!');
    }
}
