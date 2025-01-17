<!-- resources/views/admin/dashboard.blade.php -->

@extends('layouts.app')

@section('title', '管理者ページ')

@section('content')
<main class="container mt-5">
    <div class="text-center">
        <h1 class="display-4">管理者ページ</h1>
        
        <div class="mt-5">
            <a href="{{ route('admin.users.index') }}" class="btn btn-primary btn-lg d-block mb-3">ユーザー一覧</a>
            <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary btn-lg d-block">投稿一覧</a>
        </div>
    </div>
</main>
@endsection
