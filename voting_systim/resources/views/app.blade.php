<!-- resources/views/layouts/app.blade.php -->

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Trang Chủ')</title>
    <link rel="stylesheet" href="{{ asset('styles.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    
    <!-- Include header cho tất cả các trang sử dụng layout này -->
    @include('header')

    <!-- Nội dung trang con -->
    <div class="content">
        @yield('content')
    </div>

</body>
</html>
<script>
    function toggleLoading(show = true, message = "Vui lòng đợi...") {
    // Kiểm tra xem spinner đã tồn tại chưa
    let spinner = document.getElementById('custom-loading-spinner');

    if (!spinner) {
        // Tạo spinner nếu chưa có
        spinner = document.createElement('div');
        spinner.id = 'custom-loading-spinner';
        spinner.style.position = 'fixed';
        spinner.style.top = '0';
        spinner.style.left = '0';
        spinner.style.width = '100%';
        spinner.style.height = '100%';
        spinner.style.backgroundColor = 'rgba(255, 255, 255, 0.8)';
        spinner.style.display = 'flex';
        spinner.style.flexDirection = 'column';
        spinner.style.justifyContent = 'center';
        spinner.style.alignItems = 'center';
        spinner.style.zIndex = '9999';

        // Tạo phần spinner và thông báo
        spinner.innerHTML = `
            <div style="
                width: 50px;
                height: 50px;
                border: 5px solid #f3f3f3;
                border-top: 5px solid #3498db;
                border-radius: 50%;
                animation: spin 1s linear infinite;
            "></div>
            <p id="custom-loading-message" style="
                margin-top: 10px;
                font-size: 16px;
                color: #333;
                text-align: center;
            ">${message}</p>
            <style>
                @keyframes spin {
                    0% { transform: rotate(0deg); }
                    100% { transform: rotate(360deg); }
                }
            </style>
        `;

        // Thêm spinner vào body
        document.body.appendChild(spinner);
    }

    // Cập nhật thông báo và hiển thị hoặc ẩn spinner
    document.getElementById('custom-loading-message').innerText = message;
    spinner.style.display = show ? 'flex' : 'none';
}

</script>