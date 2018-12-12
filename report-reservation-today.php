<?php
require('includes/connection.php');
include('classes/user-checked.php');
include('header.php');
?>



<div class="container-fluid">
    <div class="row">

        <?php include(__DIR__.'/templates/dashboard-sidebar.html.php'); ?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-9 px-4">
            <h1 class="h2">Prenotazioni di Oggi</h1>
            <?php include('reservation-today.php'); ?>
        </main>
        
    </div>
</div>



<?php include('footer.php'); ?>
