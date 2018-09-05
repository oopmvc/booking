<?php
    include('header.php');
    require("includes/connection.php");
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
                                echo "<td class='text-right'>Durata</td>";
                                echo "<td class='text-right'>Prezzo</td>";
                                echo "<td class='text-center'>Azioni</td>";
                            echo "</thead>";
                            echo "<tbody>";
                                while($row = $result->fetch()) {
                                    echo "<tr>";
                                        echo "<td>" . $row['name']          . "</td>";
                                        echo "<td>" . $row['description']   . "</td>";
                                        echo "<td class='text-right'>" . $row['time']          . "</td>";
                                        echo "<td class='text-right'>" . $row['price']         . " €</td>";
                                        echo "<td class='text-center'>
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
