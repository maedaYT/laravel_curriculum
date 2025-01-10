<!-- resources/views/posts/show.blade.php -->

@extends('layouts.app')

@section('title', $post->title . ' | 投稿詳細')

@section('content')
<main class="container mt-5">
    <!-- トップ画像とサムネイル画像 -->
    <div class="mb-4">
        <img id="mainImage" src="{{ $post->main_image_url }}" class="img-fluid w-100 mb-3" alt="{{ $post->title }}の画像">
        <div class="d-flex justify-content-between">
                <img src="{{ $post->image }}" class="img-thumbnail" style="width: 18%; cursor: pointer;" onclick="changeMainImage('{{ $post->image }}')">
        </div>
    </div>

    <!-- 旅館内容 -->
    <div class="card mb-4">
        <div class="card-body">
            <h3 class="card-title">{{ $post->title }}</h3>
            <p class="card-text">予約可能人数: {{ $post->guest_count }}人</p>
            <p class="card-text">期間: {{ $post->check_in_date }} ～ {{ $post->check_out_date }}</p>
            <p class="card-text">金額: {{ number_format($post->price) }}円</p>
            <p class="card-text">{{ $post->comment }}</p>
        </div>
    </div>

    <!-- アクションボタン -->
    <div class="text-center">
        <a href="{{ route('posts.index') }}" class="btn btn-secondary me-3">ホームに戻る</a>
        <a href="" class="btn btn-danger me-3">違反報告</a>
        <a href="" class="btn btn-primary">予約する</a>
    </div>
</main>

<script>
    function changeMainImage(imageUrl) {
        document.getElementById('mainImage').src = imageUrl;
    }
</script>
@endsection
