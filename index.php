<?php 

require 'init.php';

$app = new App($db, $user);



$app->handle_request();
$app->render_response();