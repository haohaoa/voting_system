<!-- resources/views/layouts/header.blade.php -->
<header class="header">
    <div class="logo">
        <!-- Logo sẽ được lấy từ thư mục public -->
        <img src="https://bedental.vn/wp-content/uploads/2022/11/ho-1024x1024.jpg" alt="Logo" class="logo-img">
        <h1 class="site-name">Voting system</h1>
    </div>
    
    <nav class="nav-menu">
        <ul>
            <!-- Các link sẽ dùng route helper để dễ dàng thay đổi sau này -->
            <li><a href="{{ route('home') }}" class="nav-link">Trang Chủ</a></li>
            <li><a href="{{route('organization')}}" class="nav-link">Tổ Chức</a></li>
        </ul>
    </nav>
    <div class="user-section">

        <!-- Khi người dùng đã đăng nhập -->
        @auth
            <a href="{{route('logout')}}" class="logout-btn" >Đăng Xuất</a>
        @endauth
    </div>
</header>
<script>// JavaScript để thêm class sticky khi cuộn
    // JavaScript để thêm class sticky khi cuộn
window.onscroll = function() { stickyHeader() };

var header = document.querySelector(".header");
var sticky = header.offsetTop;

function stickyHeader() {
    if (window.pageYOffset > sticky) {
        header.classList.add("sticky");
    } else {
        header.classList.remove("sticky");
    }
}

    </script>