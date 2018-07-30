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

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h1>Crea Servizio</h1>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                <label for="name">Nome</label>
                <input type='text' name='name' class='form-control' />

                <label for="">Descrizione</label>
                <textarea name='description' class='form-control'></textarea>

                <label for="">Durata</label>
                <input type='text' name='time' class='form-control' />

                <label for="">Prezzo</label>
                <input type='text' name='price' class='form-control' />

                <input type='submit' value='Salva' class='btn btn-primary' />

                <a href='index.php' class='btn btn-danger'>Annulla</a>
            </form>
        </div>
    </div>
</div>

<?php require('footer.php'); ?>
