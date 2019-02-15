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



<div id="wrapper">

    <?php include(__DIR__ . '/templates/dashboard-sidebar.html.php'); ?>

    <div id="content-wrapper">

        <div class="container-fluid">

            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item active">Nuovo Orario di Apertura</li>
            </ol>

            <main role="main" class="">

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                    <div class="form-group">
                        <label for="start">Inizio</label>
                        <select class="form-control" id="start_slot" name="start_slot">
                            <?php include('opening-time-hour.php'); ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="end">Fine</label>
                        <select class="form-control" id="end_slot" name="end_slot">
                            <?php include('opening-time-hour.php'); ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="sunday" name="sunday">
                            <label class="form-check-label" for="sunday">Domenica</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="monday" name="monday">
                            <label class="form-check-label" for="monday">Lunedì</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="tuesday" name="tuesday">
                            <label class="form-check-label" for="tuesday">Martedì</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="wednesday" name="wednesday">
                            <label class="form-check-label" for="wednesday">Mercoledì</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="thursday" name="thursday">
                            <label class="form-check-label" for="thursday">Giovedì</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="friday" name="friday">
                            <label class="form-check-label" for="friday">Venerdì</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="saturday" name="saturday">
                            <label class="form-check-label" for="saturday">Sabato</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Salva" class="btn btn-primary" />
                        <a href="opening-time-management.php" class="btn btn-danger">Indietro</a>
                    </div>
                </form>

            </main>

        </div>
    </div>
</div>



<?php include('footer.php'); ?>
