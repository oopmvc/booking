<?php
session_start();
include('header.php');
require("includes/connection.php");
?>


<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="dashboard.php">
                            <span data-feather="home"></span>
                            Pannello di Controllo
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="product-management.php">
                            <span data-feather="file"></span>
                            Prodotti
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="resource.php">
                            <span data-feather="users"></span>
                            Risorse
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="reservation.php">
                            <span data-feather="shopping-cart"></span>
                            Prenotazioni
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php">
                            <span data-feather="bar-chart-2"></span>
                            Reports
                        </a>
                    </li>
                    <!-- <li class="nav-item">
                    <a class="nav-link" href="#">
                    <span data-feather="layers"></span>
                    Integrations
                </a>
            </li> -->
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Prenotazioni</span>
            <!-- <a class="d-flex align-items-center text-muted" href="#">
            <span data-feather="plus-circle"></span>
        </a> -->
    </h6>
    <ul class="nav flex-column mb-2">
        <li class="nav-item">
            <a class="nav-link" href="#">
                <span data-feather="file-text"></span>
                Oggi
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <span data-feather="file-text"></span>
                Settimana Corrente
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <span data-feather="file-text"></span>
                Settimana Prossima
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <span data-feather="file-text"></span>
                Tutte
            </a>
        </li>
    </ul>
</div>
</nav>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Pannello di Controllo</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
                <button class="btn btn-sm btn-outline-secondary">Condividi</button>
                <button class="btn btn-sm btn-outline-secondary">Esporta</button>
            </div>
            <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar"></span>
                Questa settimana
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">
            <div class="card text-white bg-dark mb-3">
                <div class="card-header"><i class="fas fa-calendar-alt fa-2x"></i></div>
                <div class="card-body">
                    <a class="text-white" href="product-management.php">
                        <h1 class="card-title">12</h1>
                        Prenotazioni
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card text-white bg-info mb-3">
                <div class="card-header"><i class="fas fa-user fa-2x"></i></div>
                <div class="card-body">
                    <a class="text-white" href="resource-management.php">
                        <h1 class="card-title">123</h1>
                        Clienti
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-header"><i class="fas fa-sitemap fa-2x"></i></div>
                <div class="card-body">
                    <a class="text-white" href="#">
                        <h1 class="card-title">5</h1>
                        Staff
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-header"><i class="fas fa-cut fa-2x"></i></div>
                <div class="card-body">
                    <a class="text-white" href="#">
                        <h1 class="card-title">7</h1>
                        Prodotti
                    </a>
                </div>
            </div>
        </div>


    </div>


    <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>

    <h2>Prenotazioni</h2>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Header</th>
                    <th>Header</th>
                    <th>Header</th>
                    <th>Header</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1,001</td>
                    <td>Lorem</td>
                    <td>ipsum</td>
                    <td>dolor</td>
                    <td>sit</td>
                </tr>
                <tr>
                    <td>1,002</td>
                    <td>amet</td>
                    <td>consectetur</td>
                    <td>adipiscing</td>
                    <td>elit</td>
                </tr>
                <tr>
                    <td>1,003</td>
                    <td>Integer</td>
                    <td>nec</td>
                    <td>odio</td>
                    <td>Praesent</td>
                </tr>
                <tr>
                    <td>1,003</td>
                    <td>libero</td>
                    <td>Sed</td>
                    <td>cursus</td>
                    <td>ante</td>
                </tr>
                <tr>
                    <td>1,004</td>
                    <td>dapibus</td>
                    <td>diam</td>
                    <td>Sed</td>
                    <td>nisi</td>
                </tr>
                <tr>
                    <td>1,005</td>
                    <td>Nulla</td>
                    <td>quis</td>
                    <td>sem</td>
                    <td>at</td>
                </tr>
                <tr>
                    <td>1,006</td>
                    <td>nibh</td>
                    <td>elementum</td>
                    <td>imperdiet</td>
                    <td>Duis</td>
                </tr>
                <tr>
                    <td>1,007</td>
                    <td>sagittis</td>
                    <td>ipsum</td>
                    <td>Praesent</td>
                    <td>mauris</td>
                </tr>
                <tr>
                    <td>1,008</td>
                    <td>Fusce</td>
                    <td>nec</td>
                    <td>tellus</td>
                    <td>sed</td>
                </tr>
                <tr>
                    <td>1,009</td>
                    <td>augue</td>
                    <td>semper</td>
                    <td>porta</td>
                    <td>Mauris</td>
                </tr>
                <tr>
                    <td>1,010</td>
                    <td>massa</td>
                    <td>Vestibulum</td>
                    <td>lacinia</td>
                    <td>arcu</td>
                </tr>
                <tr>
                    <td>1,011</td>
                    <td>eget</td>
                    <td>nulla</td>
                    <td>Class</td>
                    <td>aptent</td>
                </tr>
                <tr>
                    <td>1,012</td>
                    <td>taciti</td>
                    <td>sociosqu</td>
                    <td>ad</td>
                    <td>litora</td>
                </tr>
                <tr>
                    <td>1,013</td>
                    <td>torquent</td>
                    <td>per</td>
                    <td>conubia</td>
                    <td>nostra</td>
                </tr>
                <tr>
                    <td>1,014</td>
                    <td>per</td>
                    <td>inceptos</td>
                    <td>himenaeos</td>
                    <td>Curabitur</td>
                </tr>
                <tr>
                    <td>1,015</td>
                    <td>sodales</td>
                    <td>ligula</td>
                    <td>in</td>
                    <td>libero</td>
                </tr>
            </tbody>
        </table>
    </div>
</main>
</div>
</div>



<?php include('footer.php'); ?>
