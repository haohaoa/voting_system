@extends('app')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bỏ Phiếu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/web3@latest/dist/web3.min.js"></script>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(to bottom, #e6f2ff, #ffffff);
        }

        .headerr {
            background: linear-gradient(to right, #1e3a8a, #2563eb);
            color: white;
            padding: 3rem 0;
            border-radius: 0 0 2rem 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: background 0.3s ease;
        }

        .headerr:hover {
            background: linear-gradient(to right, #1e40af, #3b82f6);
        }

        .headerr h1 {
            font-size: 2.5rem;
            font-weight: bold;
        }

        .container {
            padding-top: 3rem;
        }

        .section-title {
            color: #1e3a8a;
            font-weight: bold;
            margin-bottom: 2rem;
            transition: color 0.3s ease;
        }

        .section-title:hover {
            color: #3b82f6;
        }

        .vote-card {
            background: white;
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease, background-color 0.3s ease;
        }

        .vote-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
            background-color: #f0f9ff;
        }

        .vote-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .vote-card:hover img {
            transform: scale(1.05);
        }

        .vote-card .card-body {
            padding: 1.5rem;
        }

        .vote-card h3 {
            color: #1e3a8a;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        .vote-card:hover h3 {
            color: #3b82f6;
        }

        .btn-vote {
            background-color: #2563eb;
            color: white;
            border: none;
            border-radius: 2rem;
            padding: 0.5rem 1.5rem;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn-vote:hover {
            background-color: #1e40af;
            transform: scale(1.05);
        }

        .previous-winner {
            background: white;
            border-radius: 1rem;
            padding: 1.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .previous-winner:hover {
            background-color: #f0f9ff;
            transform: translateY(-5px);
        }

        .president-card {
            background: white;
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out, background-color 0.3s ease;
        }

        .president-card.show {
            opacity: 1;
            transform: translateY(0);
        }

        .president-card:hover {
            background-color: #f0f9ff;
        }

        .president-card img {
            width: 100%;
            height: 300px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .president-card:hover img {
            transform: scale(1.05);
        }

        .president-info {
            padding: 1.5rem;
        }

        .president-info h4 {
            transition: color 0.3s ease;
        }

        .president-card:hover .president-info h4 {
            color: #3b82f6;
        }

        .footer {
            background: #1e3a8a;
            color: white;
            padding: 2rem 0;
            margin-top: 3rem;
            border-radius: 2rem 2rem 0 0;
            transition: background-color 0.3s ease;
        }

        .footer:hover {
            background-color: #2563eb;
        }

        .animate-on-scroll {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }

        .animate-on-scroll.show {
            opacity: 1;
            transform: translateY(0);
        }

        .vote-card {
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .vote-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .results-column {
            margin-top: 10px;
            background-color: #f8f9fa;
            padding: 10px;
            border-radius: 5px;
        }

        .result-bar {
            height: 10px;
            background-color: #007bff;
            border-radius: 5px;
            margin-bottom: 5px;
        }

        .animate-on-scroll {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.5s ease-in-out, transform 0.5s ease-in-out;
        }

        .animate-on-scroll.show {
            opacity: 1;
            transform: translateY(0);
        }

        /* Phần overlay che phủ toàn bộ màn hình */
        #success-message {
            display: none;
            /* Ẩn mặc định, sẽ hiển thị khi cần */
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            /* Màu nền mờ */
            justify-content: center;
            align-items: center;
            z-index: 1000;
            /* Đảm bảo overlay đè lên tất cả các phần tử khác */
        }

        /* Phần thông báo thành công */
        .message-box {
            background-color: white;
            padding: 30px;
            text-align: center;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 300px;
            /* Chiều rộng của hộp thông báo */
        }

        .message-box h3 {
            margin-bottom: 20px;
            color: #333;
            /* Màu chữ cho tiêu đề */
        }

        button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        button:hover {
            background-color: #45a049;
            /* Thay đổi màu khi di chuột qua */
        }

        /* Style cho các thẻ card */
        .vote-card {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            /* Thêm box-shadow và transform */
        }

        .vote-card:hover {
            transform: translateY(-8px);
            /* Di chuyển lên một chút */
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
            /* Tăng độ mờ của bóng khi hover */
        }

        /* Style cho hình ảnh */
        .vote-card img {
            width: 100%;
            height: auto;
            border-bottom: 2px solid #f0f0f0;
            transition: transform 0.3s ease-in-out;
            /* Thêm hiệu ứng cho hình ảnh */
        }

        .vote-card:hover img {
            transform: scale(1.05);
            /* Phóng to hình ảnh một chút khi hover */
        }

        /* Style cho nội dung trong card */
        .card-body {
            padding: 20px;
        }

        .card-body h3 {
            font-size: 18px;
            font-weight: bold;
            color: #333;
            margin-bottom: 15px;
        }

        .card-body p {
            font-size: 14px;
            color: #666;
            line-height: 1.5;
            margin-bottom: 20px;
        }

        /* Style cho button Bỏ Phiếu */
        .vote-btn {
            background-color: #28a745;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            text-transform: uppercase;
            transition: background-color 0.3s ease, transform 0.3s ease;
            /* Thêm transform cho nút */
        }

        .vote-btn:hover {
            background-color: #218838;
            /* Màu khi hover */
            transform: scale(1.1);
            /* Phóng to nút khi hover */
        }

        .vote-btn:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }

        /* Style cho phần kết thúc bỏ phiếu */
        .text-danger {
            color: #dc3545;
            font-weight: bold;
        }

        /* Style cho thông báo còn lại thời gian */
        p {
            font-size: 14px;
            color: #999;
        }

        /* Style cho thanh tiến độ kết quả */
        .results-column {
            margin-top: 15px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .result-bar {
            width: 100%;
            height: 10px;
            background-color: #4caf50;
            /* Màu xanh cho thanh tiến độ */
            border-radius: 5px;
            margin-bottom: 5px;
        }

        .result-text {
            font-size: 12px;
            color: #333;
        }

        /* Style cho col-md-4 */
        .col-md-4 {
            margin-bottom: 20px;
        }

        .animate-on-scroll {
            opacity: 0;
            transform: translateY(50px);
            transition: opacity 0.3s ease-out, transform 0.5s ease-out;
        }

        .animate-on-scroll.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Style cho phần hiển thị kết quả */
        .results-column {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
            /* Đảm bảo nó chiếm hết chiều rộng của thẻ card */
            margin-top: 15px;
        }

        /* Style cho thanh tiến độ */
        .result-bar {
            width: 100%;
            /* Đảm bảo thanh tiến độ chiếm hết chiều rộng */
            height: 10px;
            background-color: #e0e0e0;
            /* Màu nền thanh tiến độ */
            border-radius: 5px;
            position: relative;
            margin-bottom: 5px;
        }

        /* Thay đổi chiều rộng của thanh tiến độ dựa vào vote_count */
        .result-bar .progress-fill {
            height: 100%;
            background-color: #4caf50;
            /* Màu xanh cho thanh tiến độ */
            border-radius: 5px;
            transition: width 0.3s ease;
            /* Tạo hiệu ứng mượt mà khi thay đổi chiều rộng */
        }

        /* Hiển thị số người bầu cử từ trái qua phải */
        .result-text {
            font-size: 14px;
            color: #333;
            display: flex;
            justify-content: space-between;
            width: 100%;
            /* Đảm bảo số người bầu cử chiếm hết chiều rộng */
            font-weight: bold;
            margin-top: 5px;
        }

        /* Style cho phần trăm tiến độ */
        .result-text span {
            color: #4caf50;
            font-weight: bold;
        }
    </style>
</head>
@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<body>
    <div id="success-message" class="overlay">
        <div class="message-box">
            <h3>Bỏ phiếu thành công!</h3>
            <h2>Và bạn chỉ có thể bỏ phiếu cho một người</h2>
            <button onclick="closeVote()">OK</button>
        </div>
    </div>
    <header class="headerr text-center animate-on-scroll">
        <h1 class="mb-3">Bỏ Phiếu Bầu Cử</h1>
        <p class="lead">Chọn người đại diện cho chúng ta trong kỳ bầu cử này</p>
    </header>
    <div class="container">
        <section class="mb-5">
            <h2 class="section-title text-center animate-on-scroll">Thông tin người bầu cử</h2>
            <div class="row g-4">
                @if ($candidates->isNotEmpty())
                    @foreach ($candidates as $candidate)
                        <div class="col-md-4 animate-on-scroll">
                            <div class="vote-card">
                                <img src="https://img.pikbest.com/wp/202345/cat-dog-pet-and-pets-in-real-pictures-wallpapers_9596134.jpg!w700wp" alt="Người bầu cử 1">
                                <div class="card-body">
                                    <h3>{{ $candidate->name }}</h3>
                                    <p>{{ $candidate->program }}</p>
                                    <button class="btn btn-vote w-100 vote-btn" data-candidate-id="{{ $candidate->id }}" data-candidate-name="{{ $candidate->name }}"
                                        data-candidate-program="{{ $candidate->program }}" data-vote-count="{{ $candidate->vote_count }}" @if (now()->gt(\Carbon\Carbon::parse($candidate->end_time))) disabled @endif>
                                        Bỏ Phiếu
                                    </button>
                                    @if (now()->gt(\Carbon\Carbon::parse($candidate->end_time)))
                                        <p class="text-danger">Bỏ phiếu đã kết thúc vào {{ \Carbon\Carbon::parse($candidate->end_time)->format('d-m-Y H:i') }}</p>
                                    @else
                                        <p>Remaining {{ \Carbon\Carbon::parse($candidate->end_time)->diffForHumans() }} to vote.</p>
                                    @endif
                                    <input type="hidden" id="authName" value="{{ Auth::user()->name }}">
                                    <input type="hidden" id="authEmail" value="{{ Auth::user()->email }}">
                                    <div class="results-column">
                                        <div class="result-bar">
                                            <div class="progress-fill" style="width: {{ $candidate->vote_count }}%"></div>
                                        </div>
                                        <p class="result-text">
                                            <span>{{ $candidate->vote_count }} người</span>
                                            <span>{{ $candidate->vote_count }}%</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p>Không có ứng viên nào.</p>
                @endif
            </div>
        </section>

        <section class="mb-5">
            <h2 class="section-title text-center animate-on-scroll">Người Trúng Cử Các Năm Trước</h2>
            <div class="row g-4">
                <div class="col-md-6 animate-on-scroll">
                    <div class="previous-winner">
                        <h3>2022</h3>
                        <p>Người trúng cử: Người Bầu Cử 3</p>
                    </div>
                </div>
                <div class="col-md-6 animate-on-scroll">
                    <div class="previous-winner">
                        <h3>2018</h3>
                        <p>Người trúng cử: Người Bầu Cử 1</p>
                    </div>
                </div>
                <div class="col-md-6 animate-on-scroll">
                    <div class="previous-winner">
                        <h3>2014</h3>
                        <p>Người trúng cử: Người Bầu Cử 2</p>
                    </div>
                </div>
                <div class="col-md-6 animate-on-scroll">
                    <div class="previous-winner">
                        <h3>2010</h3>
                        <p>Người trúng cử: Người Bầu Cử 4</p>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <h2 class="section-title text-center animate-on-scroll">Tổng Thống Mỹ Trúng Cử</h2>
            <div class="president-card animate-on-scroll">
                <div class="row g-0">
                    <div class="col-md-6">
                        <img src="https://img.pikbest.com/wp/202345/cat-dog-pet-and-pets-in-real-pictures-wallpapers_9596134.jpg!w700wp" alt="Joe Biden">
                    </div>
                    <div class="col-md-6">
                        <div class="president-info">
                            <h4>Joe Biden</h4>
                            <p>Được bầu cử năm 2020.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="president-card animate-on-scroll">
                <div class="row g-0">
                    <div class="col-md-6 order-md-2">
                        <img src="https://img.pikbest.com/wp/202345/cat-dog-pet-and-pets-in-real-pictures-wallpapers_9596134.jpg!w700wp" alt="Donald Trump">
                    </div>
                    <div class="col-md-6 order-md-1">
                        <div class="president-info">
                            <h4>Donald Trump</h4>
                            <p>Được bầu cử năm 2016.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="president-card animate-on-scroll">
                <div class="row g-0">
                    <div class="col-md-6">
                        <img src="https://img.pikbest.com/wp/202345/cat-dog-pet-and-pets-in-real-pictures-wallpapers_9596134.jpg!w700wp" alt="Barack Obama">
                    </div>
                    <div class="col-md-6">
                        <div class="president-info">
                            <h4>Barack Obama</h4>
                            <p>Được bầu cử năm 2008 và 2012.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <footer class="footer text-center animate-on-scroll">
        <p>&copy; 2024 Bỏ Phiếu - Tất cả các quyền được bảo lưu.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const animatedElements = document.querySelectorAll(".animate-on-scroll");
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add("show");
                    }
                });
            }, {
                threshold: 0.1
            });

            animatedElements.forEach(element => observer.observe(element));
        });

        // Kết nối Web3
        const web3 = new Web3("http://localhost:7545");

        // ABI và Contract Address
        const contractABI = [{
                "inputs": [{
                        "internalType": "string",
                        "name": "_voterName",
                        "type": "string"
                    },
                    {
                        "internalType": "string",
                        "name": "_candidateName",
                        "type": "string"
                    },
                    {
                        "internalType": "string",
                        "name": "_voterEmail",
                        "type": "string"
                    },
                    {
                        "internalType": "uint256",
                        "name": "_candidateId",
                        "type": "uint256"
                    }
                ],
                "name": "addVote",
                "outputs": [],
                "stateMutability": "nonpayable",
                "type": "function"
            },
            {
                "anonymous": false,
                "inputs": [{
                        "indexed": false,
                        "internalType": "string",
                        "name": "voterName",
                        "type": "string"
                    },
                    {
                        "indexed": false,
                        "internalType": "string",
                        "name": "candidateName",
                        "type": "string"
                    },
                    {
                        "indexed": false,
                        "internalType": "string",
                        "name": "voterEmail",
                        "type": "string"
                    },
                    {
                        "indexed": false,
                        "internalType": "uint256",
                        "name": "candidateId",
                        "type": "uint256"
                    },
                    {
                        "indexed": false,
                        "internalType": "uint256",
                        "name": "timestamp",
                        "type": "uint256"
                    }
                ],
                "name": "VoteAdded",
                "type": "event"
            },
            {
                "inputs": [],
                "name": "getTotalVotes",
                "outputs": [{
                    "internalType": "uint256",
                    "name": "",
                    "type": "uint256"
                }],
                "stateMutability": "view",
                "type": "function"
            },
            {
                "inputs": [{
                    "internalType": "uint256",
                    "name": "index",
                    "type": "uint256"
                }],
                "name": "getVote",
                "outputs": [{
                        "internalType": "string",
                        "name": "",
                        "type": "string"
                    },
                    {
                        "internalType": "string",
                        "name": "",
                        "type": "string"
                    },
                    {
                        "internalType": "string",
                        "name": "",
                        "type": "string"
                    },
                    {
                        "internalType": "uint256",
                        "name": "",
                        "type": "uint256"
                    },
                    {
                        "internalType": "uint256",
                        "name": "",
                        "type": "uint256"
                    }
                ],
                "stateMutability": "view",
                "type": "function"
            },
            {
                "inputs": [{
                    "internalType": "uint256",
                    "name": "",
                    "type": "uint256"
                }],
                "name": "votes",
                "outputs": [{
                        "internalType": "string",
                        "name": "voterName",
                        "type": "string"
                    },
                    {
                        "internalType": "string",
                        "name": "candidateName",
                        "type": "string"
                    },
                    {
                        "internalType": "string",
                        "name": "voterEmail",
                        "type": "string"
                    },
                    {
                        "internalType": "uint256",
                        "name": "candidateId",
                        "type": "uint256"
                    },
                    {
                        "internalType": "uint256",
                        "name": "timestamp",
                        "type": "uint256"
                    }
                ],
                "stateMutability": "view",
                "type": "function"
            }
        ];

        const contractAddress = "0x2F8895b08D8F226b19895d46154faB7096fB2593";

        const contract = new web3.eth.Contract(contractABI, contractAddress);

        document.addEventListener('DOMContentLoaded', function() {
            const voteButtons = document.querySelectorAll('.vote-btn');

            voteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Kiểm tra xem đã có thông tin bỏ phiếu trong localStorage chưa
                    const voteInfo = localStorage.getItem('voteInfo');
                    if (voteInfo) {
                        // Lấy thông tin bỏ phiếu từ localStorage
                        const storedVoteInfo = JSON.parse(voteInfo);

                        // Lấy email người dùng hiện tại
                        const authEmail = document.getElementById('authEmail').value;

                        // So sánh với email đã bỏ phiếu trước đó
                        if (storedVoteInfo.voterEmail === authEmail) {
                            // Nếu email giống nhau, ngừng hành động và thông báo cho người dùng
                            alert("Bạn đã bỏ phiếu rồi. Không thể bầu nữa.");
                            return; // Dừng hành động nếu người dùng đã bỏ phiếu
                        }
                    }

                    // Lấy thông tin từ các thuộc tính data-* của nút bấm
                    const candidateId = this.getAttribute('data-candidate-id');
                    const candidateName = this.getAttribute('data-candidate-name');
                    const candidateProgram = this.getAttribute('data-candidate-program');
                    const voteCount = this.getAttribute('data-vote-count');

                    // Lấy thông tin người dùng từ các input ẩn
                    const name = document.getElementById('authName').value;
                    const voterEmail = document.getElementById('authEmail').value;

                    // Gọi hàm bỏ phiếu
                    document.getElementById('success-message').style.display = 'flex';

                    processVote(name, voterEmail, candidateName, candidateId);

                });
            });
        });

        // Hàm xử lý bỏ phiếu
        async function processVote(name, voterEmail, candidateName, candidateId) {
            try {
                // Lấy tài khoản từ Ganache
                const accounts = await web3.eth.getAccounts();
                const userAccount = accounts[0];

                // Gửi giao dịch đến smart contract
                await contract.methods.addVote(name, candidateName, voterEmail, candidateId).send({
                    from: userAccount
                });
                // Lưu thông tin người bỏ phiếu vào localStorage
                const voteInfo = {
                    name: name,
                    voterEmail: voterEmail,
                    candidateName: candidateName,
                    candidateId: candidateId
                };
                const csrfToken = "{{ csrf_token() }}"; // Lấy CSRF token từ Blade template
                const response = await fetch('{{ route('update') }}', { // Thay 'http://127.0.0.1:8000/update' bằng route Laravel
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json', // Đảm bảo rằng dữ liệu gửi đi có kiểu application/json
                    },
                    body: JSON.stringify({
                        ...voteInfo, // Gửi dữ liệu bỏ phiếu
                        _token: csrfToken, // Gửi CSRF token vào body
                    })
                });


                // Kiểm tra xem request có thành công không
                if (response.ok) {
                    console.log("Dữ liệu đã được gửi thành công lên server.");
                } else {
                    throw new Error("Không thể gửi dữ liệu lên server.");
                    return
                }
                // Lưu thông tin vào localStorage
                localStorage.setItem('voteInfo', JSON.stringify(voteInfo));
            } catch (error) {
                console.error("Lỗi giao dịch:", error);
                alert("Thông báo: Giao dịch thất bại!");
            }
        }

        function closeVote() {
            document.getElementById('success-message').style.display = 'none';
            toggleLoading(true, "Đang tải dữ liệu, vui lòng chờ...");
            location.reload();
        }
    </script>
</body>

</html>
