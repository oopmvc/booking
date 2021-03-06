<?php


require_once('includes/connection.php');
//check if already logged in move to home page
if( $user->is_logged_in() ) {
	header('Location: dashboard.php');
	exit();
}

//process login form if submitted
if(isset($_POST['submit'])) {
	if (!isset($_POST['username'])) {
		$error[] = "Inserisci il nome utente.";
	}
	if (!isset($_POST['password'])) {
		$error[] = "Inserisci la password.";
	}
	$username = $_POST['username'];
	if ( $user->isValidUsername($username)) {
		if (!isset($_POST['password'])){
			$error[] = "E\' necessario inserire una password";
		}
		$password = $_POST['password'];
		if($user->login($username,$password)) {
			$_SESSION['username'] = $username;
			header('Location: dashboard.php');
			exit;
		} else {
			$error[] = 'Nome utente o password sono errati oppure il tuo account non è stato attivato.';
		}
	} else {
		$error[] = 'Il nome utente deve essere alfanumerico e deve avere una lunghezza da 3 a 16 caratteri';
	}
}
include('header.php');
?>


<div class="container-fluid">

	<div class="row">

	    <div class="col-lg-4 col-sm-8 col-md-6 offset-lg-4 offset-sm-2 offset-md-3 mt-3">

			<form role="form" method="post" autocomplete="off">
				<h2>Accedi</h2>
				<hr>
				<div class="fb-login-button" data-size="large" data-button-type="continue_with" data-auto-logout-link="true" data-use-continue-as="true"></div>



				<div>User ID: <?php echo $user_id; ?></div>
				<div>Email: <?php echo $email; ?></div>


				<hr>
				<p><a href='./'>Torna alla Home</a></p>
				<hr>

				<?php
				//check for any errors
				if(isset($error)) {
					foreach($error as $error) {
						echo '<div class="alert alert-danger" role="alert">' . $error . '</div>';
					}
				}
				if(isset($_GET['action'])) {
					//check the action
					switch($_GET['action']) {
						case 'joined':
							echo "<div class='alert alert-danger'><strong>Ti abbiamo inviato una email. Accedi alla tua casella di posta elettronica per attivare il tuo account.</strong></div>";
							break;
						case 'active':
							echo "<div class='alert alert-success'>Il tuo account è ora attivo e ora puoi effettuare il login.</div>";
							break;
						case 'reset':
							echo "<div class='alert alert-success'>Controlla la tua casella di posta per il ripristino.</div>";
							break;
						case 'resetAccount':
							echo "<div class='alert alert-success'>Password cambiata, ora puoi effettuare il login.</div>";
							break;
					}
				}
				?>

				<div class="form-group">
					<input type="text" name="username" id="username" class="form-control input-lg" placeholder="Nome utente" value="<?php if(isset($error)){ echo htmlspecialchars($_POST['username'], ENT_QUOTES); } ?>" tabindex="1">
				</div>

				<div class="form-group">
					<input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password" tabindex="3">
				</div>

				<div class="row">
					<div class="col-xs-9 col-sm-9 col-md-9">
						 <a href='reset.php'>Password dimenticata?</a>
					</div>
				</div>

				<hr>
				<div class="row">
					<div class="col-lg-12 col-xs-12 col-md-12">
                        <input type="submit" name="submit" value="Accedi" class="btn btn-primary btn-block btn-lg mb-5" tabindex="5">
					</div>
				</div>
			</form>
		</div>
	</div>
</div>


<?php include('footer.php'); ?>
