<?php require('includes/connection.php');

//if logged in redirect to members page
if( $user->is_logged_in() ) {
    header('Location: memberpage.php');
    exit();
}

//if form has been submitted process it
if(isset($_POST['submit'])) {

	//Make sure all POSTS are declared
	if (!isset($_POST['email'])) $error[] = "Compila tutti i campi";


	//email validation
	if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
	    $error[] = 'Inserisci un indirizzo email valido';
	} else {
		$stmt = $pdo->prepare('SELECT email FROM members WHERE email = :email');
		$stmt->execute(array(':email' => $_POST['email']));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if(empty($row['email'])){
			$error[] = 'L\' indirizzo inserito non è stato riconosciuto.';
		}

	}

	//if no errors have been created carry on
	if(!isset($error)) {

		//create the activation code
		$stmt = $pdo->prepare('SELECT password, email FROM members WHERE email = :email');
		$stmt->execute(array(':email' => $_POST['email']));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$token = hash_hmac('SHA256', $user->generate_entropy(8), $row['password']);//Hash and Key the random data
        $storedToken = hash('SHA256', ($token));//Hash the key stored in the database, the normal value is sent to the user

		try {

			$stmt = $pdo->prepare("UPDATE members SET resetToken = :token, resetComplete='No' WHERE email = :email");
			$stmt->execute(array(
				':email' => $row['email'],
				':token' => $storedToken
			));

			//send email
			$to = $row['email'];
			$subject = "Ripristino Password";
			$body = "<p>Qualcuno ha richiesto il ripristino della password.</p>
			<p>Se non sei stato tu allora si tratta di un errore, ignora questa email e non accadra' nulla.</p>
			<p>Per cambiare la tua password clicca su questo link: <a href='".DIR."reset-password.php?action=reset&key=$token'>".DIR."reset-password.php?action=reset&key=$token</a></p>";

			$mail = new Mail();
			$mail->setFrom(SITEEMAIL);
			$mail->addAddress($to);
			$mail->subject($subject);
			$mail->body($body);
			$mail->send();

			//redirect to index page
			// header('Location: login.php?action=reset');
            header('Location: reset-password.php?action=reset');
			exit;

		//else catch the exception and show the error.
		} catch(PDOException $e) {
		    $error[] = $e->getMessage();
		}

	}

}

//include header template
require('header.php');
?>

<div class="container">

	<div class="row">

	    <div class="col-xs-12 col-sm-8 col-md-6 offset-sm-2 offset-md-3 mt-3 mb-4">
			<form role="form" method="post" action="" autocomplete="off">
				<h2>Recupera Password</h2>
				<p><a href='login.php'>Torna al Login</a></p>
				<hr>

				<?php
				//check for any errors
				if(isset($error)){
					foreach($error as $error){
						echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
					}
				}

				if(isset($_GET['action'])){

					//check the action
					switch ($_GET['action']) {
						case 'active':
							echo "<div class='alert alert-success' role='alert'>Il tuo account è ora attivo e ora puoi effettuare il login.</div>";
							break;
						case 'reset':
							echo "<div class='alert alert-danger' role='alert'>Inserisci la nuova password.</div>"; //Controlla la tua casella di posta per ripristinare la password
							break;
					}
				}
				?>

				<div class="form-group">
					<input type="email" name="email" id="email" class="form-control input-lg" placeholder="Email" value="" tabindex="1">
				</div>

				<hr>
				<div class="row">
					<div class="col-xs-12 col-md-12"><input type="submit" name="submit" value="Reset Password" class="btn btn-lg btn-block btn-primary" tabindex="2"></div>
				</div>
			</form>
		</div>
	</div>
</div>

<?php require('footer.php'); ?>
