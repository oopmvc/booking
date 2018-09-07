<?php
session_start();
include('header.php');
require("includes/connection.php");
?>

<div class="container-fluid">
    <div class="row">

        <?php include('dashboard-sidebar.php'); ?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Pannello di Controllo</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
                        <span data-feather="calendar"></span>
                        Questa settimana
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-2">
                    <div class="card text-white bg-dark mb-3">
                        <div class="card-header"><i class="fas fa-calendar-alt fa-2x"></i></div>
                        <div class="card-body">
                            <a class="text-white" href="product-management.php">
                                <h1 class="card-title">0</h1>
                                Prenotazioni
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="card text-white bg-secondary mb-3">
                        <div class="card-header"><i class="fas fa-user fa-2x"></i></div>
                        <div class="card-body">
                            <a class="text-white" href="customer-management.php">
                                <h1 class="card-title">
                                    <?php echo($product_qty = $pdo->query("SELECT count(*) FROM members")->fetchColumn()); ?>
                                </h1>
                                Clienti
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="card text-white bg-info mb-3">
                        <div class="card-header"><i class="fas fa-sitemap fa-2x"></i></div>
                        <div class="card-body">
                            <a class="text-white" href="resource-management.php">
                                <h1 class="card-title">
                                    <?php
                                        $product_qty = $pdo->query("SELECT COUNT(id_resource) FROM resources")->fetchColumn();
                                        // Chiunque non è un collaboratore quindi ecco spiegato il decremento del totale dei prodotti
                                        echo ($product_qty-1);
                                    ?>
                                </h1>
                                Collaboratori
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="card text-white bg-success mb-3">
                        <div class="card-header"><i class="fas fa-cut fa-2x"></i></div>
                        <div class="card-body">
                            <a class="text-white" href="product-management.php">
                                <h1 class="card-title">
                                    <?php echo($product_qty = $pdo->query("SELECT count(*) FROM products")->fetchColumn()); ?>
                                </h1>
                                Prodotti
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="card text-white bg-warning mb-3">
                        <div class="card-header"><i class="fas fa-clock fa-2x"></i></div>
                        <div class="card-body">
                            <a class="text-white" href="#">
                                <h1 class="card-title">0 ore</h1>
                                Tempo Lavorato
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="card text-white bg-danger mb-3">
                        <div class="card-header"><i class="fas fa-euro-sign fa-2x"></i></div>
                        <div class="card-body">
                            <a class="text-white" href="#">
                                <h1 class="card-title">0 €</h1>
                                Incasso Totale
                            </a>
                        </div>
                    </div>
                </div>
            </div>



            <div class="row">
                <div class="col-lg-6"> <!-- bg-light report -->
                    <h2 class="mt-3">Prenotazioni e Guadagno Settimanale</h2>
                    <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>
                </div>
                <div class="col-lg-6"> <!-- bg-light report -->
                    <h2 class="mt-3">Servizi Richiesti</h2>
                    <canvas class="my-4 w-100" id="myChart2" width="900" height="380"></canvas>
                </div>
            </div>



            <h2 class="mt-5">Prenotazioni di Oggi</h2>
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th>N.</th>
                            <th>Cliente</th>
                            <th>Servizi</th>
                            <th>Collaboratore</th>
                            <th>Persone</th>
                            <th>Data/ora</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Mario Rossi</td>
                            <td>Razor Fade</td>
                            <td>Maurizio P.</td>
                            <td>1</td>
                            <td>20/09/2018 - 10.30</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Mario Rossi</td>
                            <td>Razor Fade</td>
                            <td>Maurizio P.</td>
                            <td>1</td>
                            <td>20/09/2018 - 10.30</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Mario Rossi</td>
                            <td>Razor Fade</td>
                            <td>Maurizio P.</td>
                            <td>1</td>
                            <td>20/09/2018 - 10.30</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Mario Rossi</td>
                            <td>Razor Fade</td>
                            <td>Maurizio P.</td>
                            <td>1</td>
                            <td>20/09/2018 - 10.30</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Mario Rossi</td>
                            <td>Razor Fade</td>
                            <td>Maurizio P.</td>
                            <td>1</td>
                            <td>20/09/2018 - 10.30</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Mario Rossi</td>
                            <td>Razor Fade</td>
                            <td>Maurizio P.</td>
                            <td>1</td>
                            <td>20/09/2018 - 10.30</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>



<?php include('footer.php'); ?>
