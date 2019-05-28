<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        $title = 'List of users';

        return view('users.index', compact('title', 'users'));
    }

    public function show(User $user)
    {
        $title = 'User details';

        return view('users.show', compact('user', 'title'));
    }

    public function new()
    {
        $title = 'New user';

        return view('users.new', compact('title'));
    }

    public function store()
    {
        /** フォームから送信された情報の受け取り */
        $data = request()->validate([
            'name' => 'required'
        ], [
            'name.required' => 'Name is required!'
        ]);

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);

        return redirect()->route('users');
    }
}
