<!-- resources/views/admin/posts/index.blade.php -->

@extends('layouts.app')

@section('title', '投稿管理一覧')

@section('content')
<main class="container mt-5">
    <!-- パンくずリスト -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">管理者ホーム</a></li>
            <li class="breadcrumb-item active" aria-current="page">投稿管理一覧</li>
        </ol>
    </nav>

    <h1 class="display-6 mb-4">投稿管理一覧</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>投稿ID</th>
                <th>ユーザー名</th>
                <th>タイトル</th>
                <th>投稿日時</th>
                <th>違反報告数</th>
                <th>アクション</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
            <tr>
                <td>{{ $post->id }}</td>
                <td>{{ $post->user->name }}</td>
                <td>{{ $post->title }}</td>
                <td>{{ $post->created_at }}</td>
                <td>{{ $post->reports_count }}</td>
                <td>
                    @if($post->is_suspended)
                        <form method="POST" action="{{ route('admin.posts.resume', $post->id) }}">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-success">表示再開</button>
                        </form>
                    @else
                        <form method="POST" action="{{ route('admin.posts.suspend', $post->id) }}">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-danger">表示停止</button>
                        </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</main>
@endsection
