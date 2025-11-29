<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Diary Website') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Inter', sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f9fafb;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        .btn {
            display: inline-block;
            padding: 12px 24px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }
        .btn-primary {
            background: linear-gradient(135deg, #ec4899 0%, #f472b6 100%);
            color: white;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(236, 72, 153, 0.4);
        }
        .btn-outline {
            background: transparent;
            border: 2px solid #ec4899;
            color: #ec4899;
        }
        .btn-outline:hover {
            background: #ec4899;
            color: white;
        }
        .alert {
            padding: 16px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .alert-success {
            background-color: #d1fae5;
            color: #065f46;
            border: 1px solid #6ee7b7;
        }
        .alert-error {
            background-color: #fee2e2;
            color: #991b1b;
            border: 1px solid #fca5a5;
        }
    </style>
</head>
<body>
    <nav style="background: white; box-shadow: 0 2px 4px rgba(0,0,0,0.1); padding: 16px 0; position: sticky; top: 0; z-index: 100;">
        <div class="container" style="display: flex; justify-content: space-between; align-items: center;">
            <a href="/" style="font-size: 24px; font-weight: 700; color: #ec4899; text-decoration: none;">
                SECRET DIARY
            </a>
            <div style="display: flex; gap: 16px; align-items: center;">
                @auth
                    <a href="/my-stories" class="btn btn-outline" style="text-decoration: none;">My Stories</a>
                    <span style="color: #666;">{{ Auth::user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-outline" style="font-size: 14px; padding: 8px 16px;">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline" style="text-decoration: none;">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-primary" style="text-decoration: none;">Sign Up</a>
                @endauth
            </div>
        </div>
    </nav>

    <main>
        @if(session('success'))
            <div class="container" style="margin-top: 20px;">
                <div class="alert alert-success">{{ session('success') }}</div>
            </div>
        @endif

        @if(session('error'))
            <div class="container" style="margin-top: 20px;">
                <div class="alert alert-error">{{ session('error') }}</div>
            </div>
        @endif

        @if($errors->any())
            <div class="container" style="margin-top: 20px;">
                <div class="alert alert-error">
                    <ul style="list-style: none; padding: 0;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>

