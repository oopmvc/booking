<?php
require('includes/connection.php');
include('classes/user-checked.php');
include('header.php');
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

<div class="container-fluid">
    <div class="row">

        <?php
        include(__DIR__ . '/templates/dashboard-sidebar.html.php'); ?>
        <main role="main" class="col-lg-9 col-md-9 ml-sm-auto px-4">
            <?php if ($_SESSION['type'] == 1): ?>
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Prenotazioni</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <a href="reservation-create.php" class="float-right btn btn-sm btn-success ml-2" type="submit">
                            Aggiungi Prenotazione
                        </a>
                    </div>
                </div>
            <?php endif; ?>

            <div class="table-responsive">
                <?php

                $type = $_SESSION['type'];
                $sql_resource = "SELECT * FROM orders left JOIN resources on (orders.resource = resources.id_resource) ORDER BY order_date DESC";


                $sql_resource .= ($type != 1) ? " where customer = " . $_SESSION['memberID'] : "";

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
                        <?php
                        foreach ($result as $item):
                            ?>
                            <tr>
                                <!-- Data e ora -->
                                <td>
                                    <a>
                                        <i class="fa fa-calendar"></i> <?= date('d-m-Y', strtotime($item["order_date"])); ?> &nbsp;
                                        <i class="fa fa-clock"></i>    <?= date('H:i',   strtotime($item["start_time"])); ?> &nbsp;
                                    </a>
                                </td>
                                <!-- Collaboratore -->
                                <td>
                                    <?php echo $item['first_name'] . " " . $item['last_name']; ?>
                                </td>
                                <!-- Cliente -->
                                <td><?php echo $item['customer']; ?></td>
                                <!-- Dettagli Prenotazione -->
                                <td>
                                    <!-- <i class="fas fa-times"></i> Annullato | -->
                                    <span data-toggle="modal" data-target="#exampleModal" onclick="getOrderDetails(<?php echo $item['id_order'] ?> , '<?php echo $item["first_name"] ." ". $item["last_name"]    ?>')">
                                        <i class="fa fa-info"></i> Vedi dettagli
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
        </main>
    </div>
</div>

<?php include('footer.php'); ?>
