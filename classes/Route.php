<?php

    class Route {

        public static $validRoutes = array();

        public static function set($route, $function) {

            self::$validRoutes[] = $route;

            // GET url is empty, dont work
            if(isset($_GET['url']) == $route) {
                $function->__invoke();
            } else {
                print_r($_GET['url'] . 'get["url"] is empty!');
            }

        }

    }

 ?>
