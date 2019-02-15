<?php

require('includes/connection.php');
include('classes/user-checked.php');
include('header.php');

try {

    // if you dont are admin redirect to index page
    include('check-role.php');

    $id_slot_time = $_GET['id_slot_time'];
    $query = "DELETE FROM slot_time WHERE id_slot_time = :id_slot_time";
    $statement = $pdo->prepare($query);
    $statement->execute([ ':id_slot_time' => $id_slot_time ]);

    header("location: opening-time-management.php");

}

// show error
catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}

?>
