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
                <li class="breadcrumb-item active">Orari Apertura</li>
                <li class="breadcrumb-item"><a href="opening-time-create.php">Aggiungi Orari di Apertura</a></li>
            </ol>

            <main role="main" class="">

                <form class="needs-validation" novalidate>
                    <?php
                        // Attempt select query execution
                        $sql = "SELECT * FROM slot_time ORDER BY start_slot ASC";
                        if($result = $pdo->query($sql)) {
                            if($result->rowCount() > 0) {
                                echo
                                    "<div class='table-responsive'>
                                        <table class='table table-striped table-sm'>
                                            <thead>
                                                <tr>
                                                    <th>Ora Inizio</th>
                                                    <th>Ora Fine</th>
                                                    <th>DOM</th>
                                                    <th>LUN</th>
                                                    <th>MAR</th>
                                                    <th>MER</th>
                                                    <th>GIO</th>
                                                    <th>VEN</th>
                                                    <th>SAB</th>
                                                    <th>Azioni</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                    ";

                                while($row = $result->fetch()) {
                                    echo "<tr>";
                                    echo "<td>" . date("H:i", strtotime($row['start_slot'])) . "</td>";
                                    echo "<td>" . date("H:i", strtotime($row['end_slot']))   . "</td>";
                                    if($row['sunday'] == 1) {
                                        echo '<td><i class="fas fa-check-circle"></i></td>';
                                    } else {
                                        echo '<td><i class="fas fa-times"></i></td>';
                                    }
                                    if($row['monday'] == 1) {
                                        echo '<td><i class="fas fa-check-circle"></i></td>';
                                    } else {
                                        echo '<td><i class="fas fa-times"></i></td>';
                                    }
                                    if($row['tuesday'] == 1) {
                                        echo '<td><i class="fas fa-check-circle"></i></td>';
                                    } else {
                                        echo '<td><i class="fas fa-times"></i></td>';
                                    }
                                    if($row['wednesday'] == 1) {
                                        echo '<td><i class="fas fa-check-circle"></i></td>';
                                    } else {
                                        echo '<td><i class="fas fa-times"></i></td>';
                                    }
                                    if($row['thursday'] == 1) {
                                        echo '<td><i class="fas fa-check-circle"></i></td>';
                                    } else {
                                        echo '<td><i class="fas fa-times"></i></td>';
                                    }
                                    if($row['friday'] == 1) {
                                        echo '<td><i class="fas fa-check-circle"></i></td>';
                                    } else {
                                        echo '<td><i class="fas fa-times"></i></td>';
                                    }
                                    if($row['saturday'] == 1) {
                                        echo '<td><i class="fas fa-check-circle"></i></td>';
                                    } else {
                                        echo '<td><i class="fas fa-times"></i></td>';
                                    }
                                    echo "<td>
                                            <a class='btn btn-sm btn-primary'     href='opening-time-update.php?id_slot_time=" . $row['id_slot_time'] ."' title='Modifica Slot' data-toggle='tooltip'>Modifica</a>
                                            <a class='btn btn-sm btn-danger'      href='opening-time-delete.php?id_slot_time=" . $row['id_slot_time'] ."' title='Elimina Slot'  data-toggle='tooltip'>Elimina</a>
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
</div>



<?php include('footer.php'); ?>
