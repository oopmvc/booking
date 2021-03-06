<?php
require('includes/connection.php');
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
                <li class="breadcrumb-item active">Staff</li>
                <li class="breadcrumb-item"><a href="resource-create.php">Aggiungi Collaboratore</a></li>
            </ol>

            <main role="main">

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
</div>



<?php include('footer.php'); ?>
