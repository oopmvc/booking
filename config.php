<?php
    // maybe its called from other entry point (check this)
    //session_start();

    require_once "Facebook/autoload.php";

    $FB = new \Facebook\Facebook([
        'app_id' => '251349018864231',
        'app_secret' =>  'cecf2c8b63632e097e4203fb258e2f84',
        'default_graph_version' => 'v3.1',
    ]);

    $helper = $FB->getRedirectLoginHelper();

    // Added for bypass this: "SDK Exception: Cross-site request forgery validation failed. Required param "state" missing from persistent data."
    if (isset($_GET['state'])) {
    $helper->getPersistentDataHandler()->set('state', $_GET['state']);
}

?>
