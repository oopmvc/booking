<?php
$userType = $_SESSION['type'];
?>

<ul class="sidebar navbar-nav">

    <?php if ($userType == 1): ?>

    <li class="nav-item">
        <a class="nav-link" href="dashboard.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <?php endif; ?>

    <li class="nav-item">
        <a class="nav-link" href="reservation-management.php">
            <i class="fas fa-calendar-alt"></i>
            <span>Prenotazioni</span>
        </a>
    </li>

    <?php if ($userType == 1): ?>

        <li class="nav-item">
            <a class="nav-link" href="customer-management.php">
                <i class="fas fa-user"></i>
                <span>Clienti</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="product-management.php">
                <i class="fas fa-cut"></i>
                <span>Prodotti</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="resource-management.php">
                <i class="fas fa-sitemap"></i>
                <span>Staff</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="opening-time-management.php">
                <i class="fas fa-clock"></i>
                <span>Orari Apertura</span>
            </a>
        </li>

        <?php if ($userType == 1): ?>

            <li class="nav-item">
                <a class="nav-link" href="report-reservation-today.php">
                    <i class="fas fa-chart-bar"></i>
                    <span>Prenotazioni (oggi)</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="report-reservation-all.php">
                    <i class="fas fa-chart-bar"></i>
                    <span>Prenotazioni (tutte)</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-chart-bar"></i>
                    <span>

                        <?php

                            $username = urlencode("ildottore87fg");
                            $password = urlencode("lmtgpp87");
                            $api_id   = urlencode("3637566");

                            $credits = file_get_contents("https://api.clickatell.com/http/getbalance"
                                . "?user=" . $username
                                . "&password=" . $password
                                . "&api_id=" . $api_id);

                            echo $credits;

                        ?>

                    </span>
                </a>
            </li>



        <?php endif; ?>

    <?php endif; ?>

</ul>
