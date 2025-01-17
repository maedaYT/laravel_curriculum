<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RyokanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:2');   // 旅館運営者のみアクセス可能
    }

    public function index()
    {
        return view('posts.index');   // 旅館運営者用ダッシュボード
    }
}
