<?php
require('includes/connection.php');
include('classes/user-checked.php');
include('header.php');
?>



<div id="wrapper">

    <?php include(__DIR__ . '/templates/dashboard-sidebar.html.php'); ?>

    <div id="content-wrapper">

        <div class="container-fluid">

            <?php if ($userType == 1): ?>

                <!-- Breadcrumbs-->
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">Prenotazioni di Sempre</li>
                </ol>

                <!-- DataTables Example -->
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fas fa-table"></i>
                        Prenotazioni di Sempre
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">

                            <?php

                            $today = $today = date('d/m/Y');

                            $type = $_SESSION['type'];

                            //$sql_resource = "SELECT * FROM orders left JOIN resources on (orders.resource = resources.id_resource) ORDER BY order_date DESC, start_time DESC;";
                            $sql_resource = "SELECT * FROM orders
                                LEFT JOIN members on (orders.customer = members.memberID)
                                LEFT JOIN resources on (orders.resource = resources.id_resource)
                                ORDER BY order_date DESC, start_time DESC;";

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
                                                <td>
                                                    <php echo $item['resource']; ?>
                                                </td>
                                                <td>
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

        <?php include('footer.php'); ?>

    </div><!-- END content-wrapper -->

</div><!-- END wrapper -->
