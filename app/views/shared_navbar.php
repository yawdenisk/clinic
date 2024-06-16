<nav class="navbar navbar-expand-lg custom-navbar fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand custom-brand" href="index.php">Cenrum okulistyczne</a>
        <button class="navbar-toggler custom-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <?php if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false) : ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link custom-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Załoguj się
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="patient_login.php">Pacjent</a>
                            <a class="dropdown-item" href="okulist_login.php">Pracownik</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link custom-link" href="patient_register.php">Zarajestruj się</a>
                    </li>
                <?php else : ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link custom-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Twoje konto
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <?php
                            if (isset($_SESSION['role'])) {
                                switch ($_SESSION['role']) {
                                    case 'administrator':
                                        echo '<a class="dropdown-item" href="admin_panel.php">Panel administratora</a>';
                                        break;
                                    case 'patient':
                                        echo '<a class="dropdown-item" href="patient_panel.php">Panel pacjenta</a>';
                                        break;
                                    case 'okulist':
                                        echo '<a class="dropdown-item" href="okulist_panel.php">Panel okulisty</a>';
                                        break;
                                }
                            }
                            ?>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link custom-link" href="chat.php">Chat</a>
                    </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a class="nav-link custom-link" href="index.php#our-doctors">Nasze lekarze</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link custom-link" href="index.php#news">Nowości</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link custom-link" href="pricelist.php">Ceny</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link custom-link" href="contact.php">Kontact</a>
                </li>
            </ul>
            <span class="navbar-text me-3">
                <?php
                if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']) {
                    $firstName = $_SESSION['first_name'] ?? 'Gość';
                    $role = $_SESSION['role'] ?? 'nieokreślona rola';
                    switch ($role) {
                        case 'administrator':
                            $translatedRole = 'administrator';
                            break;
                        case 'patient':
                            $translatedRole = 'patient';
                            break;
                        case 'okulist':
                            $translatedRole = 'okulist';
                            break;
                        default:
                            $translatedRole = 'unnamed role';
                    }
                    echo "Witaj <strong>" . htmlspecialchars($firstName) . "</strong>! You're logged in as <strong>" . htmlspecialchars($translatedRole) . "</strong>.";
                }
                ?>
            </span>
            <span class="nav-item">
                <?php
                if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']) {
                    echo '<a class="btn custom-btn" href="../controllers/logout_controller.php">Wyloguj się</a>';
                }
                ?>
            </span>
        </div>
    </div>
</nav>
