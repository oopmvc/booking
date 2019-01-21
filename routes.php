<?php

    // Route::set('index-new.php', function() {
    //     Index::CreateBookingView('insert-reservation');
    // });

    Route::set('index-new.php', function() {
        Booking::CreateBookingView('add-reservation');
    });

?>
