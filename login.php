<?php
// import Facebook Login
// require_once('config.php');
// $redirectURL = "http://localhost/maurizio-barber-shop/fb-callback.php";
// $permissions = ['email'];
// $loginURL = $helper->getLoginUrl($redirectURL, $permissions);
// echo $loginURL;
// Database Connection
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
		<div class="col-lg-12">

			<!-- <script>
			// This is called with the results from from FB.getLoginStatus().
			function statusChangeCallback(response) {
				console.log('statusChangeCallback');
				console.log(response);
				// The response object is returned with a status field that lets the
				// app know the current login status of the person.
				// Full docs on the response object can be found in the documentation
				// for FB.getLoginStatus().
				if (response.status === 'connected') {
					// Logged into your app and Facebook.
					testAPI();
				} else {
					// The person is not logged into your app or we are unable to tell.
					document.getElementById('status').innerHTML = 'Please log ' +
					'into this app.';
				}
			}
			// This function is called when someone finishes with the Login
			// Button.  See the onlogin handler attached to it in the sample
			// code below.
			function checkLoginState() {
				FB.getLoginStatus(function(response) {
					statusChangeCallback(response);
				});
			}
			window.fbAsyncInit = function() {
				FB.init({
					appId      : '251349018864231',
					cookie     : true,  // enable cookies to allow the server to access
					// the session
					xfbml      : true,  // parse social plugins on this page
					version    : '3.2' // The Graph API version to use for the call
				});
				// Now that we've initialized the JavaScript SDK, we call
				// FB.getLoginStatus().  This function gets the state of the
				// person visiting this page and can return one of three states to
				// the callback you provide.  They can be:
				//
				// 1. Logged into your app ('connected')
				// 2. Logged into Facebook, but not your app ('not_authorized')
				// 3. Not logged into Facebook and can't tell if they are logged into
				//    your app or not.
				//
				// These three cases are handled in the callback function.
				FB.getLoginStatus(function(response) {
					statusChangeCallback(response);
				});
			};
			// Load the SDK asynchronously
			(function(d, s, id) {
				var js, fjs = d.getElementsByTagName(s)[0];
				if (d.getElementById(id)) return;
				js = d.createElement(s); js.id = id;
				js.src = "https://connect.facebook.net/en_US/sdk.js";
				fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));
			// Here we run a very simple test of the Graph API after login is
			// successful.  See statusChangeCallback() for when this call is made.
			function testAPI() {
				console.log('Welcome!  Fetching your information.... ');
				FB.api('/me', function(response) {
					console.log('Successful login for: ' + response.name);
					document.getElementById('status').innerHTML =
					'Thanks for logging in, ' + response.name + '!';
				});
			}
			</script>
			<!--
			Below we include the Login Button social plugin. This button uses
			the JavaScript SDK to present a graphical Login button that triggers
			the FB.login() function when clicked.
			<fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
			</fb:login-button>
			<div id="status">
			</div> -->


		</div>
	</div>
	<div class="row">
	    <div class="col-lg-4 col-sm-8 col-md-6 offset-lg-4 offset-sm-2 offset-md-3 mt-3">

			<form role="form" method="post"  autocomplete="off">
				<h2>Accedi</h2>
				<hr>
				<div class="fb-login-button" data-size="large" data-button-type="continue_with" data-auto-logout-link="true" data-use-continue-as="true"></div>
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
