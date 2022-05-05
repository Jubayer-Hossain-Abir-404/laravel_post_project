<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }
    public function index()
    {
        return view('auth.register');
    }

    // when you submit a form like this you need
    // a object called request
    public function store(Request $request)
    {
        // this can print even any variable
        // dd('abc');
        // dd($request);
        // die dump
        // dd($request->email);
        //validation
        // due to this validation now if
        // anyone tries to register without filling 
        // the fields. this will redirect the page to register

        // dd($request->only('email', 'password'));
        $this->validate($request, [
            // this is helpful when you start to write
            // your own validation rule
            // 'name' => ['required', 'max']
            'name' => 'required|max:255',
            'username' => 'required|max:255',
            // to validate email address
            'email' => 'required|email|max:255',
            // it will look for any other data you submitted 
            // with confirmed name they will make sure the field 
            // match
            'password' => 'required|confirmed',
        ]);
        //store user
        // dd('store');
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            // hash is a facade whihc means it has an
            // underlying implementation
            'password' => Hash::make($request->password),
        ]);
        //sign the user in
        // this is a helper method
        auth()->attempt($request->only('email', 'password'));
        // redirect
        return redirect()->route('dashboard');
        
        
    }
}
