<?php

// Attempt select query execution
$sql_resource = "SELECT * FROM slot_time";

if ($result_slot_time = $pdo->query($sql_resource)) {

    if ($result_slot_time->rowCount() > 0) {

        echo "<option value=''>" . ' - ' . "</option>";

        while ($row_slot_time = $result_slot_time->fetch()) {

            /**
            * If day of week selected is set on 1 then print "time_slot" else do nothing.
            * Show only time_slot next now.
            */
            $today = strtolower(date("l"));

            if($row_slot_time[$today] == 1 && $row_slot_time['start_slot'] > date("H:i")) {

                echo "<option value='" . $row_slot_time['id_slot_time'] . "'>"
                    . $row_slot_time['start_slot']
                    . ' - '
                    . $row_slot_time['end_slot']
                . "</option>";

            }

        }

        // Free result set
        unset($row_slot_time);

    } else {

        echo "<p class='lead'><em>Nessuno slot libero.</em></p>";

    }

} else {

    echo "ERROR: Non posso eseguire la richiesta " . $sql_resource . mysqli_error($link);
    
}

?>
