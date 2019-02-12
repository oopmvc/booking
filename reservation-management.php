<?php
require 'includes/connection.php';
include 'classes/user-checked.php';
include 'header.php';
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

            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item active">Prenotazioni di Oggi</li>
                <?php if ($_SESSION['type'] == 1): ?>
                    <li class="breadcrumb-item">
                        <a href="reservation-create.php">
                            Aggiungi Prenotazione
                        </a>
                    </li>
                <?php endif;?>
            </ol>

            <main role="main">

                <div class="table-responsive">
                    <?php

                    $type = $_SESSION['type'];
                    $sql_resource = "SELECT * FROM orders LEFT JOIN resources on (orders.resource = resources.id_resource) ";
                    // $sql_resource = "SELECT orders.id_order, members.first_name, members.last_name, orders.order_date, orders.start_time FROM orders
                    //         JOIN members on (orders.customer = members.memberID)
                    //     ORDER BY order_date DESC, start_time DESC";

                    $sql_resource .= ($type != 1) ? " where customer = " . $_SESSION['memberID'] : "";
                    $sql_resource .= " ORDER BY order_date DESC ";
                    if ($result_resource = $pdo->prepare($sql_resource)) {
                        $result_resource->execute();
                        $result = ($result_resource->fetchAll());
                        // var_dump($result[20]);
                    ?>
                        <table id="myTable" class="table table-striped table-sm">
                            <thead>
                            <tr>
                                <th>Data/ora</th>
                                <th>Collaboratore</th>
                                <th>Cliente</th>
                                <th>Dettagli</th>
                            </tr>
                            </thead>
                            <tbody>


                            <?php foreach ($result as $item): ?>
                                <tr>


                                    <!-- Data e ora -->
                                    <td>
                                        <a>
                                            ID: <?=$item["id_order"];?> &nbsp;
                                            <i class="fa fa-calendar"></i> <?=date('d-m-Y', strtotime($item["order_date"]));?> &nbsp;
                                            <i class="fa fa-clock"></i>    <?=date('H:i', strtotime($item["start_time"]));?> &nbsp;
                                        </a>
                                    </td>


                                    <!-- Collaboratore -->
                                    <td><?php echo $item['first_name'] . " " . $item['last_name']; ?></td>


                                    <!-- Cliente -->
                                    <td><?php echo $item['first_name'] . " " . $item['last_name']; ?></td>


                                    <!-- Dettagli Prenotazione -->
                                    <td>
                                        <!-- <i class="fas fa-times"></i> Annullato | -->
                                        <span data-toggle="modal" data-target="#exampleModal" onclick="getOrderDetails(<?php echo $item['id_order'] ?> , '<?php echo $item["first_name"] . " " . $item["last_name"] ?>')">
                                            <i class="fa fa-info"></i> Vedi Prodotti
                                        </span>
                                    </td>


                                </tr>
                            <?php endforeach;?>


                            </tbody>
                        </table>
                        <?php
                        } else {
                            echo "Nessuna prenotazione da visualizzare";
                        }
                        ?>
                </div>
            </main>
        </div>
    </div>
</div>

<?php include 'footer.php';?>
