<?php
    // maybe its called from other entry point (check this)
    //session_start();

    require_once "Facebook/autoload.php";

    $FB = new \Facebook\Facebook([
        'app_id' => '373162053089946',
        'app_secret' =>  'df5ba5587f9318af0b20812b50d2cacd',
        'default_graph_version' => 'v3.1',
    ]);

    $helper = $FB->getRedirectLoginHelper();

    // Added for bypass this: "SDK Exception: Cross-site request forgery validation failed. Required param "state" missing from persistent data."
    if (isset($_GET['state'])) {
    $helper->getPersistentDataHandler()->set('state', $_GET['state']);
}

?>
