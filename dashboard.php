<?php

require('includes/connection.php');
include('classes/user-checked.php');
include('header.php');

$userType = $_SESSION['type'];
?>

<div class="container-fluid">
    <div class="row">

        <?php include(__DIR__ . '/templates/dashboard-sidebar.html.php'); ?>

        <?php if ($userType == 1): ?>
            <main role="main" class="col-lg-9 col-md-9 ml-sm-auto px-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Pannello di Controllo</h1>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="card text-white bg-dark mb-3">
                            <div class="card-header"><i class="fas fa-calendar-alt fa-2x"></i></div>
                            <div class="card-body">
                                <a class="text-white" href="reservation-management.php">
                                    <h1 class="card-title">
                                        <?php
                                            //$query = "SELECT count(id_order) FROM orders WHERE order_date = '11-12-2018'";
                                            $today = date('d-m-Y');
                                            $query = "SELECT count(id_order) FROM orders WHERE order_date = " . $today;
                                            echo($reservation_qty = $pdo->query($query)->fetchColumn());
                                            // echo ' ('. date('d-m-Y') . ')';
                                        ?>
                                    </h1>
                                    Prenotazioni di oggi
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card text-white bg-secondary mb-3">
                            <div class="card-header"><i class="fas fa-user fa-2x"></i></div>
                            <div class="card-body">
                                <a class="text-white" href="customer-management.php">
                                    <h1 class="card-title">
                                        <?php echo($product_qty = $pdo->query("SELECT count(memberID) FROM members")->fetchColumn()); ?>
                                    </h1>
                                    Clienti
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card text-white bg-info mb-3">
                            <div class="card-header"><i class="fas fa-sitemap fa-2x"></i></div>
                            <div class="card-body">
                                <a class="text-white" href="resource-management.php">
                                    <h1 class="card-title">
                                        <?php
                                        echo($product_qty = $pdo->query("SELECT COUNT(id_resource) FROM resources")->fetchColumn());
                                        ?>
                                    </h1>
                                    Collaboratori
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card text-white bg-success mb-3">
                            <div class="card-header"><i class="fas fa-cut fa-2x"></i></div>
                            <div class="card-body">
                                <a class="text-white" href="product-management.php">
                                    <h1 class="card-title">
                                        <?php echo($product_qty = $pdo->query("SELECT count(id_product) FROM products")->fetchColumn()); ?>
                                    </h1>
                                    Prodotti
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-lg-2">
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
                    </div> -->
                </div>


                <!-- <div class="row">
                    <div class="col-lg-6 bg-light report">
                        <h2 class="mt-3">Prenotazioni e Guadagno Settimanale</h2>
                        <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>
                    </div>
                    <div class="col-lg-6 bg-light report">
                        <h2 class="mt-3">Servizi Richiesti</h2>
                        <canvas class="my-4 w-100" id="myChart2" width="900" height="380"></canvas>
                    </div>
                </div> -->


                <h2 class="mt-5">Prenotazioni di Oggi</h2>

                <?php include('reservation-today.php'); ?>


                <!-- <h2 class="mt-5">TOP 5 Clienti</h2>
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
                        </tbody>
                    </table>
                </div> -->

            </main>
        <?php else:{
            header("location:reservation-management.php");
        } endif; ?>
    </div>
</div>

<!-- Graphs -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>

<!-- <script>
    var ctx = document.getElementById("myChart");
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["Lunedì", "Martedì", "Mercoledì", "Giovedì", "Venerdi", "Sabato", "Domenica"],
            datasets: [{
                data: [0, 80, 130, 150, 120, 200, 0],
                lineTension: 0,
                backgroundColor: 'transparent',
                borderColor: '#007bff',
                borderWidth: 4,
                pointBackgroundColor: '#007bff'
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: false
                    }
                }]
            },
            legend: {
                display: false,
            }
        }
    });
    var ctx = document.getElementById("myChart2");
    var myChart2 = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["Servizio 1", "Servizio 2", "Servizio 3", "Servizio 4", "Servizio 5", "Taglio Donna", "Taglio Uomo"],
            datasets: [{
                data: [13, 12, 4, 8, 20, 5, 100],
                lineTension: 0,
                backgroundColor: 'transparent',
                borderColor: '#007bff',
                borderWidth: 4,
                pointBackgroundColor: '#007bff'
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: false
                    }
                }]
            },
            legend: {
                display: false,
            }
        }
    });
</script> -->

<?php include('footer.php'); ?>
