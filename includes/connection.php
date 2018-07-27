<?php

    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'admin');
    define('DB_PASSWORD', 'admin');
    define('DB_NAME', 'mauriziobarbershop');

    /* Attempt to connect to MySQL database */
    //$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    // Check connection
    /*if($link === false){
        die("ERROR: Connessione non riuscita. " . mysqli_connect_error());
    }*/



    try {
        /* Attempt to connect to MySQL database */
        $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);

        // Set the PDO error mode to exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e) {
        die("ERRORE: Connessione non riuscita. " . $e->getMessage());
    }

?>
