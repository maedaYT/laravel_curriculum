<!-- resources/views/mypage.blade.php -->

@extends('layouts.app')

@section('title', 'マイページ')

@section('content')
<main class="container mt-5">
    <div class="text-center mb-4">
        <!-- プロフィール画像とユーザー名 -->
        <div class="mb-3">
            <img 
                src="{{ Auth::user()->image_url ?? '/path/to/default_profile.png' }}" 
                alt="プロフィール画像" 
                class="rounded-circle" 
                style="width: 150px; height: 150px; object-fit: cover;">
        </div>
        <h2>{{ Auth::user()->name }}</h2>
        <a href="{{ route('accounts.edit', ['account' => Auth::id()]) }}" class="btn btn-secondary mt-3">アカウント情報編集</a>
    </div>

    @if (Auth::user()->role == 1) <!-- 一般ユーザー -->
        <div class="text-center mb-4">
            <h1 class="display-5">予約確認</h1>
            <img src="/path/to/travel_illustration.jpg" class="img-fluid" alt="旅行イラスト">
        </div>

        <!-- 予約した旅館情報 -->
        @foreach ($reservations as $reservation)
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">{{ $reservation->title }}</h5>
                    <p class="card-text">チェックイン: {{ $reservation->check_in_date }} ～ チェックアウト: {{ $reservation->check_out_date }}</p>
                    <p class="card-text">予約日: {{ $reservation->created_at->format('Y-m-d') }}</p>
                    <p class="card-text">人数: {{ $reservation->guest_count }}人</p>
                    <p class="card-text">金額: {{ number_format($reservation->price) }}円</p>
                    <div class="text-center">
                        <a href="{{ route('reservations.edit', $reservation->id) }}" class="btn btn-primary me-2">予約変更</a>
                        <a href="{{ route('reservations.destroy', $reservation->id) }}" class="btn btn-danger">キャンセル</a>
                    </div>
                </div>
            </div>
        @endforeach

    @elseif (Auth::user()->role == 2) <!-- 旅館運営ユーザー -->
        <div class="text-center mb-4">
            <h1 class="display-5">新規投稿確認</h1>
            <img src="/path/to/ryokan_illustration.jpg" class="img-fluid" alt="旅館イラスト">
        </div>

        <!-- 投稿した旅館情報 -->
        @foreach ($posts as $post)
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">{{ $post->title }}</h5>
                    <p class="card-text">チェックイン可能日: {{ $post->check_in_date }} ～ チェックアウト可能日: {{ $post->check_out_date }}</p>
                    <p class="card-text">予約可能人数: {{ $post->guest_count }}人</p>
                    <p class="card-text">金額: {{ number_format($post->price) }}円</p>
                    <p class="card-text">内容: {{ $post->comment }}</p>
                    <img src="{{ $post->image_url }}" class="img-fluid" alt="旅館画像">
                    <div class="text-center mt-3">
                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary me-2">投稿編集</a>
                        <a href="{{ route('posts.destroy', $post->id) }}" class="btn btn-danger">削除</a>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</main>
@endsection
