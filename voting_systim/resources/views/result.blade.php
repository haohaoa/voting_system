<!DOCTYPE html>
<html>
<head>
<title>Voting Page</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
<style>
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
</style>
</head>
<body>
<div class="container">
    <h1>Voting Page</h1>
    <div class="row g-4">
        <div class="col-md-4 animate-on-scroll">
            <div class="vote-card">
                <img src="https://img.pikbest.com/wp/202345/cat-dog-pet-and-pets-in-real-pictures-wallpapers_9596134.jpg!w700wp" alt="Người bầu cử 1">
                <div class="card-body">
                    <h3>Người Bầu Cử 1</h3>
                    <p>Thông tin chi tiết về người bầu cử 1...</p>
                    <button class="btn btn-vote w-100">Bỏ Phiếu</button>
                    <div class="results-column">
                        <div class="result-bar" style="width: 66.67%;"></div>
                        <p class="result-text">2 người bầu (66.67%)</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 animate-on-scroll">
            <div class="vote-card">
                <img src="https://img.pikbest.com/wp/202345/cat-dog-pet-and-pets-in-real-pictures-wallpapers_9596134.jpg!w700wp" alt="Người bầu cử 2">
                <div class="card-body">
                    <h3>Người Bầu Cử 2</h3>
                    <p>Thông tin chi tiết về người bầu cử 2...</p>
                    <button class="btn btn-vote w-100">Bỏ Phiếu</button>
                    <div class="results-column">
                        <div class="result-bar" style="width: 33.33%;"></div>
                        <p class="result-text">1 người bầu (33.33%)</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 animate-on-scroll">
            <div class="vote-card">
                <img src="https://img.pikbest.com/wp/202345/cat-dog-pet-and-pets-in-real-pictures-wallpapers_9596134.jpg!w700wp" alt="Người bầu cử 3">
                <div class="card-body">
                    <h3>Người Bầu Cử 3</h3>
                    <p>Thông tin chi tiết về người bầu cử 3...</p>
                    <button class="btn btn-vote w-100">Bỏ Phiếu</button>
                    <div class="results-column">
                        <div class="result-bar" style="width: 0%;"></div>
                        <p class="result-text">0 người bầu (0%)</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('show');
            }
        });
    });

    const hiddenElements = document.querySelectorAll('.animate-on-scroll');
    hiddenElements.forEach(el => observer.observe(el));
</script>
</body>
</html>

