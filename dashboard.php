<?php

require('includes/connection.php');
include('classes/user-checked.php');
include('header.php');

$userType = $_SESSION['type'];
?>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Dettagli Prenotazione</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modalBodyContainer"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Chiudi</button>
            </div>
        </div>
    </div>
</div>


<div id="wrapper">

    <?php include(__DIR__ . '/templates/dashboard-sidebar.html.php'); ?>

    <div id="content-wrapper">

        <div class="container-fluid">

            <?php if ($userType == 1): ?>

                <!-- Breadcrumbs-->
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">Prenotazioni di Oggi</li>
                </ol>

                <!-- Cards -->
                <div class="row">
                    <div class="col-xl-3 col-sm-6 mb-3">
                        <div class="card text-white bg-dark o-hidden h-100">
                            <div class="card-body">
                                <div class="card-body-icon">
                                    <i class="fas fa-fw fa-calendar-alt"></i>
                                </div>
                                <div class="mr-5">
                                    <h1>
                                        <?php
                                        $today = date('Y-m-d');
                                        $query = "SELECT count(id_order) FROM orders WHERE order_date = '" . $today . "'";
                                        echo($reservation_qty = $pdo->query($query)->fetchColumn());
                                        ?>
                                    </h1>
                                </div>
                            </div>
                            <a class="card-footer text-white clearfix small z-1" href="/reservation-management.php">
                                <span class="float-left">Prenotazioni di oggi</span>
                                <span class="float-right">
                                    <i class="fas fa-angle-right"></i>
                                </span>
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 mb-3">
                        <div class="card text-white bg-secondary o-hidden h-100">
                            <div class="card-body">
                                <div class="card-body-icon">
                                    <i class="fas fa-fw fa-user"></i>
                                </div>
                                <div class="mr-5">
                                    <h1>
                                        <?php echo($product_qty = $pdo->query("SELECT count(memberID) FROM members WHERE type!='1'")->fetchColumn()); ?>
                                    </h1>
                                </div>
                            </div>
                            <a class="card-footer text-white clearfix small z-1" href="/customer-management.php">
                                <span class="float-left">Clienti</span>
                                <span class="float-right">
                                    <i class="fas fa-angle-right"></i>
                                </span>
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 mb-3">
                        <div class="card text-white bg-info o-hidden h-100">
                            <div class="card-body">
                                <div class="card-body-icon">
                                    <i class="fas fa-fw fa-sitemap"></i>
                                </div>
                                <div class="mr-5">
                                    <h1>
                                        <?php echo($product_qty = $pdo->query("SELECT COUNT(id_resource) FROM resources")->fetchColumn()); ?>
                                    </h1>
                                </div>
                            </div>
                            <a class="card-footer text-white clearfix small z-1" href="/resource-management.php">
                                <span class="float-left">Collaboratori </span>
                                <span class="float-right">
                                    <i class="fas fa-angle-right"></i>
                                </span>
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 mb-3">
                        <div class="card text-white bg-success o-hidden h-100">
                            <div class="card-body">
                                <div class="card-body-icon">
                                    <i class="fas fa-fw fa-cut"></i>
                                </div>
                                <div class="mr-5">
                                    <h1>
                                        <?php echo($product_qty = $pdo->query("SELECT count(id_product) FROM products")->fetchColumn()); ?>
                                    </h1>
                                </div>
                            </div>
                            <a class="card-footer text-white clearfix small z-1" href="/product-management.php">
                                <span class="float-left">Prodotti</span>
                                <span class="float-right">
                                    <i class="fas fa-angle-right"></i>
                                </span>
                            </a>
                        </div>
                    </div>
                </div><!-- END row -->
                <!-- END Cards -->



                <!-- DataTables Example -->
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fas fa-table"></i>
                        Prenotazioni di Oggi
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">

                            <?php

                            $today = $today = date('Y-m-d');

                            $type = $_SESSION['type'];

                            $sql_resource = "SELECT * FROM orders left JOIN resources on (orders.resource = resources.id_resource) WHERE orders.order_date = '$today' ORDER BY order_date ASC, start_time ASC;";

                            $sql_resource .= ($type != 1) ? " where customer = " . $_SESSION['memberID'] : "";

                            if ($result_resource = $pdo->prepare($sql_resource)) {
                                ($result_resource->execute());
                                $result = ($result_resource->fetchAll());
                                // var_dump($result[20]);
                                ?>

                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Data/ora</th>
                                            <th>Collaboratore</th>
                                            <th>Cliente</th>
                                            <th>Dettagli</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Data/ora</th>
                                            <th>Collaboratore</th>
                                            <th>Cliente</th>
                                            <th>Dettagli</th>
                                        </tr>
                                    </tfoot>




                                    <tbody>
                                        <?php
                                        foreach ($result as $item):
                                            ?>
                                            <tr>
                                                <td>
                                                    <a>
                                                        <i class="fa fa-calendar"></i> <?= date('d/m/Y', strtotime($item["order_date"])); ?> &nbsp;&nbsp;
                                                        <i class="fa fa-clock"></i>    <?= date('H:i',   strtotime($item["start_time"])); ?>
                                                    </a>
                                                </td>
                                                <td>
                                                    <?php echo $item['first_name'] . " " . $item['last_name']; ?>
                                                </td>
                                                <td><?php echo $item['resource']; ?></td>
                                                <td>
                                                    <!-- <i class="fas fa-times"></i> Annullato | -->
                                                    <span
                                                        data-toggle="modal"
                                                        data-target="#exampleModal"
                                                        onclick="getOrderDetails(<?php echo $item['id_order'] ?> , '<?php echo $item["first_name"] ." ". $item["last_name"]    ?>')">
                                                        <i class="fa fa-info"></i> Dettagli
                                                    </span>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <?php
                            } else {
                                echo "Nessuna prenotazione da visualizzare";
                            }
                            ?>

                        </div>
                    </div>
                    <div class="card-footer small text-muted">
                        Aggiornato al <?php echo date("d-m-Y H:i"); ?>
                    </div>
                </div>

                <!-- <php include('reservation-today.php'); ?> -->

            <?php else:{
                header("location:reservation-management.php");
            } endif; ?>



        </div><!-- END container-fluid -->



    </div><!-- END content-wrapper -->

</div><!-- END wrapper -->

<?php include('footer.php'); ?>
