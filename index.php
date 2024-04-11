<?php
// 328/diner/index.php
// this file holds the controller for php

// error reporting ON
ini_set('display_errors', 1);
error_reporting(E_ALL);

//require autoload
require_once('vendor/autoload.php');

// add fat-free
$f3 = Base::instance();

// define the default for index page with an anonymous function
$f3->route('GET /', function (){
   $view = new Template();
   // render the specific file we want
   echo $view->render('views/home-page.html');
});

// run fat free, otherwise the page won't load
$f3->run();

?>