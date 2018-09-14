<?php
require('includes/connection.php');
include('header.php');
?>



<div class="container-fluid">
    <div class="row">

        <?php include(__DIR__.'/templates/dashboard-sidebar.html.php'); ?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Prenotazioni di Oggi</h1>
            </div>
        </main>
    </div>
</div>



<?php include('./footer.php'); ?>
