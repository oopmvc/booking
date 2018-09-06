<?php
session_start();
include('header.php');
require("includes/connection.php");
?>



<div class="container-fluid">
    <div class="row">

        <?php include('dashboard-sidebar.php'); ?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Staff</h1>
                <a href="resource-create.php" class="float-right btn btn btn-success" type="submit">Aggiungi Collaboratore</a>
            </div>

            <form class="needs-validation" novalidate>
                <?php
                    // Include config file
                    require_once 'includes/connection.php';
                    // Attempt select query execution
                    $sql = "SELECT * FROM resources ORDER BY id_resource";
                    if($result = $pdo->query($sql)){
                        if($result->rowCount() > 0){
                            echo
                                "<div class='table-responsive'>
                                    <table class='table table-striped table-sm'>
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nome</th>
                                                <th>Cognome</th>
                                                <th>Descrizione</th>
                                                <th class='text-center'>Azione</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                ";

                            while($row = $result->fetch()) {
                                echo "<tr>";
                                echo "<td>" . $row['id_resource'] . "</td>";
                                echo "<td>" . $row['first_name'] . "</td>";
                                echo "<td>" . $row['last_name'] . "</td>";
                                echo "<td>" . $row['description']. "</td>";
                                echo "<td class='text-center'>
                                        <a class='btn btn-sm btn-primary'     href='resource-update.php?id_resource=" . $row['id_resource'] ."' title='Modifica Collaboratore' data-toggle='tooltip'>Modifica</a>
                                        <a class='btn btn-sm btn-danger'      href='resource-delete.php?id_resource=" . $row['id_resource'] ."' title='Elimina Collaboratore'  data-toggle='tooltip'>Elimina</a>
                                    </td>";
                                echo "</tr>";
                            }
                            echo "
                                </tbody>
                            </table>";
                            // Free result set
                            unset($result);
                        } else {
                            echo "<p class='lead'><em>Nessun collaboratore trovato.</em></p>";
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