<!-- resources/views/reservations/destroy.blade.php -->

@extends('layouts.app')

@section('title', '削除確認画面')

@section('content')
<main class="container mt-5">
    <div class="text-center mb-4">
        <h1 class="display-5">削除確認画面</h1>
    </div>

    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('mypage.index') }}">マイページ</a></li>
            <li class="breadcrumb-item active" aria-current="page">予約キャンセル確認</li>
        </ol>
    </nav>

    @if (Auth::user()->role == 1) <!-- 一般ユーザー -->
    <div class="mb-3">
        <label class="form-label">タイトル</label>
        <p>{{ $reservation->title }}</p>
    </div>

    <div class="mb-3">
        <label class="form-label">内容</label>
        <p>{{ $reservation->comment }}</p>
    </div>

    <div class="mb-3">
        <label class="form-label">金額</label>
        <p>{{ number_format($reservation->price) }}円</p>
    </div>

    <div class="mb-3">
        <label class="form-label">チェックイン日</label>
        <p>{{ $reservation->check_in_date }}</p>
    </div>

    <div class="mb-3">
        <label class="form-label">チェックアウト日</label>
        <p>{{ $reservation->check_out_date }}</p>
    </div>

    <div class="mb-3">
        <label class="form-label">人数</label>
        <p>{{ $reservation->guest_count }}人</p>
    </div>

    <div class="text-center mb-4">
        <p class="text-danger">こちらの予約をキャンセルでよろしいですか？</p>
    </div>

    <div class="text-center">
        <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">予約をキャンセルする</button>
        </form>
    </div>
    @elseif (Auth::user()->role == 2) <!-- 旅館運営ユーザー -->
    <div class="mb-3">
        <label class="form-label">タイトル</label>
        <p>{{ $post->title }}</p>
    </div>

    <div class="mb-3">
        <label class="form-label">チェックイン可能日</label>
        <p>{{ $post->check_in_date }}</p>
    </div>

    <div class="mb-3">
        <label class="form-label">チェックアウト可能日</label>
        <p>{{ $post->check_out_date }}</p>
    </div>

    <div class="mb-3">
        <label class="form-label">予約可能人数</label>
        <p>{{ $post->guest_count }}人</p>
    </div>

    <div class="mb-3">
        <label class="form-label">金額</label>
        <p>{{ number_format($post->price) }}円</p>
    </div>

    <div class="mb-3">
        <label class="form-label">内容</label>
        <p>{{ $post->comment }}</p>
    </div>

    <div class="mb-3">
        <label class="form-label">画像</label>
        <img src="{{ $post->image_url }}" alt="投稿画像" class="img-fluid" style="max-width: 200px;">
    </div>

    <div class="text-center mb-4">
        <p class="text-danger">こちらの投稿を削除でよろしいですか？</p>
    </div>

    <div class="text-center">
        <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">投稿を削除する</button>
        </form>
    </div>
    @endif
</main>
@endsection