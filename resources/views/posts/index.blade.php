<!-- resources/views/main.blade.php -->

@extends('layouts.app')

@section('content')
<header class="bg-dark py-3">
    <div class="container text-center">
        <img src="{{ asset('/storage/inn_logo.jpeg') }}" alt="温泉宿ロゴ" style="height: 50px;">
        <h1 class="text-white">旅館予約システム</h1>
    </div>
</header>

<main class="container mt-5">
    <!-- 検索フォーム -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            検索フォーム
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('posts.index') }}">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="title" class="form-label">タイトル</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="タイトルを入力">
                    </div>
                    <div class="col-md-4">
                        <label for="comment" class="form-label">内容</label>
                        <input type="text" class="form-control" id="comment" name="comment" placeholder="内容を入力">
                    </div>
                    <div class="col-md-4">
                        <label for="address" class="form-label">住所</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="住所を入力">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="check_in_date" class="form-label">チェックイン</label>
                        <input type="date" class="form-control" id="check_in_date" name="check_in_date">
                    </div>
                    <div class="col-md-6">
                        <label for="check_out_date" class="form-label">チェックアウト</label>
                        <input type="date" class="form-control" id="check_out_date" name="check_out_date">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="min_price" class="form-label">最低金額</label>
                        <input type="number" class="form-control" id="min_price" name="min_price" placeholder="最低金額">
                    </div>
                    <div class="col-md-6">
                        <label for="max_price" class="form-label">最高金額</label>
                        <input type="number" class="form-control" id="max_price" name="max_price" placeholder="最高金額">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">検索</button>
            </form>
        </div>
    </div>

    <!-- 投稿一覧 -->
    <div id="posts" class="row">
        <!-- 無限スクロールで投稿を表示 -->
        @foreach ($posts as $post)
        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="{{ $post->image_url }}" class="card-img-top" alt="旅館画像">
                <div class="card-body">
                    <h5 class="card-title">{{ $post->title }}</h5>
                    <p class="card-text">予約可能日: {{ $post->check_in_date }} ~ {{ $post->check_out_date }}</p>
                    <p class="card-text">予約可能人数: {{ $post->guest_count }}人</p>
                    <p class="card-text">{{ $post->comment }}</p>
                    <p class="card-text">金額: {{ $post->price }}円</p>
                    <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary">詳細を見る</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</main>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/infinitescroll/4.0.1/infinite-scroll.pkgd.min.js"></script>
<script>
    $(document).ready(function() {
        // 無限スクロールの実装
        $('#posts').infiniteScroll({
            path: '/posts?page=@{{#}}',
            append: '.col-md-4',
            history: false,
        });
    });
</script>
@endsection
