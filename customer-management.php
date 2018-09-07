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
                <h1 class="h2">Clienti</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group mr-2">
                        <button class="btn btn-sm btn-outline-secondary">Esporta</button>
                    </div>
                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
                        <span data-feather="calendar"></span>
                        Questa settimana
                    </button>
                </div>
            </div>

            <?php
                // Include config file
                require_once 'includes/connection.php';
                // Attempt select query execution
                $sql = "SELECT * FROM members ORDER BY email";
                if($result = $pdo->query($sql)){
                    if($result->rowCount() > 0){
                        echo
                            "<div class='table-responsive'>
                                <table class='table table-striped table-sm'>
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nome utente</th>
                                            <th>Nome</th>
                                            <th>Cognome</th>
                                            <th>E-mail</th>
                                            <th>Cellulare</th>
                                            <th>Attivo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                            ";

                        while($row = $result->fetch()) {
                            echo "<tr>";
                            echo "<td>" . $row['memberID']   . "</td>";
                            echo "<td>" . $row['username']   . "</td>";
                            echo "<td>" . $row['first_name'] . "</td>";
                            echo "<td>" . $row['last_name']  . "</td>";
                            echo "<td>" . $row['email']      . "</td>";
                            echo "<td>" . $row['phone']      . "</td>";
                            if($row['active'] != null) {
                                echo "<td>Si</td>";
                            } else {
                                echo "<td>No</td>";
                            }
                            echo "</tr>";
                        }
                        echo "
                            </tbody>
                        </table>";
                        // Free result set
                        unset($result);
                    } else {
                        echo "<p class='lead'><em>Nessun cliente trovato.</em></p>";
                    }
                } else {
                    echo "ERRORE: Non posso eseguire la richiesta $sql. " . mysqli_error($link);
                }
                // Close connection
                // mysqli_close($link);
            ?>

        </main>
    </div>
</div>



<?php include('footer.php'); ?>
