<?php include('header.php'); ?>

<?php

    session_start();
    require("includes/connection.php");

/*
    if(isset($_POST['add_to_cart'])) {
        $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
        if(!in_array($_GET["id"], $item_array_id))
        {
            $count = count($_SESSION["shopping_cart"]);
            $item_array = array(
                'item_id'       => $_GET["id"],
                'item_name'     => $_POST["hidden_name"],
                'item_price'    => $_POST["hidden_price"],
                'item_quantity' => $_POST["quantity"]
            );
            $_SESSION["shopping_cart"][$count] = $item_array;
        }
        else
        {
            echo '<script>alert("Item Already Added")</script>';
            echo '<script>window.location="cart.php"</script>';
        }
    } else {
        items = array (
            'item_id'       => $_GET['id_product'],
            'item_name'     => $_POST['product_name'],
            'item_price'    => $_POST['product_price'],
            'item_quantity' => $_POST['product_quantity']
        );
    }

    if(isset($_GET["action"])) {
        if($_GET["action"] == "delete") {
            foreach($_SESSION["shopping_cart"] as $keys => $values) {
                if($values["item_id"] == $_GET["id"]) {
                    unset($_SESSION["shopping_cart"][$keys]);
                    echo '<script>alert("Item Removed")</script>';
                    echo '<script>window.location="index.php"</script>';
                }
            }
        }
    }
*/
?>

<div class="container">
    <div class="row">
        <div class="col-lg-9">
            <h1 class="pt-4">Gestione Prodotti</h1>
            <p class="lead mb-5">In questa pagina puoi aggiungere, modificare, eliminare i tuoi prodotti.</p>
        </div>
        <div class="col-lg-3">
            <a href="product-create.php" class="float-right mt-4 mb-5 btn btn btn-primary" type="submit">Aggiungi Prodotto</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 order-md-1">
            <form action="" class="needs-validation" novalidate>
                <?php
                    // Include config file
                    require_once 'includes/connection.php';
                    // Attempt select query execution
                    $sql = "SELECT * FROM products ORDER BY name";
                    if($result = $pdo->query($sql)){
                        if($result->rowCount() > 0){
                            echo "<table class='table'>";
                            echo "<thead>";
                                echo "<td>Nome</td>";
                                echo "<td>Descrizione</td>";
                                echo "<td>Durata</td>";
                                echo "<td>Prezzo</td>";
                                echo "<td>Azioni</td>";
                            echo "</thead>";
                            echo "<tbody>";
                                while($row = $result->fetch()) {
                                    echo "<tr>";
                                        echo "<td>" . $row['name']          . "</td>";
                                        echo "<td>" . $row['description']   . "</td>";
                                        echo "<td>" . $row['time']          . "</td>";
                                        echo "<td>" . $row['price']         . "</td>";
                                        echo "<td>
                                                <!--<a class='btn btn-sm btn-success' href='product-read.php?id="           . $row['id_product'] ."' title='Apri Prodotto'     data-toggle='tooltip'>Apri</a>-->
                                                <a class='btn btn-sm btn-primary'     href='product-update.php?id_product=" . $row['id_product'] ."' title='Modifica Prodotto' data-toggle='tooltip'>Modifica</a>
                                                <a class='btn btn-sm btn-danger'      href='product-delete.php?id_product=" . $row['id_product'] ."' title='Elimina Prodotto'  data-toggle='tooltip'>Elimina</a>
                                            </td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";
                            echo "</table>";
                            // Free result set
                            unset($result);
                        } else {
                            echo "<p class='lead'><em>Nessun servizio trovato.</em></p>";
                        }
                    } else {
                        echo "ERRORE: Non posso eseguire la richiesta $sql. " . mysqli_error($link);
                    }
                    // Close connection
                    // mysqli_close($link);
                ?>

            </form>
        </div>


    </div>
</div>

<?php include('footer.php'); ?>
