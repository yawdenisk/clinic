<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Centrun okulistyczne - Głowna</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet'>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css' rel='stylesheet'>
    <link rel="stylesheet" href="../../public/css/styles.css">
    <link rel="stylesheet" href="../../public/css/index.css">
    <style>
        #myVideo {
            filter: brightness(60%);
        }
        .doctor-card img {
            width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <?php include 'shared_navbar.php'; ?>
    <div class="container">
        <div class="row">
            <br>
            <div class="col-lg-5 p-4">
                <h2>Zaloguj się i umow się na pierwszą wizytę!</h2>
                <br>
                <a href="patient_register.php" class="btn btn-lg btn-primary m-2">Zarejestruj się</a>
                <a href="patient_login.php" class="btn btn-lg btn-secondary m-2">Zaloguj się</a>
            </div>
            <div class="col-lg-7 p-4">
                <video autoplay muted loop id="myVideo" class="w-100">
                    <source src="../../public/videos/start_video2.mp4" type="video/mp4">
                </video>
            </div>
        </div>
        <div id="our-doctors" class="row">
            <h2 class="text-center mt-5">Nasze lekarze</h2>
            <div class="col-md-4 doctor-card">
                <img src="https://www.pinnacledentalgroupmi.com/wp-content/uploads/2023/11/general-dentistry-img.jpeg" alt="Dr. Anna Nowak">
                <h3>Dr. Anna Nowak</h3>
                <p>Specialization: Okulista </p>
                <p>Biography: Dr. Anna Nowak to specjalista z dużym doświadczeniem ktora ukończyła Uniwersytet medyczny w Gdańsku</p>
            </div>
            <div class="col-md-4 doctor-card">
                <img src="https://www.west10thdental.com/wp-content/uploads/iStock-1147578995-920x614.jpg" alt="Dr. Jan Nowak">
                <h3>Dr. Szymon Kotarski</h3>
                <p>Specialization: Prosthodontist</p>
                <p>Biography: Dr. Szymon Kotarski to specjalista z dużym doświadczeniem ktora ukończyła Uniwersytet medyczny w Gdańsku</p>
            </div>
            <div class="col-md-4 doctor-card">
                <img src="https://www.shutterstock.com/image-photo/european-mid-dentist-woman-smiling-600nw-1938573190.jpg" alt="Dr. Maria Wiśniewska">
                <h3>Dr. Kordian Wiśniewski</h3>
                <p>Specialization: Okulista</p>
                <p>Biography: Dr. Kordian Wiśniewski to specjalista z dużym doświadczeniem ktora ukończyła Uniwersytet medyczny w Gdańsku</p>
            </div>
        </div>
        <div id="news" class="row mt-5">
            <h2 class="text-center">Nowości</h2>
            <div class="col-md-12">
                <div class="alert alert-info">
                    <h4>Otwieramy się!</h4>
                    <p>Pierwsze spotkanie odejdzie się w poniedziałek 17.06.2024 na ulice Targ Drewny 48 o godzinie 14:00</p>
                </div>
                <div class="alert alert-warning">
                    <h4>Weekend</h4>
                    <p>Zapraszamy państwa nawet w weekendy, pracujemy 24/7</p>
                </div>
                <div class="alert alert-success">
                    <h4>Gratis - badanie </h4>
                    <p>Zapraszmy państwa na bezpłatne badanie lekarskie we wtorek 18.06.2024, pracujemy od 8:00 do 19:00</p>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY"></script>
    <script type="module">
        import { initializeApp } from "https://www.gstatic.com/firebasejs/10.12.2/firebase-app.js";

        const firebaseConfig = {
            apiKey: "AIzaSyAxzVXAIo_8UKc7BZFErEL42Gw8TWmEkXA",
            authDomain: "dentalclinic-wprg.firebaseapp.com",
            projectId: "dentalclinic-wprg",
            storageBucket: "dentalclinic-wprg.appspot.com",
            messagingSenderId: "1039400925600",
            appId: "1:1039400925600:web:9bef5273aa15f72dcc8cc5"
        };
        
        const app = initializeApp(firebaseConfig);
    </script>
</body>
</html>