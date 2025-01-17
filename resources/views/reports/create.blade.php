<!-- resources/views/reports/create.blade.php -->

@extends('layouts.app')

@section('title', '違反報告')

@section('content')
<main class="container mt-5">
    <!-- パンくずリスト -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('posts.index') }}">ホーム</a></li>
            <li class="breadcrumb-item"><a href="{{ route('posts.show', $post->id) }}">投稿詳細</a></li>
            <li class="breadcrumb-item active" aria-current="page">違反報告</li>
        </ol>
    </nav>

    <!-- 見出し -->
    <div class="text-center mb-4">
        <h1 class="display-5">違反報告</h1>
    </div>

    <!-- フォーム -->
    <form method="POST" action="{{ route('reports.store') }}">
        @csrf
        <input type="hidden" name="post_id" value="{{ $post->id }}">

        <div class="mb-3">
            <label for="reason" class="form-label">違反理由 <span class="text-danger">必須</span></label>
            <textarea class="form-control" id="reason" name="reason" rows="5" required></textarea>
        </div>

        <!-- ボタン -->
        <div class="text-center mt-4">
            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-secondary me-3">詳細に戻る</a>
            <button type="submit" class="btn btn-danger">違反報告を送信</button>
        </div>
    </form>
</main>
@endsection
