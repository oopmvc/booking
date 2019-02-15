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
                <li class="breadcrumb-item active">Prenotazioni (Tutte)</li>
            </ol>

            <main role="main" class="">
                <?php include('reservation-all.php'); ?>
            </main>

        </div><!-- END container-fluid -->

    </div><!-- END content-wrapper -->

</div><!-- END wrapper -->

<?php include('footer.php'); ?>
