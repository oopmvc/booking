<?php
require('includes/connection.php');
include('classes/user-checked.php');
include('header.php');

if($_SERVER['REQUEST_METHOD'] == 'POST') {

    try {

        // insert query
        $query = "INSERT INTO slot_time (start_slot, end_slot, sunday, monday, tuesday, wednesday, thursday, friday, saturday) VALUES (:start_slot, :end_slot, :sunday, :monday, :tuesday, :wednesday, :thursday, :friday, :saturday)";

        // prepare query for execution
        $statement = $pdo->prepare($query);

        // posted values
        $start_slot = $_POST['start_slot'];
        $end_slot   = $_POST['end_slot'];
        $sunday     = isset($_POST['sunday'])       ? '1' : '0' ;
        $monday     = isset($_POST['monday'])       ? '1' : '0' ;
        $tuesday    = isset($_POST['tuesday'])      ? '1' : '0' ;
        $wednesday  = isset($_POST['wednesday'])    ? '1' : '0' ;
        $thursday   = isset($_POST['thursday'])     ? '1' : '0' ;
        $friday     = isset($_POST['friday'])       ? '1' : '0' ;
        $saturday   = isset($_POST['saturday'])     ? '1' : '0' ;

        // bind the parameters
        $statement->bindParam(':start_slot',$start_slot);
        $statement->bindParam(':end_slot',  $end_slot);
        $statement->bindParam(':sunday',    $sunday);
        $statement->bindParam(':monday',    $monday);
        $statement->bindParam(':tuesday',   $tuesday);
        $statement->bindParam(':wednesday', $wednesday);
        $statement->bindParam(':thursday',  $thursday);
        $statement->bindParam(':friday',    $friday);
        $statement->bindParam(':saturday',  $saturday);

        // Execute the query
        if($statement->execute()) {
            echo "<div class='alert alert-success'>Orario di apertura salvato correttamente!</div>";
        } else {
            echo "<div class='alert alert-danger'>Errore nel salvataggio dell'orario di apertura.</div>";
        }

    }

    // show error
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }

}

?>



<div class="container-fluid">
    <div class="row">

        <?php include(__DIR__.'/templates/dashboard-sidebar.html.php'); ?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Nuova Prenotazione</h1>
            </div>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                <div class="form-group">
                    <label for="start">Con chi?</label>
                    <?php

                    // Attempt select query execution
                    $sql_resource = "SELECT * FROM resources";

                    if($result_resource = $pdo->query($sql_resource)) {
                        if($result_resource->rowCount() > 0) {
                            echo "<select class='custom-select d-block w-100' id='resource' required>";
                            while($row_resources = $result_resource->fetch()){
                                echo "<option value='" . $row_resources['first_name'] . ' ' . $row_resources['last_name'] .  "'>" . $row_resources['first_name'] . ' ' . $row_resources['last_name'] . "</option>";
                            }
                            echo "</select>";

                            // Free result set
                            unset($row_resource);
                        } else {
                            echo "<p class='lead'><em>Nessun collaboratore trovato.</em></p>";
                        }
                    } else {
                        echo "ERROR: Non posso eseguire la richiesta $sql_resource. " . mysqli_error($link);
                    }

                    // Close connection
                    unset($pdo);
                    ?>
                </div>
                <div class="form-group">
                    <label for="start">Quando?</label><br>
                    <input type="text" id="datepicker" class="form-control">
                </div>
                <div class="form-group">
                    <label for="start">A che ora?</label>
                    <select class="form-control" id="slot_time" name="slot_time">
                        <?php include('opening-time-hour.php'); ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="start">Cliente</label>
                    <input type="text" id="customer" class="form-control">
                </div>
                <div class='table-responsive'>
                    <table class='table table-striped table-md'>
                        <thead>
                            <tr>
                                <th>Prodotto</th>
                                <th>Quantità</th>
                                <th>Prezzo</th>
                                <th>Totale</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="form-group">
                    <input type="submit" value="Salva" class="btn btn-primary" />
                    <a href="opening-time-management.php" class="btn btn-danger">Indietro</a>
                </div>
            </form>
        </main>
    </div>
</div>



<!--
<div class="container">
    <h2>Basic Inline Calendar</h2>
    <div class="row">
        <div class="col-xss-4">
            <div id="basic" data-toggle="calendar"></div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-xss-4">
            <div id="glob-data" data-toggle="calendar"></div>
        </div>

    </div>

    <hr>
    <div class="row">
        <div class="col-xss-4">
            <div id="custom-first-day" data-toggle="calendar"></div>
        </div>
    </div>

    <hr>
    <div class="row">
        <div class="col-xss-4">
            <div id="custom-name" data-toggle="calendar"></div>
        </div>
    </div>

    <hr>
    <div class="row">
        <div class="col-xss-12">
            <div id="show-next-month" data-toggle="calendar"></div>
        </div>
    </div>
    <hr>
</div>

<script type="text/javascript" src="scripts/components/jquery.min.js"></script>
<script type="text/javascript" src="scripts/dateTimePicker.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {

    $('#basic').calendar();
    $('#glob-data').calendar({
        unavailable: ['*-*-8', '*-*-10']
    });

    $('#custom-first-day').calendar({
        day_first: 2,
        unavailable: ['2014-07-10'],
        onSelectDate: function(date, month, year) {
            alert([year, month, date].join('-') + ' is: ' + this.isAvailable(date, month, year));
        }
    });

    $('#custom-name').calendar({
        day_name: ['L', 'M', 'M', 'G', 'V', 'S', 'D'],
        month_name: ['Gen','Feb','Mar','Apr','Giu','Lug','Ago','Set','Ott','Nov','Dic'],
        unavailable: ['2014-07-10']
    });

    $('#dynamic-data').calendar({
        adapter: 'server/adapter.php'
    });

    $('#show-next-month').calendar({
        num_next_month: 1,
        num_prev_month: 1,
        unavailable: ['*-*-9', '*-*-10']
    });
});
</script>
-->



<?php include('footer.php'); ?>
