<?php
require('includes/connection.php');
include('classes/user-checked.php');
include('header.php');
?>

<div class="container-fluid">
    <div class="row">

        <?php include(__DIR__ . '/templates/dashboard-sidebar.html.php'); ?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Prodotti</h1>
                <a href="product-create.php" class="float-right btn btn btn-success" type="submit">Aggiungi Prodotto</a>
            </div>

            <form class="needs-validation" novalidate>
                <?php
                // Include config file
                require_once 'includes/connection.php';
                // Attempt select query execution
                $sql = "SELECT * FROM products ORDER BY name";
                if ($result = $pdo->query($sql)) {
                    if ($result->rowCount() > 0) {
                        echo
                        "<div class='table-responsive'>
                                    <table class='table table-striped table-sm'>
                                        <thead>
                                            <tr>
                                                <th>Nome Prodotto</th>
                                                <th class='col-50'>Descrizione</th>
                                                <th class='text-right'>Tempo</th>
                                                <th class='text-right'>Prezzo</th>
                                                <th class='text-center'>Azione</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                ";

                        while ($row = $result->fetch()) {
                            echo "<tr>";
                            echo "<td>" . $row['name'] . "</td>";
                            echo "<td>" . $row['description'] . "</td>";
                            echo "<td class='text-right'>" . $row['time'] . " minuti</td>";
                            echo "<td class='text-right'>" . $row['price'] . " €</td>";
                            echo "<td class='text-center'>
                                        <a class='btn btn-sm btn-primary'     href='product-update.php?id_product=" . $row['id_product'] . "' title='Modifica Prodotto' data-toggle='tooltip'>Modifica</a>
                                        <a class='btn btn-sm btn-danger'      href='product-delete.php?id_product=" . $row['id_product'] . "' title='Elimina Prodotto'  data-toggle='tooltip'>Elimina</a>
                                    </td>";
                            echo "</tr>";
                        }
                        echo "
                                </tbody>
                            </table>";
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
        </main>
    </div>
</div>


<?php include('footer.php'); ?>
