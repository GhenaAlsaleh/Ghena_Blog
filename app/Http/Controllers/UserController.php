<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    
    public function index()
    {
        $this->authorize("manageUser",User::class);
        $users=User::all();
        return view("users.index",compact("users"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize("manageUser",User::class);
        return view("users.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize("manageUser",User::class);
        $request->validate([
            "name"=>"required|string",
            "email"=>"required|string|email|unique:users,email",
            "password"=>"required|string|min:5",
            "image"=>"required"
            
        ]);
        if($request->hasFile("image")){
            $imageName=$request->file("image")->getClientOriginalName()."-".time().".".$request->file("image")->getClientOriginalExtension();
            $request->file("image")->move(public_path("/images/users"),$imageName);
        }
        User::create([
            "name"=>$request->name,
            "email"=>$request->email,
            "password"=>$request->password,
            "image"=>$imageName
        ]);
        return redirect()->route("users.index");
    }

    public function show(User $user)
    {
        $this->authorize("manageUser",User::class);
        return view('users.show', compact('user'));
    }


    public function edit(User $user)
    {
        $this->authorize("manageUser",User::class);
        return view('users.edit', compact('user'));
    }
    public function changePassword(User $user)
     {
        $this->authorize("manageUser",User::class);
       return view('users.change-password',compact('user'));
    }  

    public function updatePassword(Request $request, User $user)
{
    $this->authorize("manageUser",User::class);
        # Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);


        #Match The Old Password
        if(!Hash::check($request->old_password, $user->password)){
            return back()->with("error", "Old Password Doesn't match!");
        
        }


        #Update the new Password
        $user->update([
            'password' => Hash::make($request->new_password)
        ]);
        return back()->with("status", "Password changed successfully!");
    
}



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $this->authorize("manageUser",User::class);
        if($request->hasFile("image")){
            if($request->email==$user->email){
            $request->validate([
                "name"=>"required|string",
                "image"=>"required"
            ]);
            }else{
              $request->validate([
                "name"=>"required|string",
                "email"=>"required|string|email|unique:users,email",
                "image"=>"required"
            ]);
           }
            $imageName=$request->file("image")->getClientOriginalName()."-".time().".".$request->file("image")->getClientOriginalExtension();
            $request->file("image")->move(public_path("/images/users"),$imageName);
            $image_path=public_path("/images/users/".$user->image);
             if(file_exists($image_path))
              {
               unlink($image_path);
              }
        }else{
            if($request->email==$user->email){
                $request->validate([
                    "name"=>"required|string"
                ]);
                }else{
                  $request->validate([
                    "name"=>"required|string",
                    "email"=>"required|string|email|unique:users,email"
                ]);
               }
            $imageName=$user->image;
        }
        $user->update([
            "name"=>$request->name,
            "email"=>$request->email,
            "image"=>$imageName,

        ]);
 
        return redirect()->route('users.index'); 
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $this->authorize("manageUser",User::class);
        $image_path=public_path("/images/users/".$user->image);
             if(file_exists($image_path))
              {
               unlink($image_path);
              }
        $user->delete();
        return redirect()->route('users.index');
    }
}
