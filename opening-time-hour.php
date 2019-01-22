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

            if($row_slot_time[$today] == 1 && $row_slot_time['start_slot'] > date("H:i:s")) {

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

<!-- <option value="" disabled="disabled">-</option>
<option value="08:00:00">08:00</option>
<option value="08:30:00">08:30</option>
<option value="09:00:00">09:00</option>
<option value="09:30:00">09:30</option>
<option value="10:00:00">10:00</option>
<option value="10:30:00">10:30</option>
<option value="11:00:00">11:00</option>
<option value="11:30:00">11:30</option>
<option value="12:00:00">12:00</option>
<option value="12:30:00">12:30</option>
<option value="13:00:00">13:00</option>
<option value="13:30:00">13:30</option>
<option value="14:00:00">14:00</option>
<option value="14:30:00">14:30</option>
<option value="15:00:00">15:00</option>
<option value="15:30:00">15:30</option>
<option value="16:00:00">16:00</option>
<option value="16:30:00">16:30</option>
<option value="17:00:00">17:00</option>
<option value="17:30:00">17:30</option>
<option value="18:00:00">18:00</option>
<option value="18:30:00">18:30</option>
<option value="19:00:00">19:00</option>
<option value="19:30:00">19:30</option>
<option value="20:00:00">20:00</option>
<option value="20:30:00">20:30</option>
<option value="21:00:00">21:00</option>
<option value="21:30:00">21:30</option>
<option value="22:00:00">22:00</option>
<option value="22:30:00">22:30</option>
<option value="23:00:00">23:00</option>
<option value="23:30:00">23:30</option> -->
