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

        return view('users', compact('title', 'users'));
    }

    public function show($id)
    {
        $title = 'User details';

        return view('show', compact('id', 'title'));
    }

    public function new()
    {
        $title = 'New user';

        return view('new', compact('title'));
    }

    public function create()
    {
        $title = 'Create user';
        
        return view('create', compact('title'));
    }
}
