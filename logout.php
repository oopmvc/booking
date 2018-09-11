<?php
session_start();
require('includes/connection.php');

//if not logged in redirect to login page
if(!$user->is_logged_in()) {
	header('Location: login.php');
    exit();
}

//logout
$user->logout();

//logged in return to index page
header('Location: index.php');
exit;
?>
