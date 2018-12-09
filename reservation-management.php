<?php
require('includes/connection.php');
include('classes/user-checked.php');
include('header.php');
?>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Order details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modalBodyContainer"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<div class="container-fluid">
    <div class="row">

        <?php
        include(__DIR__ . '/templates/dashboard-sidebar.html.php'); ?>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <?php if ($_SESSION['type'] == 1): ?>
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Prenotazioni</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <a href="reservation-create.php" class="float-right btn btn-sm btn-success ml-2" type="submit">
                            Aggiungi Prenotazione</a>
                    </div>
                </div>
            <?php endif; ?>

            <div class="table-responsive">
                <?php

                $type = $_SESSION['type'];
                $sql_resource = "SELECT * FROM orders 
                                left JOIN  resources on (orders.resource = resources.id_resource)
                                ";

                $sql_resource .= ($type != 1) ? " where customer = " . $_SESSION['memberID'] : "";

                if ($result_resource = $pdo->prepare($sql_resource)) {
                    ($result_resource->execute());
                    $result = ($result_resource->fetchAll());
//                    var_dump($result[20]);
                    ?>
                    <table id="myTable" class="table table-striped table-sm">
                        <thead>
                        <tr>
                            <th>Data/ora</th>
                            <th>Cliente</th>
                            <th>Collaboratore</th>
                            <th>Stato</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($result as $item):
                            ?>
                            <tr>
                                <td><a><i class="fa  fa-calendar"></i> <?= $item["order_date"] ?> &nbsp;&nbsp; <i
                                                class="fa  fa-clock"></i> <?= date('g:ia', strtotime($item["start_time"])) ?>
                                    </a></td>
                                <td>Mario Rossi</td>
                                <td><?= $item['first_name'] . " " . $item['last_name']; ?></td>
                                <td>
                                    <i class="fas fa-times"></i> Annullato |
                                    <span data-toggle="modal" data-target="#exampleModal"
                                          onclick="getOrderDetails(<?php echo $item['id_order'] ?> ,
                                                  '<?php echo $item["first_name"] ." ". $item["last_name"]    ?>')">
                                    <i class="fa fa-info"></i> Details</span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php
                } else {
                    echo "No record to display";
                }
                ?>
            </div>
        </main>
    </div>
</div>

<!-- <script type="text/javascript">

function sortTable() {
    var table, rows, switching, i, x, y, shouldSwitch;
    var date = 0;
    var member = 1;
    var resource = 2;

    table = document.getElementById("myTable");
    switching = true;
    /*Make a loop that will continue until
    no switching has been done:*/
    while (switching) {
        //start by saying: no switching is done:
        switching = false;
        rows = table.rows;
        /*Loop through all table rows (except the
        first, which contains table headers):*/
        for (i = 1; i < (rows.length - 1); i++) {
            //start by saying there should be no switching:
            shouldSwitch = false;
            /*Get the two elements you want to compare,
            one from current row and one from the next:*/
            x = rows[i].getElementsByTagName("TD")[date];
            y = rows[i + 1].getElementsByTagName("TD")[date];
            //check if the two rows should switch place:
            if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                //if so, mark as a switch and break the loop:
                shouldSwitch = true;
                break;
            }
        }
        if (shouldSwitch) {
            /*If a switch has been marked, make the switch
            and mark that a switch has been done:*/
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
        }
    }
}
</script> -->

<?php include('footer.php'); ?>