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
                    <td>
                        <a>
                            <i class="fa fa-calendar"></i> <?= date('d-m-Y', strtotime($item["order_date"])); ?> &nbsp;&nbsp;
                            <i class="fa fa-clock"></i>    <?= date('H:i', strtotime($item["start_time"])); ?>
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
