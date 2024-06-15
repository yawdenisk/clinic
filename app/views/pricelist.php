<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dental Clinic - Price list</title>
    <link rel="stylesheet" href="../../public/css/pricelist.css">
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet'>
</head>
<body>
    <?php include 'shared_navbar.php'; ?> <br><br>
    <h1>Ceny</h1>
    <div class="price-list">
        <div class="section">
            <h2>diagnostyka</h2>

            <div class="grid-section">
                <div class="grid-item">
                    <h3>Konsultacja specjalistyczna, badanie</h3>
                    <p>350 PLN</p>
                </div>
                <div class="grid-item">
                    <h3>Wymiana okularow</h3>
                    <p>100 PLN</p>
                </div>
                <div class="grid-item">
                    <h3>Cyfrowe zdjęcie oka</h3>
                    <p>150 PLN</p>
                </div>
                <div class="grid-item">
                    <h3>Diagnostyka wrzoku</h3>
                    <p>250 PLN</p>
                </div>
            </div>
        </div>

        <div class="section">
            <h2>Okulistyka zachowawcza</h2>
            <div class="item">
                <span class="description">Koreksja wzroku</span>
                <span class="price">2000 PLN</span>
            </div>
            <div class="item">
                <span class="description">Koreksja wzroku +</span>
                <span class="price">2500 PLN</span>
            </div>
            <div class="item">
                <span class="description">Koreksja wzroku ++</span>
                <span class="price">3500 PLN</span>
            </div>
            <div class="item">
                <span class="description">ZAmiana soszewek</span>
                <span class="price">100 PLN</span>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
