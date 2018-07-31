<?php require('header.php'); ?>

<?php

    session_start();
    require("includes/connection.php");

    if($_SERVER["REQUEST_METHOD"] == "POST") {

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

<div class="container mt-3 mb-5">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="pt-3">Aggiungi Prodotto</h2>
            <hr>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                <div class="form-group">
                    <label for="name">Nome</label>
                    <input type="text" name="name" class="form-control" />
                </div>
                <div class="form-group">
                    <label for="">Descrizione</label>
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
                </div>
                <div class="form-group">
                    <input type="submit" value="Salva" class="btn btn-primary" />
                    <a href="index.php" class="btn btn-danger">Torna alla pagina iniziale</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require('footer.php'); ?>
