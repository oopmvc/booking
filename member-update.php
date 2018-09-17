<?php

require('includes/connection.php');
include('classes/user-checked.php');
include('header.php');

try {

    $username = $_GET['username'];
    $query = "SELECT * FROM members WHERE username = :username";
    $statement = $pdo->prepare($query);
    $statement->execute([ ':username' => $username ]);

    // store retrieved row to a variable
    $row = $statement->fetch(PDO::FETCH_OBJ);

    if(isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['email']) && isset($_POST['phone'])) {

        // values to fill up our form
        $first_name = $_POST['first_name'];
        $last_name  = $_POST['last_name'];
        $email      = $_POST['email'];
        $phone      = $_POST['phone'];
        $address    = $_POST['address'];
        $postal_code = $_POST['postal_code'];
        $city       = $_POST['city'];
        $country    = $_POST['country'];

        $query = "UPDATE members SET first_name = :first_name, last_name = :last_name, email = :email, phone = :phone, address = :address, postal_code = :postal_code, city = :city, country = :country WHERE username = :username";
        $statement = $pdo->prepare($query);

        if($statement->execute([ ':username' => $username, ':first_name' => $first_name, ':last_name' => $last_name, ':email' => $email, ':phone' => $phone, 'address' => $address, 'postal_code' => $postal_code, 'city' => $city, 'country' => $country])) {
            echo('<div class="alert alert-success">Profilo modificato correttamente!</div>');
            // refresh after save
            header('Refresh: 0; url=./member-read.php');
        } else {
            echo('<div class="alert alert-danger">"Errore nel salvataggio del profilo.</div>');
        }

    }

}

// show error
catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}

?>



<div class="container-fluid">
    <div class="row">

        <?php include(__DIR__.'/templates/dashboard-sidebar.html.php'); ?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Modifica Profilo</h1>
            </div>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?username={$username}");?>" method="post">
                <div class="form-group">
                    <label for="first_name">Nome</label>
                    <input type="text" name="first_name" class="form-control" value="<?= $row->first_name; ?>" />
                </div>
                <div class="form-group">
                    <label for="last_name">Cognome</label>
                    <input type="text" name="last_name" class="form-control" value="<?= $row->last_name; ?>" />
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" class="form-control input-lg" value="<?= $row->email; ?>"/>
                </div>
                <div class="form-group">
                    <label for="phone">Telefono</label>
                    <input type="text" name="phone" class="form-control" value="<?= $row->phone; ?>"/>
                </div>
                <div class="form-group">
                    <label for="address">Indirizzo</label>
                    <input type="text" name="address" class="form-control" value="<?= $row->address; ?>"/>
                </div>
                <div class="form-group">
                    <label for="postal_code">CAP</label>
                    <input type="text" name="postal_code" class="form-control" value="<?= $row->postal_code; ?>"/>
                </div>
                <div class="form-group">
                    <label for="city">Città</label>
                    <input type="text" name="city" class="form-control" value="<?= $row->city; ?>"/>
                </div>
                <div class="form-group">
                    <label for="country">Nazione</label>
                    <input type="text" name="country" class="form-control" value="<?= $row->country; ?>"/>
                </div>
                <div class="form-group">
                    <input type="submit" value="Salva" class="btn btn-primary" />
                    <a href="dashboard.php" class="btn btn-danger">Vai alla Dashboard</a>
                </div>
            </form>
        </main>
    </div>
</div>



<?php include('footer.php'); ?>
