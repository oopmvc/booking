<?php inculude('header.php'); ?>

<?php

    session_start();
    require("includes/connection.php");

?>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h1>Crea Servizio</h1>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                <label for="name">Nome</label>
                <input type='text' name='name' class='form-control' />

                <label for="">Descrizione</label>
                <textarea name='description' class='form-control'></textarea></td>

                <label for="">Price</label>
                <input type='text' name='price' class='form-control' /></td>
                <input type='submit' value='Save' class='btn btn-primary' />

                <a href='index.php' class='btn btn-danger'>Back to read products</a>
            </form>
        </div>
    </div>
</div>

<?php inculude('footer.php'); ?>
