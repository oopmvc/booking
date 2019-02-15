<?php
require 'includes/connection.php';
include 'classes/user-checked.php';
include 'header.php';
$userType = $_SESSION['type'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {

        // if you dont are admin redirect to index page
        include 'check-role.php';

        // insert query
        $query_create_product = "INSERT INTO products (name, description, time, price) VALUES (:name, :description, :time, :price)";

        // prepare query for execution
        $statement = $pdo->prepare($query_create_product);

        // posted values
        $name = $_POST['name'];
        $description = $_POST['description'];
        $time = $_POST['time'];
        $price = $_POST['price'];

        // bind the parameters
        $statement->bindParam(':name', $name);
        $statement->bindParam(':description', $description);
        $statement->bindParam(':time', $time);
        $statement->bindParam(':price', $price);

        // Execute the query
        if ($statement->execute()) {
            echo "<div class='alert alert-success'>Servizio salvato correttamente!</div>";
        } else {
            echo "<div class='alert alert-danger'>Errore nel salvataggio del servizio.</div>";
        }

    }

    // show error
     catch (PDOException $exception) {
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
                <li class="breadcrumb-item active">Aggiungi Prodotto</li>
            </ol>

            <main role="main" class="">

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input type="text" name="name" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="description">Descrizione</label>
                        <textarea name="description" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="time">Durata</label>
                        <input type="text" name="time" class="form-control input-lg" />
                    </div>
                    <div class="form-group">
                        <label for="price">Prezzo</label>
                        <input type="text" name="price" class="form-control" />
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Salva" class="btn btn-primary" />
                        <a href="product-management.php" class="btn btn-danger">Indietro</a>
                    </div>
                </form>
            </main>
        </div>
    </div>
</div>



<?php include 'footer.php';?>
