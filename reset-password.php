<?php

require('includes/connection.php');

//if logged in redirect to members page
if( $user->is_logged_in()) {
    header('Location: dashboard.php');
    exit();
}

$resetToken = hash('SHA256', ($_GET['key']));

$stmt = $pdo->prepare('SELECT resetToken, resetComplete FROM members WHERE resetToken = :token');
$stmt->execute(array(':token' => $resetToken));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

//if no token from db then kill the page
if(empty($row['resetToken'])) {
	$stop = 'Ti abbiamo inviato una email. Clicca sul link presente nella e-mail di ripristino.';
} elseif($row['resetComplete'] == 'Yes') {
	$stop = 'La tua password e\' gia\' stata cambiata!';
}

//if form has been submitted process it
if(isset($_POST['submit'])) {

	if (!isset($_POST['password']) || !isset($_POST['passwordConfirm']))
		$error[] = 'Le password devono essere inserite due volte.';

	//basic validation
	if(strlen($_POST['password']) < 3) {
		$error[] = 'Password troppo corta. Deve avere almeno 3 caratteri.';
	}

	if(strlen($_POST['passwordConfirm']) < 3) {
		$error[] = 'Conferma password troppo corta.';
	}

	if($_POST['password'] != $_POST['passwordConfirm']) {
		$error[] = 'Le password non corrispondono.';
	}

	//if no errors have been created carry on
	if(!isset($error)) {

		//hash the password
		$hashedpassword = $user->password_hash($_POST['password'], PASSWORD_BCRYPT);

		try {

			$stmt = $pdo->prepare("UPDATE members SET password = :hashedpassword, resetComplete = 'Yes'  WHERE resetToken = :token");
			$stmt->execute(array(
				':hashedpassword' => $hashedpassword,
				':token' => $row['resetToken']
			));

			//redirect to index page
			header('Location: login.php?action=resetAccount');
			exit;

		//else catch the exception and show the error.
		} catch(PDOException $e) {
		    $error[] = $e->getMessage();
		}

	}

}

include('header.php');

?>

<div class="container">
	<div class="row">
	    <div class="col-xs-12 col-sm-8 col-md-6 offset-sm-2 offset-md-3 mt-3 mb-3">
	    	<?php if(isset($stop)){
	    		echo('<div class="alert alert-danger" role="alert">' . $stop . '</div>');
	    	} else { ?>

				<form role="form" method="post" action="" autocomplete="off">
					<h2>Cambia Password</h2>
					<hr>

					<?php
					//check for any errors
					if(isset($error)) {
						foreach($error as $error) {
							echo('<div class="alert alert-success" role="alert">' . $error . '</div>');
						}
					}

                	//check the action
					switch($_GET['action']) {
						case 'active':
							echo('<div class="alert alert-success" role="alert">Il tuo account è ora attivo e ora puoi effettuare il login.</div>');
							break;
						case 'reset':
							echo('<div class="alert alert-success" role="alert">Inserisci la nuova password.</div>');
							break;
					}
					?>

					<div class="row">
						<div class="col-xs-6 col-sm-6 col-md-6">
							<div class="form-group">
								<input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password" tabindex="1">
							</div>
						</div>
						<div class="col-xs-6 col-sm-6 col-md-6">
							<div class="form-group">
								<input type="password" name="passwordConfirm" id="passwordConfirm" class="form-control input-lg" placeholder="Conferma Password" tabindex="1">
							</div>
						</div>
					</div>

					<hr>
					<div class="row">
						<div class="col-xs-12 col-md-12"><input type="submit" name="submit" value="Cambia Password" class="btn btn-primary btn-block btn-lg" tabindex="3"></div>
					</div>
				</form>

			<?php } ?>
		</div>
	</div>


</div>

<?php include("footer.php"); ?>
