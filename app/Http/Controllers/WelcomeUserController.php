<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeUserController extends Controller
{

    // __invokeは主に一つのアクションしか持たないコントローラに宣言することでパスの宣言に@actionを記述しなくてもいい
    public function __invoke($name, $nickname = null)
    {
        if ($nickname) {
            return "Hi, {$name}. your nickname is: {$nickname}";
        } else {
            return "Hi, {$name}. nickname is not defined!";
        }
    }
}
