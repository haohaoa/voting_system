@extends('app')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ Thống Bỏ Phiếu - Giao Diện Tổ Chức</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(to right, #f0f8ff, #e6f7ff);
            color: #333;
        }

        .navbar {
            background: linear-gradient(135deg, #0056b3, #00c6ff);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            padding: 40px;
            margin-top: 40px;
            transition: all 0.3s ease;
        }

        .container:hover {
            box-shadow: 0 15px 25px rgba(0, 0, 0, 0.2);
        }

        .candidate-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: none;
            border-radius: 15px;
            overflow: hidden;
            background: linear-gradient(to bottom, #ffffff, #f8f9fa);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .candidate-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
        }

        .nominate-btn {
            width: 100%;
            background-color: #ff6b35;
            border: none;
            transition: all 0.3s ease;
        }

        .nominate-btn:hover {
            background-color: #ff8c5a;
            transform: scale(1.05);
        }

        .list-group {
            max-height: 200px;
            overflow-y: auto;
            border-radius: 10px;
        }

        .list-group-item {
            border: none;
            border-bottom: 1px solid #ddd;
            transition: background-color 0.3s ease;
        }

        .list-group-item:last-child {
            border-bottom: none;
        }

        .list-group-item:hover {
            background-color: #f1faff;
            font-weight: 500;
        }

        .btn-danger,
        .btn-success {
            transition: all 0.3s ease;
        }

        .btn-danger:hover,
        .btn-success:hover {
            transform: scale(1.1);
        }

        h1,
        h2 {
            text-align: center;
            font-weight: bold;
            background: -webkit-linear-gradient(45deg, #0056b3, #00c6ff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .voting-info {
            background-color: #f8f9fa;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .voting-info h2 {
            margin-bottom: 20px;
        }

        .voting-info .form-control {
            border-radius: 10px;
        }

        .voting-info .btn-primary {
            width: 100%;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .voting-info .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        #success-message {
    transition: opacity 0.5s ease-in-out;
    opacity: 1;
}

#success-message.hidden {
    opacity: 0;
    display: none;
}


    </style>
</head>
<div id="success-message" style="display: none; position: fixed; bottom: 20px; right: 20px; background-color: green; color: white; padding: 10px 20px; border-radius: 5px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); font-size: 16px;">
    Cập nhật thành công!
</div>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><i class="fas fa-vote-yea me-2"></i>Hệ Thống Bỏ Phiếu</a>
        </div>
    </nav>

    <div class="container mt-4">
        <h1 class="text-center mb-4">Giao Diện Tổ Chức</h1>

        <div class="row mt-3">
            <div class="col-12 text-center">
                <button class="btn btn-outline-primary btn-lg" id="addCandidateBtn">
                    <i class="fas fa-user-plus me-2"></i>Thêm Người Ứng Cử
                </button>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-8">
                <h2><i class="fas fa-users me-2"></i>Danh Sách Ứng Cử Viên</h2>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <div class="card candidate-card">
                            <img src="https://img.pikbest.com/wp/202345/cat-dog-pet-and-pets-in-real-pictures-wallpapers_9596134.jpg!w700wp" class="card-img-top" alt="Ứng cử viên 1">
                            <div class="card-body">
                                <h5 class="card-title">Nguyễn Văn A</h5>
                                <p class="card-text">Chuyên gia kinh tế với 15 năm kinh nghiệm</p>
                                <button class="btn btn-primary nominate-btn"><i class="fas fa-user-plus me-2"></i>Đề Cử</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card candidate-card">
                            <img src="https://img.pikbest.com/wp/202345/cat-dog-pet-and-pets-in-real-pictures-wallpapers_9596134.jpg!w700wp" class="card-img-top" alt="Ứng cử viên 2">
                            <div class="card-body">
                                <h5 class="card-title">Trần Thị B</h5>
                                <p class="card-text">Nhà hoạt động xã hội và môi trường</p>
                                <button class="btn btn-primary nominate-btn"><i class="fas fa-user-plus me-2"></i>Đề Cử</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card candidate-card">
                            <img src="https://img.pikbest.com/wp/202345/cat-dog-pet-and-pets-in-real-pictures-wallpapers_9596134.jpg!w700wp" class="card-img-top" alt="Ứng cử viên 3">
                            <div class="card-body">
                                <h5 class="card-title">Lê Văn C</h5>
                                <p class="card-text">Kỹ sư công nghệ thông tin tài năng</p>
                                <button class="btn btn-primary nominate-btn"><i class="fas fa-user-plus me-2"></i>Đề Cử</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <h2><i class="fas fa-clipboard-list me-2"></i>Quản Lý Đề Cử</h2>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Danh Sách Đề Cử</h5>
                        <ul class="list-group">
                        </ul>
                        <button class="btn btn-success mt-3 w-100"><i class="fas fa-check-circle me-2"></i>Xác Nhận Danh Sách Đề Cử</button>
                    </div>
                </div>
            </div>

            <div class="voting-info">
                <h2><i class="fas fa-info-circle me-2"></i>Thông Tin Cuộc Bỏ Phiếu</h2>
                <form>
                    <div class="mb-3">
                        <label for="votingTitle" class="form-label">Tiêu đề cuộc bỏ phiếu</label>
                        <input type="text" class="form-control" id="votingTitle" placeholder="Nhập tiêu đề cuộc bỏ phiếu" required>
                    </div>
                    <div class="mb-3">
                        <label for="votingDescription" class="form-label">Mô tả</label>
                        <textarea class="form-control" id="votingDescription" rows="3" placeholder="Nhập mô tả chi tiết về cuộc bỏ phiếu" required></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="startDate" class="form-label">Ngày bắt đầu</label>
                            <input type="date" class="form-control" id="startDate" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="endDate" class="form-label">Ngày kết thúc</label>
                            <input type="date" class="form-control" id="endDate" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Lưu Thông Tin Cuộc Bỏ Phiếu
                    </button>
                </form>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>


</html>
<script>
    $(document).ready(function() {
        const selectedCandidates = new Set();

        // Xử lý các nút đề cử ứng cử viên
        $(".nominate-btn").on("click", function() {
            toggleLoading(true, "Đang tải dữ liệu, vui lòng chờ...");
            const candidateName = $(this).closest(".card").find(".card-title").text();

            if (!selectedCandidates.has(candidateName)) {
                selectedCandidates.add(candidateName);

                const listItem = $(`
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    ${candidateName}
                    <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                </li> `

                );

                listItem.find("button").on("click", function() {
                    selectedCandidates.delete(candidateName);
                    listItem.remove();
                });

                $(".list-group").append(listItem);
                toggleLoading(false);
            }
            toggleLoading(false);
        });

        // Lấy thông tin bỏ phiếu
        $("form").on("submit", function(e) {
            toggleLoading(true, "Đang tải dữ liệu, vui lòng chờ...");
            e.preventDefault();

            const votingTitle = $("#votingTitle").val();
            const votingDescription = $("#votingDescription").val();
            const startDate = $("#startDate").val();
            const endDate = $("#endDate").val();

            const votingInfo = {
                title: votingTitle,
                description: votingDescription,
                start_date: startDate,
                end_date: endDate,
                candidates: Array.from(selectedCandidates) // selectedCandidates là một mảng các ứng viên đã chọn
            };

            console.log("Thông tin cuộc bỏ phiếu:", votingInfo);

            // Gửi thông tin cuộc bỏ phiếu lên server bằng AJAX
            $.ajax({
                url: "{{ route('add_Candidate') }}", // Kiểm tra route trong web.php
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    voting_title: votingTitle,
                    voting_description: votingDescription,
                    start_date: startDate,
                    end_date: endDate,
                    candidates: JSON.stringify(Array.from(selectedCandidates)), // Chuyển mảng thành chuỗi JSON
                },
                success: function(response) {
                    toggleLoading(false);
                    console.log("Dữ liệu đã được gửi thành công:", response);
                    // Hiển thị thông báo thành công
                    var messageElement = document.getElementById('success-message');
                    messageElement.style.display = 'block';

                    // Ẩn thông báo sau 3 giây
                    setTimeout(function() {
                        messageElement.style.display = 'none';
                    }, 3000);
                },
                error: function(xhr, status, error) {
                    console.log("Lỗi khi gửi dữ liệu:", error);
                    toggleLoading(false);
                }
            });

        });

    });
</script>
