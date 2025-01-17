<!-- resources/views/accounts/edit.blade.php -->

@extends('layouts.app')

@section('title', 'アカウント情報編集')

@section('content')
<main class="container mt-5">
    <div class="text-center mb-4">
        <h1 class="display-5">アカウント情報編集</h1>
    </div>

    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('mypage.index') }}">マイページ</a></li>
            <li class="breadcrumb-item active" aria-current="page">アカウント情報編集</li>
        </ol>
    </nav>

    <!-- 氏名編集 -->
    <form method="POST" action="{{ route('accounts.update', ['account' => Auth::id()]) }}" class="mb-3">
        @csrf
        @method('PUT')
        <label for="name" class="form-label">氏名</label>
        <div class="d-flex align-items-center">
            <input type="text" class="form-control me-3" id="name" name="name" value="{{ Auth::user()->name }}">
            <button type="submit" class="btn btn-sm btn-primary">保存</button>
        </div>
    </form>

    <!-- メールアドレス編集 -->
    <form method="POST" action="{{ route('accounts.update', ['account' => Auth::id()]) }}" class="mb-3">
        @csrf
        @method('PUT')
        <label for="email" class="form-label">メールアドレス</label>
        <div class="d-flex align-items-center">
            <input type="email" class="form-control me-3" id="email" name="email" value="{{ Auth::user()->email }}">
            <button type="submit" class="btn btn-sm btn-primary">保存</button>
        </div>
    </form>

    <!-- プロフィール画像編集 -->
    <form method="POST" action="{{ route('accounts.update', ['account' => Auth::id()]) }}" enctype="multipart/form-data" class="mb-3">
        @csrf
        @method('PUT')
        <label for="image" class="form-label">プロフィール画像</label>
        <div class="d-flex align-items-center">
            <img src="{{ Auth::user()->image_url }}" alt="プロフィール画像" class="rounded me-3" style="width: 100px; height: 100px;">
            <input type="file" class="form-control me-3" id="image" name="image">
            <button type="submit" class="btn btn-sm btn-primary">保存</button>
        </div>
    </form>

    <div class="text-center mt-4">
        <a href="{{ route('accounts.delete', ['account' => Auth::id()]) }}" class="btn btn-danger">アカウントを削除する</a>
    </div>
</main>
@endsection
