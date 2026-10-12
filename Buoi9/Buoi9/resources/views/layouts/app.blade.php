<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>BikeGo</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <!-- ===== HEADER ===== -->
    <div class="text-center py-3 border-bottom">
        <h2>BikeGo</h2>
    </div>

    <!-- ===== NAVIGATION + BANNER ===== -->
    <section class="banner">
        <!-- hiệu ứng vòng nước -->
        <div class="circle"></div>
        <div class="circle"></div>
        <div class="circle"></div>

        <!-- MENU -->
        <nav class="menu">
                <li class="mb-1">
                    <a class="fs-5 text-white text-decoration-none" href="{{ url('/') }}">Home</a>
                </li>
                <li class="mb-1">
                    <a class="fs-5 text-white text-decoration-none" href="{{ route('stations.index') }}">Trạm xe</a>
                </li>
                <li class="mb-1">
                    <a class="fs-5 text-white text-decoration-none" href="{{ route('admin.stations.index') }}">Admin</a>
                </li>
                <li class="mb-1">
                    <a class="fs-5 text-white text-decoration-none" href="#">Đăng nhập</a>
                </li>
                <li class="mb-1">
                    <a class="fs-5 text-white text-decoration-none" href="#">Đăng ký</a>
                </li>
            </ul>
        </nav>

        <!-- ACTION BUTTON -->
        <div class="action-box">
            <a href="#"
               class="action-item p-4 rounded border text-white" style="text-decoration:none"> «« THUÊ XE »» </a>
            <a href="#"
               class="action-item p-4 rounded border text-white" style="text-decoration:none"> «« TRẢ XE »» </a>
        </div>
    </section>

    <!-- ===== MAIN CONTENT ===== -->
    <main class="container mt-4 min-vh-100">
        {{-- THÔNG BÁO --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        {{-- CONTENT --}}
        @yield('content')
    </main>

    <!-- ===== FOOTER ===== -->
    <div class="footer border-top py-3">
        <div class="container">
            <div class="row align-items-center text-center text-md-start">
                <!-- Logo -->
                <div class="col-md-2 mb-2 mb-md-0">
                    <img src="{{ asset('images/logo_thanh_doan.webp') }}" class="img-fluid" style="max-width:80px;">
                </div>
                <!-- Text -->
                <div class="col-md-10">
                    <p class="mb-1">© 2026 - Bản quyền thuộc về thành đoàn tp.HCM</p>
                    <p class="mb-1">Địa chỉ liên hệ: Số 1 Phạm Ngọc Thạch, Quận 1, TP HCM</p>
                    <p class="mb-0">Email: thanhdoan@tphcm.gov.vn</p>
                </div>
            </div>
        </div>
    </div>

    <!-- ==== Bootstrap ==== -->
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
