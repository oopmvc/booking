<?php
require('includes/connection.php');
include('classes/user-checked.php');
include('header.php');

if($_SERVER['REQUEST_METHOD'] == 'POST') {

    try {

        // insert query
        $query_create_product = "INSERT INTO products (name, description, time, price) VALUES (:name, :description, :time, :price)";

        // prepare query for execution
        $statement = $pdo->prepare($query_create_product);

        // posted values
        $name           = $_POST['name'];
        $description    = $_POST['description'];
        $time           = $_POST['time'];
        $price          = $_POST['price'];

        // bind the parameters
        $statement->bindParam(':name', $name);
        $statement->bindParam(':description', $description);
        $statement->bindParam(':time', $time);
        $statement->bindParam(':price', $price);

        // Execute the query
        if($statement->execute()){
            echo "<div class='alert alert-success'>Servizio salvato correttamente!</div>";
        } else {
            echo "<div class='alert alert-danger'>Errore nel salvataggio del servizio.</div>";
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
                <h1 class="h2">Aggiungi Prodotto</h1>
            </div>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
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



<?php include('footer.php'); ?>
