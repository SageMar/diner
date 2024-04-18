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
$f3->route('GET|POST /order1', function ($f3){
    //if the form has already been submitted
    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        echo "This was post access.";

        //get data from post array
        $food = $_POST['food'];
        $meal = $_POST['meal'];

        // if data valid can say if(true) as well
        // this way checks to make sure both values were at least selected
        // basic validation
        if (true){
            // $f3 is not within the scope
            // PHP has to be TOLD to look for global variables
            // add the data to the session array
            $f3->set("SESSION.food", $food);
            $f3->set("SESSION.meal", $meal);

            // if data is set and valid, send to step 2 of order form
            $f3->reroute('order2');
        } else {
            // not great practice, temporary because this should be
            // in our view pages not directly in php
            echo "<p>validation errors</p>";
        }
    } else {
        echo "This is get method access.";
    }

    $view = new Template();
    // render the specific file we want
    echo $view->render('views/order1.html');
});

// define the route for the order menu
$f3->route('GET|POST /order2', function ($f3){
    var_dump($f3->get('SESSION'));
    $view = new Template();
    // render the specific file we want
    echo $view->render('views/order2.html');
});

// run fat free, otherwise the page won't load
$f3->run();

?>