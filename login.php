<?php include('header.php'); ?>

<div class="container text-center">
    <div class="row">
        <div class="col-lg-4 mx-auto">
            <h1>Accedi</h1>
            <div class="fb-login-button" data-max-rows="1" data-size="large" data-button-type="login_with" data-show-faces="false" data-auto-logout-link="false" data-use-continue-as="false"></div>
            <hr>
            <img src="img/logo-maurizio-barber-shop-foggia.jpg" alt="logo maurizio barber shop" class="img-fluid mb-3">
            <p>oppure accedi con Email e Password</p>
            <form class="pb-3">
                <input type="email" value="" placeholder="email" class="form-control mb-3">
                <input type="password" value="" placeholder="password" class="form-control mb-3">
                <input type="submit" value="Accedi" class="btn btn-success">
            </form>
            <p>
                Non hai ancora un account?<a class="pl-2 pr-2" href="#">Registrati</a><br>
            </p>
            <p>
                <a href="#">Password dimenticata?</a>
            </p>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
