<!-- resources/views/posts/create.blade.php -->

@extends('layouts.app')

@section('title', '新規投稿登録')

@section('content')
<main class="container mt-5">
    <div class="text-center mb-4">
        <h1 class="display-4">新規投稿登録</h1>
    </div>

    <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">タイトル</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="check_in_date" class="form-label">チェックイン</label>
                <input type="date" class="form-control" id="check_in_date" name="check_in_date" required>
            </div>
            <div class="col-md-6">
                <label for="check_out_date" class="form-label">チェックアウト</label>
                <input type="date" class="form-control" id="check_out_date" name="check_out_date" required>
            </div>
        </div>

        <div class="mb-3">
            <label for="guest_count" class="form-label">予約可能人数</label>
            <input type="number" class="form-control" id="guest_count" name="guest_count" required>
        </div>

        <div class="mb-3">
            <label for="comment" class="form-label">内容</label>
            <textarea class="form-control" id="comment" name="comment" rows="5" required></textarea>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">画像</label>
            <input class="form-control" type="file" id="image" name="image" accept="image/*" required>
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('mypage') }}" class="btn btn-secondary me-3">マイページに戻る</a>
            <button type="submit" class="btn btn-primary">登録内容確認</button>
        </div>
    </form>
</main>
@endsection
