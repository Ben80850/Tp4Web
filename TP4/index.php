<?php
require '../../includes/flight-master/flight/Flight.php';
// Load Smarty library
require '../../includes/Smarty/libs/Smarty.class.php';

require "routes/routes.php";


Flight::register('view', 'Smarty', array(), function($smarty){
    $smarty->template_dir = './templates/';
    $smarty->compile_dir = './templates_c/';
    $smarty->config_dir = './config/';
    $smarty->cache_dir = './cache/';
});

Flight::map('render', function($template, $data){
    Flight::view()->assign($data);
    Flight::view()->display($template);
});
// Lance une session
session_start();

// Assigne une session a l'utilisateur
if (isset($_SESSION['user']))
{
    Flight::view()->assign('user', $_SESSION['user']);
}

Flight::start();
?>