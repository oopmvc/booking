<?php
require("includes/connection.php");
include('classes/user-checked.php');
include('header.php');
?>

<div id="wrapper">

    <?php include(__DIR__ . '/templates/dashboard-sidebar.html.php'); ?>

    <div id="content-wrapper">

        <div class="container-fluid">

            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item active">Clienti</li>
            </ol>

            <main role="main">

            <?php

                // Attempt select query execution
                $sql = "SELECT * FROM members ORDER BY last_name ASC, first_name ASC;";
                if($result = $pdo->query($sql)){
                    if($result->rowCount() > 0){
                        echo
                            "<div class='table-responsive'>
                                <table class='table table-striped table-sm'>
                                    <thead>
                                        <tr>
                                            <th>Nome utente</th>
                                            <th>Cognome</th>
                                            <th>Nome</th>
                                            <th>E-mail</th>
                                            <th>Cellulare</th>
                                            <th>Indirizzo</th>
                                            <th>CAP</th>
                                            <th>Città</th>
                                            <th>Nazione</th>
                                            <th>Attivo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                            ";

                        while($row = $result->fetch()) {
                            echo "<tr>";
                            echo "<td>" . $row['username']   . "</td>";
                            echo "<td>" . $row['last_name']  . "</td>";
                            echo "<td>" . $row['first_name'] . "</td>";
                            echo "<td>" . $row['email']      . "</td>";
                            echo "<td>" . $row['phone']      . "</td>";
                            echo "<td>" . $row['address']    . "</td>";
                            echo "<td>" . $row['postal_code']. "</td>";
                            echo "<td>" . $row['city']       . "</td>";
                            echo "<td>" . $row['country']    . "</td>";
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
</div>



<?php include('footer.php'); ?>
