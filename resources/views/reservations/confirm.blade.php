<!-- resources/views/reservations/confirm.blade.php -->

@extends('layouts.app')

@section('title', '予約内容確認')

@section('content')
<main class="container mt-5">
    <!-- ステップ表示 -->
    <div class="text-center mb-4">
        <h2>①入力画面　ー　②入力確認</h2>
        <p class="text-muted">現在: <strong>②入力確認</strong></p>
    </div>

    <!-- パンくずリスト -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('posts.index') }}">ホーム</a></li>
            <li class="breadcrumb-item"><a href="{{ route('posts.show', $post->id) }}">旅館詳細</a></li>
            <li class="breadcrumb-item"><a href="{{ route('reservations.create') }}">予約入力</a></li>
            <li class="breadcrumb-item active" aria-current="page">予約内容確認</li>
        </ol>
    </nav>

    <!-- ご予約内容 -->
    <div class="mb-5">
        <h1 class="display-5">ご予約内容確認</h1>
        <div class="row mt-4">
            <div class="col-md-6">
                <img src="{{ $post->image_url }}" class="img-fluid" alt="{{ $post->title }}の画像">
            </div>
            <div class="col-md-6">
                <h3>{{ $post->title }}</h3>
                <p>{{ $post->comment }}</p>
                <p>金額: {{ number_format($post->price) }}円</p>
            </div>
        </div>
    </div>

    <!-- 確認情報 -->
    <div class="mb-3">
        <label for="name" class="form-label">ユーザー名</label>
        <p>{{ Auth::user()->name }}</p>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">メールアドレス</label>
        <p>{{ Auth::user()->email }}</p>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <label for="check_in_date" class="form-label">チェックイン日</label>
            <p>{{ $reservation['check_in_date'] }}</p>
        </div>
        <div class="col-md-6">
            <label for="check_out_date" class="form-label">チェックアウト日</label>
            <p>{{ $reservation['check_out_date'] }}</p>
        </div>
    </div>

    <div class="mb-3">
        <label for="guest_count" class="form-label">宿泊人数</label>
        <p>{{ $reservation['guest_count'] }}</p>
    </div>

    <!-- ボタン -->
    <div class="text-center mt-4">
        <a href="{{ route('reservations.create') }}" class="btn btn-secondary me-3">入力画面に戻る</a>
        <form method="POST" action="{{ route('reservations.store') }}" class="d-inline">
            @csrf
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <input type="hidden" name="check_in_date" value="{{ $reservation['check_in_date'] }}">
            <input type="hidden" name="check_out_date" value="{{ $reservation['check_out_date'] }}">
            <input type="hidden" name="guest_count" value="{{ $reservation['guest_count'] }}">
            <button type="submit" class="btn btn-primary">こちらの内容で予約する</button>
        </form>
    </div>
</main>
@endsection
