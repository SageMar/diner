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

// define the route for the breakfast menu
$f3->route('GET /menus/breakfast', function (){
    $view = new Template();
    // render the specific file we want
    echo $view->render('views/breakfast-menu.html');
});

// define the route for the lunch menu
$f3->route('GET /menus/lunch', function (){
    $view = new Template();
    // render the specific file we want
    echo $view->render('views/lunch-menu.html');
});

// define the route for the dinner menu
$f3->route('GET /menus/dinner', function (){
    $view = new Template();
    // render the specific file we want
    echo $view->render('views/dinner-menu.html');
});

// define the route for the order menu
$f3->route('GET /order1', function (){
    $view = new Template();
    // render the specific file we want
    echo $view->render('views/order1.html');
});

// define the route for the order menu
$f3->route('GET /order2', function (){
    $view = new Template();
    // render the specific file we want
    echo $view->render('views/order.html');
});

// run fat free, otherwise the page won't load
$f3->run();

?>