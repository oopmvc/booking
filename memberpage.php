<?php

require('includes/connection.php');

//if not logged in redirect to login page
if(!$user->is_logged_in()){
	header('Location: login.php'); exit();
}

//define page title
$title = 'Members Page';

//include header template
require('header.php');
?>

<div class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
			<h2>Pagina visibile ai soli utenti registrati - Ciao <?php echo htmlspecialchars($_SESSION['username'], ENT_QUOTES); ?></h2>
			<p><a href='logout.php'>Logout</a></p>
			<hr>
		</div>
	</div>
</div>

<?php require('footer.php'); ?>
