<?php
/**
 * Created by PhpStorm.
 * User: giuseppe
 * Date: 11/07/18
 * Time: 13.30
 */

    require_once "Facebook/autoload.php";

    $FB = new \Facebook\Facebook([
        'app_id' => '373162053089946',
        'app_secret' =>  'df5ba5587f9318af0b20812b50d2cacd',
        'default_graph_version' => 'v3.0',
    ]);

    $helper = $FB->getRedirectLoginHelper();

?>