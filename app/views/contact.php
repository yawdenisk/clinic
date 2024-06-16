<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Centrun okulistyczne - Kontakt</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet'>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css' rel='stylesheet'>
    <link rel="stylesheet" href="../../public/css/styles.css">
    <link rel="stylesheet" href="../../public/css/contact.css"> <!-- Используется для стилей этой страницы -->
    <style>
        /* Custom styles */
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
            margin: 0 10px;
            transition: color 0.3s ease;
        }
        .custom-link:hover {
            color: #FFC107 !important;
        }
        .custom-btn {
            background-color: #FFC107;
            color: #1565c0;
            border: none;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        .custom-btn:hover {
            background-color: #1565c0;
            color: #fff;
        }
        .navbar-text {
            color: #fff;
            font-size: 1rem;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            color: #333;
        }
        .container {
            margin-top: 80px;
        }
        h1 {
            color: #1565c0;
            text-align: center;
            margin-bottom: 30px;
        }
        p, span {
            color: #555;
        }
        .contact-wrapper {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            gap: 30px;
        }
        .contact-info {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
            max-width: 400px; /* Ограничиваем максимальную ширину блока информации о контакте */
            flex: 1;
        }
        .contact-info h2 {
            color: #1565c0;
            font-size: 2rem;
            text-align: center;
            margin-bottom: 20px;
        }
        .contact-info p {
            font-size: 1.2rem;
            margin-bottom: 15px;
            line-height: 1.6;
            text-align: center; /* Выравниваем текст по центру */
        }
        .contact-info a {
            color: #1565c0;
            text-decoration: none;
            font-weight: bold;
        }
        .contact-info a:hover {
            text-decoration: underline;
        }
        .map-container {
            max-width: 600px; /* Ограничиваем максимальную ширину карты */
            flex: 1;
        }
        iframe {
            width: 100%;
            height: 400px;
            border: none;
            border-radius: 10px;
        }
        @media (max-width: 768px) {
            .contact-wrapper {
                flex-direction: column;
                align-items: center; /* Центрируем элементы по центру на мобильных устройствах */
            }
        }
    </style>
</head>
<body>
    <?php include 'shared_navbar.php'; ?> <br><br>
    <div class="container">
        <h1>Kontakt</h1>
        <div class="contact-wrapper">
            <div class="contact-info">
                <h2>Lokalizacja</h2>
                <p><strong>Adres:</strong> ul. Targ Drewny 48, Gdańsk</p>
                <p><strong>Telefon:</strong> +48 111 111 111</p>
                <p><strong>Email:</strong> <a href="mailto:infokulistclinic@gmail.com">infokulistclinic@gmail.com</a></p>
            </div>
            <div class="map-container">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d691.3036803453579!2d18.648032373156674!3d54.3524015120588!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46fd7366854c6ad7%3A0xa93b61471c5634f9!2sPJATK%20Gda%C5%84sk%20-%20Wydzia%C5%82%20Informatyki!5e0!3m2!1sen!2spl!4v1716741862361!5m2!1sen!2spl" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
