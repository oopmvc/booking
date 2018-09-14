<?php
require('includes/connection.php');
include('header.php');
?>



<div class="container-fluid">
    <div class="row">

        <?php include(__DIR__.'/templates/dashboard-sidebar.html.php'); ?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Orari di apertura</h1>
                <a href="opening-time-create.php" class="float-right btn btn btn-success" type="submit">Aggiungi</a>
            </div>

            <form class="needs-validation" novalidate>
                <?php
                    // Attempt select query execution
                    $sql = "SELECT * FROM slot_time ORDER BY day ASC, start ASC";
                    if($result = $pdo->query($sql)) {
                        if($result->rowCount() > 0) {
                            echo
                                "<div class='table-responsive'>
                                    <table class='table table-striped table-sm'>
                                        <thead>
                                            <tr>
                                                <th>Giorno</th>
                                                <th>Inizio</th>
                                                <th>Fine</th>
                                                <th>Azione</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                ";

                            while($row = $result->fetch()) {
                                echo "<tr>";
                                echo "<td>";

                                    switch ($row['day']) {
                                        case 0:
                                            echo('Domenica');
                                            break;
                                        case 1:
                                            echo('Lunedì');
                                            break;
                                        case 2:
                                            echo('Martedì');
                                            break;
                                        case 3:
                                            echo('Mercoledì');
                                            break;
                                        case 4:
                                            echo('Giovedì');
                                            break;
                                        case 5:
                                            echo('Venerdì');
                                            break;
                                        case 6:
                                            echo('Sabato');
                                            break;
                                        default:
                                            echo('Non riesco a calcola il giorno della settimana!');
                                            break;
                                    }

                                echo "</td>";
                                echo "<td>" . $row['start'] . "</td>";
                                echo "<td>" . $row['end']   . "</td>";
                                echo "<td>
                                        <a class='btn btn-sm btn-primary'     href='slot-time-update.php?id_slot_time=" . $row['id_slot_time'] ."' title='Modifica Slot' data-toggle='tooltip'>Modifica</a>
                                        <a class='btn btn-sm btn-danger'      href='slot-time-delete.php?id_slot_time=" . $row['id_slot_time'] ."' title='Elimina Slot'  data-toggle='tooltip'>Elimina</a>
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
