<?php include_once('header.php'); ?>

<div class="container mt-2 mb-4">
    <div class="row">
        <div class="col-lg-12">
            <h1>Step 1</h1>
            <?php
                $booking = new Booking();
                $booking->test();
            ?>
        </div>
    </div>
</div>

<?php include_once('footer.php'); ?>
