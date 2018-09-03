<?php require('header.php'); ?>

<?php

    session_start();
    require("includes/connection.php");

    try {

        $id_product = $_GET['id_product'];
        $query = "DELETE FROM products WHERE id_product = :id_product";
        $statement = $pdo->prepare($query);
        $statement->execute([ ':id_product' => $id_product ]);

        header("location: product-management.php");
        

        // if(isset($_POST['name']) && isset($_POST['description']) && isset($_POST['time']) && isset($_POST['price'])) {
        //
        //     // values to fill up our form
        //     $name           = $_POST['name'];
        //     $description    = $_POST['description'];
        //     $time           = $_POST['time'];
        //     $price          = $_POST['price'];
        //
        //     $query = "UPDATE products SET name = :name, description = :description, time = :time, price = :price WHERE id_product = :id_product";
        //     $statement = $pdo->prepare($query);
        //
        //     if($statement->execute([ ':id_product' => $id_product, ':name' => $name, ':description' => $description, ':time' => $time, ':price' => $price ])) {
        //         echo "<div class='alert alert-success'>Prodotto modificato correttamente!</div>";
        //         //die();
        //         header("location: product-management.php");
        //     } else {
        //         echo "<div class='alert alert-danger'>Errore nel salvataggio del servizio.</div>";
        //     }
        //
        // }

    }

    // show error
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }

?>
