<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use App\Repositories\IRepository\IModelRepository;

class HomeController extends Controller
{

    public function index(){
        return view("home");
    }

    public function signin(){
        return view('signin');
    }

    public function login(){
        return view('login');
    }

    public function home(){
        return view('home');
    }

    public function profile(){
        return view('profile');
    }
    public function exit(){
        return view('exit');
    }

}
