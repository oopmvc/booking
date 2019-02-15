<?php if ($userType == 1): ?>

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

    <div class="table-responsive">

        <?php

        $today = date('d/m/Y');

        $type = $_SESSION['type'];


        /** TODAY
        $sql_resource = "SELECT * FROM orders
            LEFT JOIN resources on (orders.resource = resources.id_resource)
            WHERE orders.order_date = '$today'
            ORDER BY order_date ASC, start_time ASC;";
        $sql_resource .= ($type != 1) ? " where customer = " . $_SESSION['memberID'] : "";
        */


        /** ALL */
        //$sql_resource = "SELECT * FROM orders left JOIN resources on (orders.resource = resources.id_resource) ORDER BY order_date DESC, start_time DESC;";
        /**$sql_resource = "SELECT * FROM orders
            LEFT JOIN resources on (orders.resource = resources.id_resource)
            ORDER BY order_date DESC, start_time DESC;";
        */
        $sql_resource = "SELECT * FROM orders
            LEFT JOIN resources on (orders.resource = resources.id_resource)
            ORDER BY order_date DESC, start_time DESC;";

        $sql_resource .= ($type != 1) ? " where customer = " . $_SESSION['memberID'] : "";

        if ($result_resource = $pdo->prepare($sql_resource)) {
            ($result_resource->execute());
            $result = ($result_resource->fetchAll());
            // var_dump($result[20]);
            ?>

            <table id="myTable" class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>ID</th>
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
                            <td>
                                <?= $item["id_order"]; ?>
                            </td>
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
                                <?php echo $item['resource']; ?>
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



    <!-- DataTables Example
    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table"></i>
            Prenotazioni di Sempre
        </div>
        <div class="card-body">

        </div>
        <div class="card-footer small text-muted">
            Aggiornato al <php echo date("d-m-Y H:i"); ?>
        </div>
    </div>
    -->


<?php else:{
    header("location:reservation-management.php");
} endif; ?>
