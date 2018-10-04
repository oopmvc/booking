<?php

    ob_start();
    session_start();

    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'giuseppe_admin');
    define('DB_PASSWORD', 'Lamatrice1');
    define('DB_NAME', 'giuseppe_mauriziobarbershop');

    // if you remove last char (slash) from follow URL then you can create activation link problem
    define('DIR','http://localhost/maurizio-barber-shop/');

    // change with noreply@mauriziobarbershop.com
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
