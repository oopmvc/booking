<?php

require('includes/connection.php');
include('classes/user-checked.php');
include('header.php');

try {

    $id_slot_time = $_GET['id_slot_time'];
    $query = "SELECT * FROM slot_time WHERE id_slot_time = :id_slot_time";
    $statement = $pdo->prepare($query);
    $statement->execute([ ':id_slot_time' => $id_slot_time ]);

    // store retrieved row to a variable
    $row = $statement->fetch(PDO::FETCH_OBJ);

    if(isset($_POST['start_slot']) && isset($_POST['end_slot'])) {

        // values to fill up our form
        $start_slot = $_POST['start_slot'];
        $end_slot   = $_POST['end_slot'];
        $sunday     = isset($_POST['sunday'])       ? '1' : '0' ;
        $monday     = isset($_POST['monday'])       ? '1' : '0' ;
        $tuesday    = isset($_POST['tuesday'])      ? '1' : '0' ;
        $wednesday  = isset($_POST['wednesday'])    ? '1' : '0' ;
        $thursday   = isset($_POST['thursday'])     ? '1' : '0' ;
        $friday     = isset($_POST['friday'])       ? '1' : '0' ;
        $saturday   = isset($_POST['saturday'])     ? '1' : '0' ;

        $query = "UPDATE slot_time SET start_slot = :start_slot, end_slot = :end_slot, sunday = :sunday, monday = :monday, tuesday = :tuesday, wednesday = :wednesday, thursday = :thursday, friday = :friday, saturday = :saturday WHERE id_slot_time = :id_slot_time";
        $statement = $pdo->prepare($query);

        if($statement->execute([
            ':id_slot_time' => $id_slot_time,
            ':start_slot'   => $start_slot,
            ':end_slot'     => $end_slot,
            ':sunday'       => $sunday,
            ':monday'       => $monday,
            ':tuesday'      => $tuesday,
            ':wednesday'    => $wednesday,
            ':thursday'     => $thursday,
            ':friday'       => $friday,
            ':saturday'     => $saturday,
            ])) {

            echo "<div class='alert alert-success'>Orario di apertura modificato correttamente!</div>";
            header('Refresh: 0; url=./opening-time-management.php');

        } else {
            echo "<div class='alert alert-danger'>Errore nel salvataggio dell'orario di apertura.</div>";
        }

    }

}

// show error
catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}

?>



<div id="wrapper">

    <?php include(__DIR__ . '/templates/dashboard-sidebar.html.php'); ?>

    <div id="content-wrapper">

        <div class="container-fluid">

            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item active">Modifica Prodotto</li>
            </ol>

            <main role="main" class="">

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id_slot_time={$id_slot_time}");?>" method="post">
                    <div class="form-group">
                        <label for="name">Ora Inizio</label>
                        <input type="text" name="start_slot" class="form-control" value="<?= $row->start_slot; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="name">Ora Fine</label>
                        <input type="text" name="end_slot" class="form-control" value="<?= $row->end_slot; ?>" />
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="<?php
                                if($row->sunday) { echo '1' . $row->sunday; } else { echo '0'; } ?>" id="sunday" name="sunday" <?php if($row->sunday == '1') { echo 'checked'; } ?>>
                            <label class="form-check-label" for="sunday">Domenica</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="<?= $row->monday; ?>" id="monday" name="monday" <?php if($row->monday == '1') { echo 'checked'; } ?>>
                            <label class="form-check-label" for="monday">Lunedì</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="<?= $row->tuesday; ?>" id="tuesday" name="tuesday" <?php if($row->tuesday == '1') { echo 'checked'; } ?>>
                            <label class="form-check-label" for="tuesday">Martedì</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="<?= $row->wednesday; ?>" id="wednesday" name="wednesday" <?php if($row->wednesday == '1') { echo 'checked'; } ?>>
                            <label class="form-check-label" for="wednesday">Mercoledì</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="<?= $row->thursday; ?>" id="thursday" name="thursday" <?php if($row->thursday == '1') { echo 'checked'; } ?>>
                            <label class="form-check-label" for="thursday">Giovedì</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="<?= $row->friday; ?>" id="friday" name="friday"<?php if($row->friday == '1') { echo 'checked'; } ?>>
                            <label class="form-check-label" for="friday">Venerdì</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="<?= $row->saturday; ?>" id="saturday" name="saturday" <?php if($row->saturday == '1') { echo 'checked'; } ?>>
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
