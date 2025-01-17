<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    //     $this->middleware('role:0');   // 管理者のみアクセス可能
    // }

    public function dashboard()
    {
        return view('admin.dashboard');   // 管理者用ダッシュボード
    }
}
