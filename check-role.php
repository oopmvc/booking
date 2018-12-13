<?php

echo '<h1>' . $userType . '</h1>';
if ($userType != 1) {

    header('Location: index.php');
}

?>
