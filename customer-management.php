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
                <h1 class="h2">Clienti</h1>
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
