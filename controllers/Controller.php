<?php

    class Controller {

        public static function CreateView($viewName) {
            require_once("./views/$viewName.php");
        }

        public static function CreateBookingView($viewName) {
            require_once("./views/booking/$viewName.php");
        }

    }

?>
