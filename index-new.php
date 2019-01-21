<?php

   require_once('routes.php');

   function __autoload($class_name) {

       if(file_exists('./classes/' . $class_name . '.php')){
           require_once('./classes/' . $class_name . '.php');
           //print_r('then' . '<br>');
           //die();
       } else if(file_exists('./controllers/' . $class_name . '.php')) {
           require_once('./controllers/' . $class_name . '.php');
           //print_r('else' . '<br>');
           //die();
       }

   }

?>

<!--

<!DOCTYPE html>
<html lang="it" dir="ltr">
   <head>

   </head>
   <body>
       Sei in index-new.php
   </body>
</html> -->
