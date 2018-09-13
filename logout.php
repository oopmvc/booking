<?php

require('includes/connection.php');
$user->logout();
header('Location: index.php');
exit;

?>
