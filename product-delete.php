<?php

require("includes/connection.php");

try {

    $id_product = $_GET['id_product'];
    $query = "DELETE FROM products WHERE id_product = :id_product";
    $statement = $pdo->prepare($query);
    $statement->execute([ ':id_product' => $id_product ]);

    header("location: product-management.php");

}

// show error
catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}

?>
