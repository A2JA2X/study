<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return 'Users';
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
