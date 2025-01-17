<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:1');   // 一般ユーザーのみアクセス可能
    }

    public function index()
    {
        return view('posts.index');   // 一般ユーザー用ホームページ
    }
}
