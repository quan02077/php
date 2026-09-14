<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Lab 01')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ddd; padding: 8px; }
        th { background: #f3f4f6; text-align: left; }
        .adult { font-weight: 600; }
        .card { border: 1px solid #e5e7eb; border-radius: 8px; padding: 16px; background: #fff; margin-bottom: 20px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); }
        .card-title { margin-top: 0; margin-bottom: 12px; color: #1f2937; border-bottom: 1px solid #f3f4f6; padding-bottom: 8px; }
    </style>
</head>
<body>
    @include('partials.header')

    <main>
        @yield('content')
    </main>

    <footer>
        <hr>
        <small>&copy; HUIT – Khoa CNTT</small>
    </footer>
</body>
</html>
