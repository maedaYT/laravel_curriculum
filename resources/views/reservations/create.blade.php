<!-- resources/views/reservations/create.blade.php -->

@extends('layouts.app')

@section('title', '予約情報入力')

@section('content')
<main class="container mt-5">
    <!-- ステップ表示 -->
    <!-- <div class="text-center mb-4">
        <h2>①入力画面　ー　②入力確認</h2>
        <p class="text-muted">現在: <strong>①入力画面</strong></p>
    </div> -->

    <!-- パンくずリスト -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('posts.index') }}">ホーム</a></li>
            <li class="breadcrumb-item"><a href="{{ route('posts.show', $post->id) }}">旅館詳細</a></li>
            <li class="breadcrumb-item active" aria-current="page">予約入力</li>
        </ol>
    </nav>

    <!-- ご予約フォーム -->
    <div class="mb-5">
        <h1 class="display-5">ご予約フォーム</h1>
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

    <!-- 入力フォーム -->
    <form method="POST" action="{{ route('reservations.store') }}">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">ユーザー名</label>
            <input type="text" class="form-control" id="name" value="{{ Auth::user()->name }}" disabled>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">メールアドレス</label>
            <input type="email" class="form-control" id="email" value="{{ Auth::user()->email }}" disabled>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="check_in_date" class="form-label">チェックイン日</label>
                <input type="date" class="form-control" id="check_in_date" name="check_in_date" required>
            </div>
            <div class="col-md-6">
                <label for="check_out_date" class="form-label">チェックアウト日</label>
                <input type="date" class="form-control" id="check_out_date" name="check_out_date" required>
            </div>
        </div>

        <div class="mb-3">
            <label for="guest_count" class="form-label">宿泊人数</label>
            <input type="number" class="form-control" id="guest_count" name="guest_count" required>
        </div>
        <input type="hidden" name="post_id" value="{{ $post->id }}">
        <!-- ボタン -->
        <div class="text-center mt-4">
            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-secondary me-3">旅館詳細に戻る</a>
            <button type="submit" class="btn btn-primary">予約する</button>
        </div>
    </form>
</main>
@endsection
