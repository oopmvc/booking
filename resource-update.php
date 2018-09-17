<?php
require('includes/connection.php');
include('classes/user-checked.php');
include('header.php');

try {

    $id_resource = $_GET['id_resource'];
    $query = "SELECT * FROM resources WHERE id_resource = :id_resource";
    $statement = $pdo->prepare($query);
    $statement->execute([ ':id_resource' => $id_resource ]);

    // store retrieved row to a variable
    $row = $statement->fetch(PDO::FETCH_OBJ);

    if(isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['description'])) {

        // values to fill up our form
        $first_name  = $_POST['first_name'];
        $last_name   = $_POST['last_name'];
        $description = $_POST['description'];

        $query = "UPDATE resources SET first_name = :first_name, last_name = :last_name, description = :description WHERE id_resource = :id_resource";
        $statement = $pdo->prepare($query);

        if($statement->execute([ ':id_resource' => $id_resource, ':first_name' => $first_name, ':last_name' => $last_name, ':description' => $description ])) {
            echo "<div class='alert alert-success'>Collaboratore modificato correttamente!</div>";
            header('Location: resource-management.php');
        } else {
            echo "<div class='alert alert-danger'>Errore nel salvataggio del Collaboratore.</div>";
        }

    }

}

// show error
catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}

?>



<div class="container-fluid">
    <div class="row">

        <?php include(__DIR__.'/templates/dashboard-sidebar.html.php'); ?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Modifica Collaboratore</h1>
            </div>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id_resource={$id_resource}");?>" method="post">
                <div class="form-group">
                    <label for="first_name">Nome</label>
                    <input type="text" name="first_name" class="form-control" value="<?= $row->first_name; ?>" />
                </div>
                <div class="form-group">
                    <label for="last_name">Cognome</label>
                    <input type="text" name="last_name" class="form-control" value="<?= $row->last_name; ?>" />
                </div>
                <div class="form-group">
                    <label for="description">Descrizione</label>
                    <input type="text" name="description" class="form-control" value="<?= $row->description; ?>" />
                </div>
                <div class="form-group">
                    <input type="submit" value="Salva" class="btn btn-primary" />
                    <a href="resource-management.php" class="btn btn-danger">Torna alla Gestione Collaboratori</a>
                </div>
            </form>
        </main>
    </div>
</div>



<?php include('footer.php'); ?>
