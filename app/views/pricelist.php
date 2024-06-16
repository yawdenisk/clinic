<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Centrum Okulistyczne - Cennik</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../../public/css/pricelist.css">
    <style>
        /* Custom styles */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f3f4;
        }
        .custom-navbar {
            background: linear-gradient(90deg, #1d3557, #457b9d);
            padding: 15px 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }
        .custom-brand {
            font-size: 1.75rem;
            font-weight: bold;
            color: #fff;
        }
        .custom-toggler {
            border: none;
        }
        .custom-toggler .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3E%3Cpath stroke='rgba(255, 255, 255, 0.5)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
        }
        .navbar-nav .nav-link {
            color: #fff !important;
            margin: 0 15px;
            transition: color 0.3s ease;
        }
        .navbar-nav .nav-link:hover {
            color: #ff6f61 !important;
        }
        .container {
            margin-top: 60px;
        }
        h1 {
            color: #1565c0;
            text-align: center;
            margin-bottom: 30px;
        }
        .price-list {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-top: 30px;
        }
        .section {
            margin-bottom: 30px;
        }
        h2 {
            color: #1565c0;
            font-size: 2rem;
            margin-bottom: 20px;
        }
        .grid-section {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }
        .grid-item {
            background-color: #f0f0f0;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .grid-item h3 {
            color: #1565c0;
            font-size: 1.5rem;
            margin-bottom: 10px;
        }
        .grid-item p {
            font-size: 1.2rem;
            color: #555;
            margin-bottom: 0;
        }
    </style>
</head>
<body>
    <?php include 'shared_navbar.php'; ?>

    <div class="container">
        <h1>Ceny</h1>
        <div class="price-list">
            <div class="section">
                <h2>Diagnostyka</h2>
                <div class="grid-section">
                    <div class="grid-item">
                        <h3>Konsultacja specjalistyczna, badanie</h3>
                        <p>350 PLN</p>
                    </div>
                    <div class="grid-item">
                        <h3>Wymiana okularów</h3>
                        <p>100 PLN</p>
                    </div>
                    <div class="grid-item">
                        <h3>Cyfrowe zdjęcie oka</h3>
                        <p>150 PLN</p>
                    </div>
                    <div class="grid-item">
                        <h3>Diagnostyka wzroku</h3>
                        <p>250 PLN</p>
                    </div>
                </div>
            </div>

            <div class="section">
                <h2>Okulistyka zachowawcza</h2>
                <div class="grid-section">
                    <div class="grid-item">
                        <h3>Korekcja wzroku</h3>
                        <p>2000 PLN</p>
                    </div>
                    <div class="grid-item">
                        <h3>Korekcja wzroku +</h3>
                        <p>2500 PLN</p>
                    </div>
                    <div class="grid-item">
                        <h3>Korekcja wzroku ++</h3>
                        <p>3500 PLN</p>
                    </div>
                    <div class="grid-item">
                        <h3>Zmiana soczewek</h3>
                        <p>100 PLN</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
