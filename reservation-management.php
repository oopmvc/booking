<?php
require('includes/connection.php');
include('classes/user-checked.php');
include('header.php');
?>

<div class="container-fluid">
    <div class="row">

        <?php include(__DIR__.'/templates/dashboard-sidebar.html.php'); ?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Prenotazioni</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <a href="reservation-create.php" class="float-right btn btn-sm btn-success ml-2" type="submit">Aggiungi Prenotazione</a>
                </div>
            </div>

            <div class="table-responsive">

                <!-- <button class="btn btn-sm btn-primary" onclick="sortTable()">Ordina</button> -->

                <table id="myTable" class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th>Data/ora</th>
                            <th>Cliente</th>
                            <th>Collaboratore</th>
                            <th>Persone</th>
                            <th>Stato</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><a href="#">31/08/2018 - 09.30</a></td>
                            <td>Mario Rossi</td>
                            <td>Maurizio P.</td>
                            <td>1</td>
                            <td><i class="fas fa-times"></i> Annullato</td>
                        </tr>
                        <tr>
                            <td><a href="#">21/09/2018 - 10.30</a></td>
                            <td>Mario Rossi</td>
                            <td>Maurizio P.</td>
                            <td>1</td>
                            <td><i class="fas fa-check-circle text-orange"></i> Aperto</td>
                        </tr>
                        <tr>
                            <td><a href="#">21/09/2018 - 11.00</a></td>
                            <td>Cristiano Ronaldo</td>
                            <td>Maurizio P.</td>
                            <td>1</td>
                            <td><i class="fas fa-check-circle"></i> Chiuso</td>
                        </tr>
                    </tbody>
                </table>
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
