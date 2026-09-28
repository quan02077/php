<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Articles')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: system-ui, -apple-system, Segoe UI, Roboto, Arial,
                sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 960px;
            margin: 24px auto;
        }

        nav {
            background-color: #111827; 
            padding: 14px 16px;
            margin-bottom: 24px;
        }

        nav a {
            color: #ffffff; 
            text-decoration: none;
            margin-right: 20px;
            font-size: 15px;
        }

        nav a:hover {
            text-decoration: underline;
        }


        nav a.active {
            text-decoration: underline;
        }

        .flash {
            padding: 10px;
            margin-bottom: 12px;
            background: #ECFDF5;
            color: #065F46;
            border-radius: 8px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #e5e7eb;
            padding: 12px 8px;
            text-align: left;
        }

        th {
            background: #f3f4f6;
            font-weight: bold;
        }
    </style>
    @stack('styles')
</head>

<body>
    <div class="container">
        <nav>
            <a href="{{ route('products.index') }}" class="active">Trang chủ</a>
            <a href="{{ route('products.index') }}">Products</a>
            <a href="{{ route('students.index') }}">Students</a>   
            <a href="{{ route('profiles.index') }}">Profiles</a>   
        </nav>
        @yield('content')
    </div>
    
    @stack('scripts')
</body>

</html>