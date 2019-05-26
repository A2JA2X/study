<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        if (request()->has('empty')) {
            $users = [];
        } else {
            $users = ['Josh', 'Ellie', 'Tess', 'Tommy', 'Bill',];
        }

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
