<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = [
            'Josh',
            'Ellie',
            'Tess',
            'Tommy',
            'Bill',
            '<script>alert("Clicker")</script>',
        ];

        $title = 'List of users';

        return view('users', compact('title', 'users'));
    }

    public function show($id)
    {
        return "Details for user: {$id}";
    }

    public function new()
    {
        return 'New user';
    }

    public function create()
    {
        return 'Create user';
    }
}
