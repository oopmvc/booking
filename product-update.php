<?php require('header.php'); ?>

<?php

    session_start();
    require("includes/connection.php");

    if(isset($_POST["id_product"]) && !empty($_POST["id_product"])) {

        try {

            // Get hidden input value
            $id_product = $_POST["id_product"];

            // insert query
            $query_update_product = "UPDATE products SET name=:name, description=:description, time=:time, price=:price) WHERE id_product=:id_product";

            // prepare query for execution
            $statement = $pdo->prepare($query_update_product);

            // bind the parameters
            $statement->bindParam(':id_product',    $param_id);
            $statement->bindParam(':name',          $param_name);
            $statement->bindParam(':description',   $param_description);
            $statement->bindParam(':time',          $param_time);
            $statement->bindParam(':price',         $param_price);

            // Set parameters
            $param_id             = $id_product;
            $param_name           = $name;
            $param_description    = $description;
            $param_time           = $time;
            $param_price          = $price;

            // Execute the query
            if($statement->execute()){
                header("location: product-management.php");
            } else {
                echo "<div class='alert alert-danger'>Errore nella modifica del prodotto.</div>";
            }

            // Close statement

            unset($statement);

        }


        // show error
        catch(PDOException $exception){
            die('ERROR: ' . $exception->getMessage());
        }

    }

?>

<div class="container mt-3 mb-5">
    <div class="row">
        <div class="col-lg-8">
            <h2 class="pt-3">Modifica Prodotto</h2>
            <hr>
            <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                <div class="form-group">
                    <label for="name">Nome</label>
                    <input type="text" name="name" class="form-control" value="<?php echo $name; ?>"/>
                </div>
                <div class="form-group">
                    <label for="">Descrizione</label>
                    <textarea name="description" class="form-control"><?php echo $description; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="time">Durata</label>
                    <input type="text" name="time" class="form-control input-lg" value="<?php echo $time; ?>"/>
                </div>
                <div class="form-group">
                    <label for="price">Prezzo</label>
                    <input type="text" name="price" class="form-control" value="<?php echo $price; ?>"/>
                </div>
                <div class="form-group">
                </div>
                <div class="form-group">
                    <input type="submit" value="Salva" class="btn btn-primary" />
                    <a href="product-management.php" class="btn btn-danger">Torna alla pagina iniziale</a>
                </div>
            </form>
        </div>
        <div class="col-lg-4">
            <h2 class="pt-3">Servizi</h2>
            <hr>
        </div>
    </div>
</div>

<?php require('footer.php'); ?>
