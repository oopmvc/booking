<?php
require('includes/connection.php');
include('classes/user-checked.php');
include('header.php');
?>

<div id="wrapper">

    <?php include(__DIR__ . '/templates/dashboard-sidebar.html.php'); ?>

    <div id="content-wrapper">

        <div class="container-fluid">

            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item active">Prenotazioni di Oggi</li>
            </ol>

            <main role="main" class="">
                <?php include('reservation-today.php'); ?>
            </main>

        </div>

    </div>

</div>

<?php include('footer.php'); ?>
