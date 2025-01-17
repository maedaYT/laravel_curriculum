<!-- resources/views/admin/users/index.blade.php -->

@extends('layouts.app')

@section('title', 'ユーザー管理一覧')

@section('content')
<main class="container mt-5">
    <!-- パンくずリスト -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">管理者ホーム</a></li>
            <li class="breadcrumb-item active" aria-current="page">ユーザー管理一覧</li>
        </ol>
    </nav>

    <h1 class="display-6 mb-4">ユーザー管理一覧</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ユーザーID</th>
                <th>ユーザー名</th>
                <th>最終アクセス日時</th>
                <th>最終投稿日時</th>
                <th>表示停止数</th>
                <th>アクション</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->last_access_at }}</td>
                <td>{{ $user->last_post_at }}</td>
                <td>{{ $user->suspended_posts_count }}</td>
                <td>
                    @if($user->is_suspended)
                        <form method="POST" action="{{ route('admin.users.resume', $user->id) }}">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-success">利用再開</button>
                        </form>
                    @else
                        <form method="POST" action="{{ route('admin.users.suspend', $user->id) }}">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-danger">利用停止</button>
                        </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</main>
@endsection