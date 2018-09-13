<?php
require("includes/connection.php");
include('header.php');
?>

<div class="container-fluid">
    <div class="row">

        <?php include(__DIR__.'/templates/dashboard-sidebar.html.php'); ?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Il mio profilo</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <?php echo('<a class="btn btn-sm btn-primary mr-2" href="member-update.php?username=' . $_SESSION['username'] . '">Modifica Profilo</a>'); ?>
                </div>
            </div>

            <?php

                // Attempt select query execution
                $sql = "SELECT * FROM members WHERE username = '" . $_SESSION['username'] . "'";
                if($result = $pdo->query($sql)) {
                    if($result->rowCount() > 0) {
                        echo
                            '<div class="table-responsive">
                                <table class="table table-striped table-sm">
                                    <tbody>
                            ';
                        while($row = $result->fetch()) {

                            echo "<tr>" .
                                    "<th>Username</th>".
                                    "<th>" . $row['username']  . "</th>" .
                                "</tr>";
                            echo "<tr>" .
                                    "<th>Nome</th>".
                                    "<th>" . $row['first_name']  . "</th>" .
                                "</tr>";
                            echo "<tr>" .
                                    "<th>Cognome</th>".
                                    "<th>" . $row['last_name']  . "</th>" .
                                "</tr>";
                            echo "<tr>" .
                                    "<th>Email</th>".
                                    "<th>" . $row['email']  . "</th>" .
                                "</tr>";
                            echo "<tr>" .
                                    "<th>Cellulare</th>".
                                    "<th>" . $row['phone']  . "</th>" .
                                "</tr>";
                        }
                        echo "
                            </tbody>
                        </table>";

                        // Free result set
                        unset($result);
                    } else {
                        echo "<p class='lead'><em>Non ho trovato il tuo profilo.</em></p>";
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
