<?php

require('includes/connection.php');
include('classes/user-checked.php');

try {

    $id_resource = $_GET['id_resource'];
    $query = "DELETE FROM resources WHERE id_resource = :id_resource";
    $statement = $pdo->prepare($query);
    $statement->execute([ ':id_resource' => $id_resource ]);

    header("location: resource-management.php");

}

// show error
catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}

?>
