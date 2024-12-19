<!-- resources/views/alert.blade.php -->

@if(session('status'))
    <div class="alert alert-success" id="success-message">
        {{ session('status') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger" id="error-message">
        {{ session('error') }}
    </div>
@endif

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
@endsection

<style>
    /* Định dạng thông báo thành công */
    .alert {
        padding: 15px;
        margin: 10px 0;
        border-radius: 5px;
        transition: opacity 0.5s ease;
        position: relative;
        display: flex;
        align-items: center;
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

    .alert .close {
        position: absolute;
        top: 5px;
        right: 10px;
        cursor: pointer;
        font-size: 18px;
        font-weight: bold;
    }

    /* Thêm hiệu ứng ẩn mượt mà cho thông báo */
    .alert.fade-out {
        opacity: 0;
    }

    /* Thêm một chút hiệu ứng bóng đổ cho thông báo */
    .alert {
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
</style>
