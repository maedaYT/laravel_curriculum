<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', '旅館予約システム')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar-brand img {
            height: 50px;
        }
        .profile-image {
            width: 40px;
            height: 40px;
            border-radius: 10%;
        }
    </style>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="/">
                    <img src="/path/to/onsen_logo.jpeg" alt="温泉宿ロゴ">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        @auth
                            @if (Auth::user()->role == 0) <!-- 管理者ユーザー -->
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('mypage.index') }}">
                                        <img src="{{ asset('/storage/icon_user.jpeg') }}" alt="プロフィール画像" class="profile-image">
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">ログアウト</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                                @elseif (Auth::user()->role == 1) <!-- 一般ユーザー -->
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('mypage.index') }}">
                                        <img src="{{ asset('/storage/icon_user.jpeg') }}" alt="プロフィール画像" class="profile-image">
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">ログアウト</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            @elseif (Auth::user()->role == 2) <!-- 旅館運営ユーザー -->
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('posts.create') }}">新規投稿</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('mypage.index') }}">
                                        <img src="{{ asset('/storage/icon_user.jpeg') }}" alt="プロフィール画像" class="profile-image">
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">ログアウト</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">ログイン</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">新規登録</a>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main class="py-4">
        <div class="container">
            @yield('content')
        </div>
    </main>

    <footer class="bg-dark text-white text-center py-3 mt-5">
        <p>&copy; 2025 旅館予約システム</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // メニューを閉じる処理
        document.querySelectorAll('.navbar-nav .nav-link').forEach(link => {
            link.addEventListener('click', () => {
                const navbar = document.querySelector('.navbar-collapse');
                if (navbar.classList.contains('show')) {
                    new bootstrap.Collapse(navbar).hide();
                }
            });
        });
    </script>
</body>
</html>
