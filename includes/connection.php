<?php

    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'admin');
    define('DB_PASSWORD', 'admin');
    define('DB_NAME', 'mauriziobarbershop');

    // if you remove last char (slash) from follow URL then you can create activation link problem
    define('DIR','localhost/mauriziobarbershop/');
    define('SITEEMAIL','info@mauriziobarbershop.com');

    try {
        /* Attempt to connect to MySQL database */
        $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);

        // Set the PDO error mode to exception
        //$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT); //Suggested to uncomment on production websites
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //Suggested to comment on production websites
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    }
    catch(PDOException $e) {
        die("ERRORE: Connessione non riuscita. " . $e->getMessage());
    }

    include('classes/user.php');
    include('classes/phpmailer/mail.php');
    $user = new User($pdo);

?>
