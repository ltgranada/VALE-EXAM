<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $users = [
        [
            "id" => 1,
            "name" => "Alice Johnson",
            "email" => "alice@example.com",
            "role" => "admin"
        ],
        [
            "id" => 2,
            "name" => "Bob Smith",
            "email" => "bob@example.com",
            "role" => "author"
        ],
        [
            "id" => 3,
            "name" => "Carol Williams",
            "email" => "carol@example.com",
            "role" => "editor"
        ],
        // ...
    ];

    public function index()
    {
        // return view('user-list', ['users' => $this->users]);
        $users = User::all(); // Retrieve all users from the database
        return view('user-list', ['users' => $users]);
    }

    public function create()
    {
        return view('user-create');
    }

    public function store(Request $request)
{
    $validatedData = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255=', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
        'role' => ['required', 'in:admin,user'],
    ]);

    $user = User::create([
        'name' => $validatedData['name'],
        'email' => $validatedData['email'],
        'password' => Hash::make($validatedData['password']),
        'role' => $validatedData['role'],
    ]);

    return redirect()->route('users.index')->with('success', 'User created successfully!');
    }

    public function show($id)
    {
        $user = collect($this->users)->firstWhere('id', $id);

        if (!$user) {
            abort(404, 'User not found');
        }

        return view('user-show', ['user' => $user]);
    }

    
}

