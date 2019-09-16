<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use EasyWeChat\Factory;

class AllController extends Controller
{

    public function index()
    {

        return view('home.member.login');
    }



}
