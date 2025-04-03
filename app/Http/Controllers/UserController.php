<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\Courier;
use App\Models\CourierAction;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Models\Status;
use App\Models\LoadManagement;
use App\Models\Rate;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Show form  to create a new user
     * 
     */
    public function index(){
        $role = Auth::user()->role_id;
        $role_data  = Role::find( $role );
        $role_name = Str::lower( $role_data->role_name );

        return view('adduser', compact('role', 'role_name'));
    }


    /**
     * Create a new user
     * 
     */
    public function store( Request $request ){

        $this->validate($request, [
            'role_id' => ['required'],
            'branch_id' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'address' => ['required'],
            'city' => ['required'],
            'province' => ['required'],
            'country' => ['required'],
            'phone' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);


        $User_data = [
            'role_id' =>$request->role_id,
            'branch_id' => $request->branch_id,
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'city' => $request->city,
            'province' => $request->province,
            'country' => $request->country,
            'phone' => $request->phone,
            'password' =>  Hash::make($request->password)
        ];

        $User = User::create( $User_data );
        
        return redirect()->back()->with('status', 'User created successfully!');
    }



}
