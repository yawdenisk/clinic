<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Centrum Okulistyczne - Główna</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet'>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css' rel='stylesheet'>
    <link rel="stylesheet" href="../../public/css/styles.css">
    <link rel="stylesheet" href="../../public/css/index.css">
    <style>
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
        .custom-link {
            color: #fff !important;
            margin: 0 15px;
            transition: color 0.3s ease;
        }
        .custom-link:hover {
            color: #ff6f61 !important;
        }
        .custom-btn {
            background-color: #ff6f61;
            color: #fff;
            border: none;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        .custom-btn:hover {
            background-color: #e63946;
            color: #fff;
        }
        .navbar-text {
            color: #fff;
            font-size: 1.1rem;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f3f4;
        }
        .container {
            margin-top: 60px;
        }
        .hero-section {
            background: linear-gradient(90deg, #1d3557, #457b9d);
            color: #fff;
            padding: 50px 20px;
            border-radius: 10px;
            text-align: center;
        }
        .hero-section h2 {
            font-size: 2.5rem;
        }
        .hero-section a {
            margin-top: 20px;
            display: inline-block;
        }
        .doctor-card img {
            width: 100%;
            height: auto;
            border-radius: 10px;
        }
        .doctor-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 15px;
            margin: 15px 0;
            text-align: center;
        }
        .doctor-card h3 {
            color: #1d3557;
            margin-top: 10px;
        }
        .doctor-card p {
            color: #333;
        }
        #news .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        #news .card-title {
            display: flex;
            align-items: center;
            font-size: 1.25rem;
        }
        #news .card-title i {
            margin-right: 10px;
        }
        .card-text {
            color: #000;
            background-color: rgba(255, 255, 255, 0.8);
            padding: 10px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <?php include 'shared_navbar.php'; ?>
    <div class="container">
        <div class="row">
            <div class="col-12 hero-section">
                <h2>Zaloguj się i umów się na pierwszą wizytę!</h2>
                <a href="patient_register.php" class="btn btn-lg custom-btn m-2">Zarejestruj się</a>
                <a href="patient_login.php" class="btn btn-lg btn-secondary m-2">Zaloguj się</a>
            </div>
        </div>
        <div id="our-doctors" class="row mt-5">
            <h2 class="text-center mb-4">Nasze lekarze</h2>
            <div class="col-md-4 doctor-card">
                <img src="https://www.pinnacledentalgroupmi.com/wp-content/uploads/2023/11/general-dentistry-img.jpeg" alt="Dr. Anna Nowak">
                <h3>Dr. Anna Nowak</h3>
                <p>Specialization: Okulista</p>
                <p>Biography: Dr. Anna Nowak to specjalista z dużym doświadczeniem, która ukończyła Uniwersytet medyczny w Gdańsku.</p>
            </div>
            <div class="col-md-4 doctor-card">
                <img src="https://www.west10thdental.com/wp-content/uploads/iStock-1147578995-920x614.jpg" alt="Dr. Szymon Kotarski">
                <h3>Dr. Szymon Kotarski</h3>
                <p>Specialization: Okulista</p>
                <p>Biography: Dr. Szymon Kotarski to specjalista z dużym doświadczeniem, który ukończył Uniwersytet medyczny w Gdańsku.</p>
            </div>
            <div class="col-md-4 doctor-card">
                <img src="https://www.shutterstock.com/image-photo/european-mid-dentist-woman-smiling-600nw-1938573190.jpg" alt="Dr. Kordian Wiśniewski">
                <h3>Dr. Kordian Wiśniewski</h3>
                <p>Specialization: Okulista</p>
                <p>Biography: Dr. Kordian Wiśniewski to specjalista z dużym doświadczeniem, który ukończył Uniwersytet medyczny w Gdańsku.</p>
            </div>
        </div>
        <div id="news" class="row mt-5">
            <h2 class="text-center mb-4">Nowości</h2>
            <div class="col-md-4 mb-3">
                <div class="card border-info">
                    <div class="card-body">
                        <h4 class="card-title text-info"><i class="bi bi-megaphone-fill"></i> Otwieramy się!</h4>
                        <p class="card-text">Pierwsze spotkanie odbędzie się w poniedziałek 17.06.2024 na ulicy Targ Drewny 48 o godzinie 14:00.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card border-warning">
                    <div class="card-body">
                        <h4 class="card-title text-warning"><i class="bi bi-calendar-week-fill"></i> Weekend</h4>
                        <p class="card-text">Zapraszamy państwa nawet w weekendy, pracujemy 24/7.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card border-success">
                    <div class="card-body">
                        <h4 class="card-title text-success"><i class="bi bi-gift-fill"></i> Gratis - badanie</h4>
                        <p class="card-text">Zapraszmy państwa na bezpłatne badanie lekarskie we wtorek 18.06.2024, pracujemy od 8:00 do 19:00.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script src="https://maps.googleapis.com
