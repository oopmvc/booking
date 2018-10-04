<?php
$userType = $_SESSION['type'];
?>

<nav class="col-md-2 d-none d-md-block bg-dark sidebar">
    <div class="sidebar-sticky">

        <a href="dashboard.php"><img src="img/logo-maurizio-02.png" alt="logo maurizio barber shop foggia"
                                     class="img-fluid"></a>
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-2 mb-1 text-muted ">
            <span class="text-white">Menu</span>
        </h6>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="dashboard.php">
                    <i class="fas fa-home"></i> Pannello di Controllo
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="reservation-management.php">
                    <i class="fas fa-calendar-alt"></i> Prenotazioni
                </a>
            </li>
            <?php if ($userType == 1): ?>
                <li class="nav-item">
                    <a class="nav-link" href="customer-management.php">
                        <i class="fas fa-user"></i> Clienti
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="product-management.php">
                        <i class="fas fa-cut"></i> Prodotti
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="resource-management.php">
                        <i class="fas fa-sitemap"></i> Staff
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="opening-time-management.php">
                        <i class="fas fa-clock"></i> Orari Apertura
                    </a>
                </li>
            <?php endif; ?>
        </ul>

        <?php if ($userType == 1): ?>
            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-5 mb-1 text-muteds">
                <span class="text-white">Report</span>
            </h6>

            <ul class="nav flex-column mb-2">
                <li class="nav-item">
                    <a class="nav-link" href="report-reservation-today.php">
                        <i class="fas fa-chart-bar"></i> Prenotazioni di Oggi
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="report-reservation-week.php">
                        <i class="fas fa-chart-bar"></i> Prenotazioni della Settimana
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="report-reservation-all.php">
                        <i class="fas fa-chart-bar"></i> Prenotazioni di Sempre
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="report-customer-not-active.php">
                        <i class="fas fa-chart-bar"></i> Clienti Inattivi
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="report-customer-top.php">
                        <i class="fas fa-chart-bar"></i> Clienti Top 100
                    </a>
                </li>
            </ul>
        <?php endif; ?>
    </div>
</nav>
