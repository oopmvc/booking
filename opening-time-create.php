<?php
require('includes/connection.php');
include('header.php');

if($_SERVER['REQUEST_METHOD'] == 'POST') {

    try {

        // insert query
        $query = "INSERT INTO slot_time (day, start, end) VALUES (:day, :start, :end)";

        // prepare query for execution
        $statement = $pdo->prepare($query);

        // posted values
        $day    = $_POST['day'];
        $start  = $_POST['start'];
        $end    = $_POST['end'];

        // bind the parameters
        $statement->bindParam(':day',   $day);
        $statement->bindParam(':start', $start);
        $statement->bindParam(':end',   $end);

        // Execute the query
        if($statement->execute()){
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
                <h1 class="h2">Nuovo Orario di Apertura</h1>
            </div>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                <div class="form-group">
                    <label for="day">Giorno</label>
                    <select class="form-control" id="day">
                        <option disabled selected>-</option>
                        <option value="0">Domenica</option>
                        <option value="1">Lunedì</option>
                        <option value="2">Martedì</option>
                        <option value="3">Mercoledì</option>
                        <option value="4">Giovedì</option>
                        <option value="5">Venerdì</option>
                        <option value="6">Sabato</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="start">Inizio</label>
                    <select class="form-control" id="start">
                        <?php include('opening-time-hour.php'); ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="end">Fine</label>
                    <select class="form-control" id="end">
                        <?php include('opening-time-hour.php'); ?>
                    </select>
                </div>
                <div class="form-group">
                    <input type="submit" value="Salva" class="btn btn-primary" />
                    <a href="opening-time-management.php" class="btn btn-danger">Indietro</a>
                </div>
            </form>
        </main>
    </div>
</div>



<?php include('footer.php'); ?>
