<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập và Đăng ký</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('login_register/login_register.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        .error {
            color: red;
            font-size: 0.9em;
            margin-top: 5px;
        }

        .form-container input.error {
            border-color: red;
        }

        .input-group {
            margin-bottom: 10px;
        }

        .error-message {
            margin-top: 5px;
            color: red;
            font-size: 0.9em;
        }

        .alert {
            padding: 15px;
            margin: 10px;
            border-radius: 5px;
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            transition: opacity 0.5s ease;
        }

        .alert-success {
            background-color: #28a745;
            color: white;
            border: 1px solid #218838;
        }

        .alert-danger {
            background-color: #dc3545;
            color: white;
            border: 1px solid #c82333;
        }

        /* Hiệu ứng mờ khi ẩn */
        .alert.fade-out {
            opacity: 0;
        }

        /* Thêm bóng đổ cho thông báo */
        .alert {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    @if (session('status'))
        <div class="alert alert-success" id="success-message">
            {{ session('status') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger" id="error-message">
            {{ session('error') }}
        </div>
    @endif
    <div class="auth-container">
        <h3>Đăng nhập và Đăng ký</h3>

        <div class="tab-buttons">
            <button type="button" onclick="showForm('login')">Đăng nhập</button>
            <button type="button" onclick="showForm('register')">Đăng ký</button>
        </div>

        <!-- Login Form -->
        <div id="login" class="form-container active">
            @csrf
            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="email" id="email_login" class="form-control" placeholder="Email" required>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" id="password_login" class="form-control" placeholder="Mật khẩu" required>
            </div>
            <button type="submit" id ="loginBTN" class="btn-submit">Đăng nhập</button>
            <a href="#" class="forgot-password">Quên mật khẩu?</a>

            <!-- Google Sign-In Button -->
            <div class="g-signin2" data-onsuccess="onSignIn">
                <span class="google-logo"></span> Đăng nhập với Google
            </div>
        </div>

        <!-- Register Form -->
        <form id="register-form" method="POST" action="{{ route('register') }}">
            @csrf
            <div id="register" class="form-container">
                <div class="input-group">
                    <i class="fas fa-user"></i>
                    <input type="text" name="name" class="form-control" placeholder="Họ và tên">
                </div>
                <div class="input-group">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" class="form-control" placeholder="Email">
                </div>
                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Mật khẩu">
                </div>
                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Xác nhận mật khẩu">
                </div>
                <button type="submit" class="btn-submit">Đăng ký</button>
            </div>
        </form>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('login_register/login_register.js') }}"></script>
    <!-- Thêm jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Thêm jQuery Validation Plugin -->
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>

</body>

</html>
@section('scripts')
    <script>
        // Thông báo thành công tự ẩn sau 3 giây
        setTimeout(function() {
            const successMessage = document.getElementById('success-message');
            if (successMessage) {
                successMessage.classList.add('fade-out');
                setTimeout(function() {
                    successMessage.style.display = 'none';
                }, 500); // Chờ thêm 0.5 giây để hiệu ứng mờ hết
            }
        }, 3000); // 3 giây

        // Thông báo lỗi tự ẩn sau 3 giây
        setTimeout(function() {
            const errorMessage = document.getElementById('error-message');
            if (errorMessage) {
                errorMessage.classList.add('fade-out');
                setTimeout(function() {
                    errorMessage.style.display = 'none';
                }, 500); // Chờ thêm 0.5 giây để hiệu ứng mờ hết
            }
        }, 3000); // 3 giây
    </script>
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
        $(document).ready(function() {
            // Áp dụng validation cho form đăng ký
            $("#register-form").validate({
                rules: {
                    // Quy tắc cho trường họ tên
                    name: {
                        required: true,
                        minlength: 3
                    },
                    // Quy tắc cho trường email
                    email: {
                        required: true,
                        email: true
                    },
                    // Quy tắc cho trường mật khẩu
                    password: {
                        required: true,
                        minlength: 8
                    },
                    // Quy tắc cho trường xác nhận mật khẩu
                    password_confirmation: {
                        required: true,
                        minlength: 8,
                        equalTo: "#password" // Đảm bảo xác nhận mật khẩu khớp với mật khẩu
                    }
                },
                messages: {
                    name: {
                        required: "Vui lòng nhập họ tên",
                        minlength: "Họ tên phải có ít nhất 3 ký tự"
                    },
                    email: {
                        required: "Vui lòng nhập email",
                        email: "Vui lòng nhập địa chỉ email hợp lệ"
                    },
                    password: {
                        required: "Vui lòng nhập mật khẩu",
                        minlength: "Mật khẩu phải có ít nhất 8 ký tự"
                    },
                    password_confirmation: {
                        required: "Vui lòng xác nhận mật khẩu",
                        minlength: "Mật khẩu xác nhận phải có ít nhất 8 ký tự",
                        equalTo: "Mật khẩu xác nhận không khớp"
                    }
                },
                errorElement: "div", // Hiển thị lỗi dưới dạng div
                errorClass: "error", // Lớp CSS cho lỗi
                errorPlacement: function(error, element) {
                    // Đảm bảo lỗi sẽ chèn ngay dưới trường input
                    error.insertAfter(element);
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
        $(document).ready(function() {
            $('#loginBTN').click(function() {
                toggleLoading(true, "Đang tải dữ liệu, vui lòng chờ...");
                var email = $('#email_login').val();
                var password = $('#password_login').val();
                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                // Kiểm tra dữ liệu (phía client)
                if (email === '' || password === '') {
                    alert('Vui lòng nhập đầy đủ email và mật khẩu!');
                    toggleLoading(false);
                    return;
                }

                $.ajax({
                    url: '{{ route('login') }}', // Đường dẫn tới route login
                    method: 'POST',
                    data: {
                        email: email,
                        password: password,
                        _token: csrfToken
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            window.location.href = '{{ route('home') }}';
                        } else {
                            alert('Lỗi: ' + response.message); // Xử lý trường hợp API lỗi
                        }
                    },
                    error: function(xhr) {
                        // Xử lý các lỗi trả về từ server
                        if (xhr.status === 401) {
                            alert('Đăng nhập thất bại: ' + xhr.responseJSON.message);
                            toggleLoading(false);
                        } else if (xhr.status === 422) {
                            alert('Dữ liệu không hợp lệ!');
                            toggleLoading(false);
                        } else {
                            alert('Có lỗi xảy ra, vui lòng thử lại sau!');
                            toggleLoading(false);

                        }
                        console.error(xhr);
                    }
                });
            });
        });

       
    </script>
