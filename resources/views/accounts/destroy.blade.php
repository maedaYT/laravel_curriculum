<!-- resources/views/accounts/delete.blade.php -->

@extends('layouts.app')

@section('title', 'アカウント削除確認')

@section('content')
<main class="container mt-5">
    <div class="text-center mb-4">
        <h1 class="display-5">アカウント削除確認</h1>
    </div>

    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('mypage.index') }}">マイページ</a></li>
            <li class="breadcrumb-item active" aria-current="page">アカウント削除確認</li>
        </ol>
    </nav>

    <div class="mb-3">
        <label for="name" class="form-label">氏名</label>
        <p>{{ Auth::user()->name }}</p>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">メールアドレス</label>
        <p>{{ Auth::user()->email }}</p>
    </div>

    <div class="mb-3">
        <label for="image" class="form-label">プロフィール画像</label>
        <img src="{{ Auth::user()->image_url }}" alt="プロフィール画像" class="rounded" style="width: 100px; height: 100px;">
    </div>

    <div class="text-center mb-4">
        <p class="text-danger">本当にアカウントを削除しても良いですか？</p>
    </div>

    <div class="text-center mt-4">
        <a href="{{ route('accounts.edit', ['account' => Auth::id()]) }}" class="btn btn-secondary me-3">編集画面に戻る</a>
        <form action="{{ route('accounts.destroy', ['account' => Auth::id()]) }}" method="POST" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">削除する</button>
        </form>
    </div>
</main>
@endsection