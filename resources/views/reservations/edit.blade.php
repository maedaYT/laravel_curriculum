<!-- resources/views/reservations/edit.blade.php -->

@extends('layouts.app')

@section('title', '編集画面')

@section('content')
<main class="container mt-5">
    <div class="text-center mb-4">
        <h1 class="display-5">編集画面</h1>
    </div>

    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('mypage.index') }}">マイページ</a></li>
            <li class="breadcrumb-item active" aria-current="page">予約情報編集</li>
        </ol>
    </nav>

    @if (Auth::user()->role == 1) <!-- 一般ユーザー -->
    <form method="POST" action="{{ route('reservations.update', $reservation->id) }}">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label for="title" class="form-label">タイトル</label>
            <input type="text" class="form-control" id="title" value="{{ $reservation->title }}" disabled>
        </div>

        <div class="mb-3">
            <label for="comment" class="form-label">内容</label>
            <textarea class="form-control" id="comment" rows="3" disabled>{{ $reservation->comment }}</textarea>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">金額</label>
            <input type="text" class="form-control" id="price" value="{{ number_format($reservation->price) }}円" disabled>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="check_in_date" class="form-label">チェックイン日</label>
                <input type="date" class="form-control" id="check_in_date" name="check_in_date" value="{{ $reservation->check_in_date }}">
            </div>
            <div class="col-md-6">
                <label for="check_out_date" class="form-label">チェックアウト日</label>
                <input type="date" class="form-control" id="check_out_date" name="check_out_date" value="{{ $reservation->check_out_date }}">
            </div>
        </div>

        <div class="mb-3">
            <label for="guest_count" class="form-label">人数</label>
            <input type="number" class="form-control" id="guest_count" name="guest_count" value="{{ $reservation->guest_count }}">
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">この内容で修正する</button>
        </div>
    </form>
    @elseif (Auth::user()->role == 2) <!-- 旅館運営ユーザー -->
    <form method="POST" action="{{ route('posts.update', $post->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">タイトル</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}">
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="check_in_date" class="form-label">チェックイン可能日</label>
                <input type="date" class="form-control" id="check_in_date" name="check_in_date" value="{{ $post->check_in_date }}">
            </div>
            <div class="col-md-6">
                <label for="check_out_date" class="form-label">チェックアウト可能日</label>
                <input type="date" class="form-control" id="check_out_date" name="check_out_date" value="{{ $post->check_out_date }}">
            </div>
        </div>

        <div class="mb-3">
            <label for="guest_count" class="form-label">予約可能人数</label>
            <input type="number" class="form-control" id="guest_count" name="guest_count" value="{{ $post->guest_count }}">
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">金額</label>
            <input type="text" class="form-control" id="price" name="price" value="{{ $post->price }}">
        </div>

        <div class="mb-3">
            <label for="comment" class="form-label">内容</label>
            <textarea class="form-control" id="comment" name="comment" rows="5">{{ $post->comment }}</textarea>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">画像</label>
            <input type="file" class="form-control" id="image" name="image">
            <img src="{{ $post->image_url }}" alt="現在の画像" class="img-fluid mt-2" style="max-width: 200px;">
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">この内容で修正する</button>
        </div>
    </form>
    @endif
</main>
@endsection