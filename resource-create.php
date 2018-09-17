<?php

require('includes/connection.php');
include('classes/user-checked.php');
include('header.php');

if($_SERVER["REQUEST_METHOD"] == "POST") {

    try {

        // insert query
        $query_create_resource = "INSERT INTO resources (first_name, last_name, description) VALUES (:first_name, :last_name, :description)";

        // prepare query for execution
        $statement = $pdo->prepare($query_create_resource);

        // posted values
        $first_name  = $_POST['first_name'];
        $last_name   = $_POST['last_name'];
        $description = $_POST['description'];

        // bind the parameters
        $statement->bindParam(':first_name', $first_name);
        $statement->bindParam(':last_name', $last_name);
        $statement->bindParam(':description', $description);

        // Execute the query
        if($statement->execute()) {
            echo "<div class='alert alert-success'>Collaboratore aggiunto correttamente!</div>";
        } else {
            echo "<div class='alert alert-danger'>Errore nel salvataggio del Collaboratore.</div>";
        }

    }

    // show error
    catch(PDOException $exception) {
        die('ERROR: ' . $exception->getMessage());
    }

}

?>



<div class="container-fluid">
    <div class="row">

        <?php include('dashboard-sidebar.php'); ?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Aggiungi Collaboratore</h1>
            </div>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                <div class="form-group">
                    <label for="first_name">Nome</label>
                    <input type="text" name="first_name" class="form-control" />
                </div>
                <div class="form-group">
                    <label for="last_name">Cognome</label>
                    <input type="text" name="last_name" class="form-control" />
                </div>
                <div class="form-group">
                    <label for="">Descrizione</label>
                    <textarea name="description" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" value="Salva" class="btn btn-primary" />
                    <a href="resource-management.php" class="btn btn-danger">Torna alla Gestione Staff</a>
                </div>
            </form>
        </main>
    </div>
</div>



<?php include('footer.php'); ?>
