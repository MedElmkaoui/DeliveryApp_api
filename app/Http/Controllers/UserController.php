<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,user',
            'pin' => 'nullable|digits:4', // Ensure PIN is 4 digits if provided
            'enable_pin' => 'required|boolean', // Validate as boolean
            'manager_id' => 'nullable|exists:users,id', // Ensure manager_id exists in users table
        ]);

        // Create the user
        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => $request['password'], // Hash the password
            'role' => $request['role'],
            'pin' => $request['pin'] ?? null, // Set to null if not provided
            'enable_pin' => $request['enable_pin'],
            'manager_id' => $request['manager_id'] ?? null, // Default to null if not provided
        ]);
        dd($request);


        // Redirect to a named route
        return redirect()->route('home')->with('success', 'User created successfully');
    }


}
