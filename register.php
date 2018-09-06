<?php require('includes/connection.php');

//if logged in redirect to members page
if( $user->is_logged_in() ){ header('Location: index.php'); exit(); }

//if form has been submitted process it
if(isset($_POST['submit'])){

    if (!isset($_POST['username'])) $error[] = "Controlla tutti i campi";
    if (!isset($_POST['email'])) $error[] = "Controlla tutti i campi";
    if (!isset($_POST['password'])) $error[] = "Controlla tutti i campi";

    $username = $_POST['username'];

    //very basic validation
    if(!$user->isValidUsername($username)){
        $error[] = 'Il nome utente deve essere composto da almeno 3 caratteri alfanumerici.';
    } else {
        $stmt = $pdo->prepare('SELECT username FROM members WHERE username = :username');
        $stmt->execute(array(':username' => $username));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!empty($row['username'])){
            $error[] = 'Il nome utente scelto è già stato utilizzato.';
        }

    }

    if(strlen($_POST['password']) < 3){
        $error[] = 'La Password è troppo corta.';
    }

    if(strlen($_POST['passwordConfirm']) < 3){
        $error[] = 'La Password di conferma è troppo corta.';
    }

    if($_POST['password'] != $_POST['passwordConfirm']){
        $error[] = 'La Passwords non corrispondono.';
    }

    //email validation
    $email = htmlspecialchars_decode($_POST['email'], ENT_QUOTES);
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
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
    if(!isset($error)){

        //hash the password
        $hashedpassword = $user->password_hash($_POST['password'], PASSWORD_BCRYPT);

        //create the activasion code
        $activasion = md5(uniqid(rand(),true));

        try {

            //insert into database with a prepared statement
            $stmt = $pdo->prepare('INSERT INTO members (username,password,email,active) VALUES (:username, :password, :email, :active)');
            $stmt->execute(array(
                ':username' => $username,
                ':password' => $hashedpassword,
                ':email' => $email,
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
            header('Location: index.php?action=joined');
            exit;

            //else catch the exception and show the error.
        } catch(PDOException $e) {
            $error[] = $e->getMessage();
        }

    }

}

//define page title
$title = 'Demo';

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
                    <input type="text" name="username" id="username" class="form-control input-lg" placeholder="Nome utente" value="<?php if(isset($error)){ echo htmlspecialchars($_POST['username'], ENT_QUOTES); } ?>" tabindex="1">
                </div>
                <div class="form-group">
                    <input type="email" name="email" id="email" class="form-control input-lg" placeholder="Indirizzo e-mail" value="<?php if(isset($error)){ echo htmlspecialchars($_POST['email'], ENT_QUOTES); } ?>" tabindex="2">
                </div>
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password" tabindex="3">
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <input type="password" name="passwordConfirm" id="passwordConfirm" class="form-control input-lg" placeholder="Conferma Password" tabindex="4">
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
                        <input type="submit" name="submit" value="Iscrivti ora" class="btn btn-primary btn-block btn-lg mb-5" tabindex="5">
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