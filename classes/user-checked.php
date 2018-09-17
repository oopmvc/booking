<?php

//if not logged in redirect to login page
if(!$user->is_logged_in()) {
	header('Location: login.php');
	exit();
}
