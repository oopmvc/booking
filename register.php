<?php require('includes/connection.php');

    //if logged in redirect to members page
    if( $user->is_logged_in() ){
        header('Location: index.php');
        exit();
    }

    //if form has been submitted process it
    if(isset($_POST['submit'])){

        if (!isset($_POST['username']))   $error[] = "Controlla tutti i campi";
        if (!isset($_POST['first_name'])) $error[] = "Controlla tutti i campi";
        if (!isset($_POST['last_name']))  $error[] = "Controlla tutti i campi";
        if (!isset($_POST['email']))      $error[] = "Controlla tutti i campi";
        if (!isset($_POST['phone']))      $error[] = "Controlla tutti i campi";
        if (!isset($_POST['password']))   $error[] = "Controlla tutti i campi";

        $username = $_POST['username'];

        //very basic validation
        if(!$user->isValidUsername($username)) {
            $error[] = 'Il nome utente deve essere composto da almeno 3 caratteri alfanumerici.';
        } else {
            $stmt = $pdo->prepare('SELECT username FROM members WHERE username = :username');
            $stmt->execute(array(':username' => $username));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if(!empty($row['username'])) {
                $error[] = 'Il nome utente scelto è già stato utilizzato.';
            }

        }

        if(strlen($_POST['password']) < 3) {
            $error[] = 'La Password è troppo corta.';
        }

        if(strlen($_POST['passwordConfirm']) < 3) {
            $error[] = 'La Password di conferma è troppo corta.';
        }

        if($_POST['password'] != $_POST['passwordConfirm']) {
            $error[] = 'La Passwords non corrispondono.';
        }

        //email validation
        $email = htmlspecialchars_decode($_POST['email'], ENT_QUOTES);
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error[] = 'Inserisci un indirizzo email valido.';
        } else {
            $stmt = $pdo->prepare('SELECT email FROM members WHERE email = :email');
            $stmt->execute(array(':email' => $email));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if(!empty($row['email'])){
                $error[] = 'L\'e-mail specificata è già in uso.';
            }

        }


        //if no errors have been created carry on
        if(!isset($error)) {

            //hash the password
            $hashedpassword = $user->password_hash($_POST['password'], PASSWORD_BCRYPT);

            //create the activasion code
            $activasion = md5(uniqid(rand(),true));

            $first_name = $_POST['first_name'];
            $last_name  = $_POST['last_name'];
            $phone      = $_POST['phone'];

            try {

                //insert into database with a prepared statement
                $stmt = $pdo->prepare('INSERT INTO members (username, first_name, last_name, email, phone, password, active) VALUES (:username, :first_name, :last_name, :email, :phone, :password, :active)');

                $stmt->execute(array(
                    ':username' => $username,
                    ':first_name' => $first_name,
                    ':last_name' => $last_name,
                    ':email' => $email,
                    ':phone' => $phone,
                    ':password' => $hashedpassword,
                    ':active' => $activasion
                ));

                $id = $pdo->lastInsertId('memberID');

                //send email
                $to = $_POST['email'];
                $subject = "Conferma di registrazione";
                $body = "<p>Grazie per aver effettuato la registrazione sul mio sito.</p>
                <p>Per attivta il tuo account, per favore clicca su questo link: <a href='".DIR."activate.php?x=$id&y=$activasion'>".DIR."activate.php?x=$id&y=$activasion</a></p>
                <p>Maurizio Barber Shop</p>";

                $mail = new Mail();
                $mail->setFrom(SITEEMAIL);
                $mail->addAddress($to);
                $mail->subject($subject);
                $mail->body($body);
                $mail->send();

                //redirect to index page
                //header('Location: index.php?action=joined');
                header('Location: login.php?action=joined');
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


<div class="container-fluid mt-3">
    <div class="row">
        <div class="col-lg-4 col-sm-8 col-md-6 offset-lg-4 offset-sm-2 offset-md-3 mt-3">
            <form role="form" method="post" action="" autocomplete="off">
                <h2>Iscriviti</h2>
                <p>Sei già registrato? <a href='login.php'>Accedi</a></p>
                <div class="fb-login-button" data-max-rows="1" data-size="large" data-button-type="login_with" data-show-faces="false" data-auto-logout-link="false" data-use-continue-as="false"></div>
                <hr>
                <fb:login-button
                  scope="public_profile,email"
                  onlogin="checkLoginState();">
                </fb:login-button>
                <div id="status"></div>
                <div class="" onclick="logout()">
                    Logout
                </div>
                <script type="text/javascript">
                function logoutX (){

                     FB.logout(function(response) {
                        console.log("Logged out")})
                };

                function statusChangeCallback(response) {
                       console.log('statusChangeCallback');
                       console.log(response);

                       if (response.status === 'connected') {
                           // Logged into your app and Facebook.

                           FB.api('/me?scope=email', function (response) {
                                    console.table(response);
                               document.getElementById('status').innerHTML ='Thanks for logging in, ' + response + '!';
                           });
                       } else {
                           // The person is not logged into your app or we are unable to tell.
                           document.getElementById('status').innerHTML = 'Please log ' +
                             'into this app.';
                       }
                   }
                </script>
                <hr>

                <?php
                //check for any errors
                if(isset($error)){
                    foreach($error as $error){
                        echo '<p class="bg-danger">'.$error.'</p>';
                    }
                }

                //if action is joined show sucess
                if(isset($_GET['action']) && $_GET['action'] == 'joined'){
                    echo "<h2 class='bg-success'>Registrazione avvenuta con successo, per favore controlla la tua email per attivare il tuo account.</h2>";
                }
                ?>

                <div class="form-group">
                    <input type="text" name="username" id="username" class="form-control input-lg" placeholder="Nome utente" value="<?php if(isset($error)){ echo htmlspecialchars($_POST['username'], ENT_QUOTES); } ?>" tabindex="1" required>
                </div>
                <div class="form-group">
                    <input type="text" name="first_name" id="first_name" class="form-control input-lg" placeholder="Nome" value="<?php if(isset($error)){ echo htmlspecialchars($_POST['first_name'], ENT_QUOTES); } ?>" tabindex="2" required>
                </div>
                <div class="form-group">
                    <input type="text" name="last_name" id="last_name" class="form-control input-lg" placeholder="Cognome" value="<?php if(isset($error)){ echo htmlspecialchars($_POST['last_name'], ENT_QUOTES); } ?>" tabindex="3" required>
                </div>
                <div class="form-group">
                    <input type="email" name="email" id="email" class="form-control input-lg" placeholder="Indirizzo e-mail" value="<?php if(isset($error)){ echo htmlspecialchars($_POST['email'], ENT_QUOTES); } ?>" tabindex="4" required>
                </div>
                <div class="form-group">
                    <input type="text" name="phone" id="phone" class="form-control input-lg" placeholder="Cellulare" value="<?php if(isset($error)){ echo htmlspecialchars($_POST['phone'], ENT_QUOTES); } ?>" tabindex="5">
                </div>
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password" tabindex="6" required>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <input type="password" name="passwordConfirm" id="passwordConfirm" class="form-control input-lg" placeholder="Conferma Password" tabindex="7" required>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <small>Facendo clic su Iscriviti, accetti i nostri Termini. Scopri come raccogliamo, utilizziamo e condividiamo i tuoi dati nella nostra Informativa sui dati e come utilizziamo i cookie e tecnologie simili nella nostra Politica sui cookie. Potresti ricevere notifiche via SMS da noi e puoi uscire in qualsiasi momento.</small>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                        <input type="submit" name="submit" value="Iscrivti ora" class="btn btn-primary btn-block btn-lg mb-5" tabindex="8">
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>

<?php
//include header template
require('footer.php');
?>
