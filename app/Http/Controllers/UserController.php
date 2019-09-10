<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\User;
use Illuminate\Http\Request;
use App\Role;
use App\Image;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    function __construct()
    {
        $this->middleware('role:admin')->except("show");
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::all();
        $roles = Role::all();
        return view('User.index',['users'=>$users,'roles' => $roles]);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        //
        $validate_data = $request->validated();
        $validate_data['password'] = Hash::make($validate_data['password']);
        $user = User::create($validate_data);

        $user->roles()->attach($request->role_id);

        return back()->with('msg',"this account have been added successfuly");
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //

        
        return view('user.profile');
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
        if ($request->has('role_id'))    {
            $user = User::find($id);
            
            if ($user) {
                if ($user->roles()->sync($request->role_id)) {
                   return back()->with('msg','The User Updated Successfuly');
                }
            }
        } else {
            $user = user::find($id);

            $this->authorize('update',$user);

            $validate_data = $request->validate([
                'name'=>'max:255',

                'email'=>'max:255',

                'password'=>'confirmed|max:255|min:6',

                'password_confirmation'=>'max:255|min:6',

            ]);
            $validate_data['password'] = Hash::make($validate_data['password']);
            

            $user->fill($validate_data);

            $user->save();
            
            return back()->with('msg',"your account have beem updated successfuly");
            
            
            
        }       



        

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
        $user = User::find($id);
        if ($user) {
            $user->delete();
        } else {
            return back()->with('errors','This user is not in database');
        }
        return back()->with('msg','This user is have been delete');
    }

    public function update_image(Request $request) {
        $validation = $request->validate([
            'profile_picture' => 'required|image|mimes:jpg,png,jpeg|dimensions:min_height=500,min_width=500,ratio=1',
        ]);
        
        $image = $request->file('profile_picture');
        $dt = Carbon::now();
        $image = Storage::putFileAs('users', $image , Auth::user()->name . "."
         .$dt->hour."-$dt->minute-$dt->second.".$image->guessExtension());

         $profile_image = Image::create(['path'=>$image]);

         Auth::user()->image()->sync($profile_image);
    }
}
