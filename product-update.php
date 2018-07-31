<?php require('header.php'); ?>

<?php

    session_start();
    require("includes/connection.php");

    try {

        $id_product = $_GET['id_product'];
        $query = "SELECT * FROM products WHERE id_product = :id_product";
        $statement = $pdo->prepare($query);
        $statement->execute([ ':id_product' => $id_product ]);

        // store retrieved row to a variable
        $row = $statement->fetch(PDO::FETCH_OBJ);

        if(isset($_POST['name']) && isset($_POST['description']) && isset($_POST['time']) && isset($_POST['price'])) {

            // values to fill up our form
            $name           = $_POST['name'];
            $description    = $_POST['description'];
            $time           = $_POST['time'];
            $price          = $_POST['price'];

            $query = "UPDATE products SET name = :name, description = :description, time = :time, price = :price WHERE id_product = :id_product";
            $statement = $pdo->prepare($query);

            if($statement->execute([ ':id_product' => $id_product, ':name' => $name, ':description' => $description, ':time' => $time, ':price' => $price ])) {
                echo "<div class='alert alert-success'>Prodotto modificato correttamente!</div>";
                //die();
                header("location: product-management.php");
            } else {
                echo "<div class='alert alert-danger'>Errore nel salvataggio del servizio.</div>";
            }

        }

    }

    // show error
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }

?>

<div class="container mt-3 mb-5">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="pt-3">Modifica Prodotto</h2>
            <hr>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id_product={$id_product}");?>" method="post">
                <div class="form-group">
                    <label for="name">Nome</label>
                    <input type="text" name="name" class="form-control" value="<?= $row->name; ?>" />
                </div>
                <div class="form-group">
                    <label for="description">Descrizione</label>
                    <textarea name="description" class="form-control"><?= $row->description; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="time">Durata</label>
                    <input type="text" name="time" class="form-control input-lg" value="<?= $row->time; ?>"/>
                </div>
                <div class="form-group">
                    <label for="price">Prezzo</label>
                    <input type="text" name="price" class="form-control" value="<?= $row->price; ?>"/>
                </div>
                <div class="form-group">
                </div>
                <div class="form-group">
                    <input type="submit" value="Salva" class="btn btn-primary" />
                    <a href="product-management.php" class="btn btn-danger">Torna alla Gestione Prodotti</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require('footer.php'); ?>
