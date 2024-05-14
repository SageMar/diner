<?php
// 328/diner/index.php
// this file holds the controller for php

// error reporting ON
ini_set('display_errors', 1);
error_reporting(E_ALL);

//require necessary files
require_once('vendor/autoload.php');

// test the data layer
//var_dump(DataLayer::getMeals());

// test validate class
/*if (Validate::validFood("Tacos")) {
    echo "this valid";
}*/

//var_dump(validFood("po"));

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
$f3->route('GET|POST /order1', function ($f3) {
    //if the form has already been submitted
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        //echo "This was post access.";

        // initialize variables
        $food = "";
        $meal = "";

        //get data from post array
        if (Validate::validFood($_POST['food'])) {
            $food = $_POST['food'];
        } else {
            // creates an array for errors
            $f3->set('errors["food"]', 'Please enter a food');
        }

        if (isset($_POST['meal']) and Validate::validMeal($_POST['meal'])){
            $meal = $_POST['meal'];
        } else {
            $f3->set('errors["meal"]', 'Please select a meal');
        }

        // if data valid can say if(true) as well
        // this way checks to make sure both values were at least selected
        // basic validation
        /*if (true){
            // $f3 is not within the scope
            // PHP has to be TOLD to look for global variables
            // add the data to the session array */

        // use the order class to create a new order
        $order = new Order($food, $meal);
        // add the object to the array
        $f3->set("SESSION.order", $order);

        // if there are no errors, send to next form
        if (empty($f3->get('errors'))){
            // if data is set and valid, send to step 2 of order form
            $f3->reroute('order2');
        }

    }
        /*
    } else {
        // not great practice, temporary because this should be
        // in our views pages not directly in php
        echo "<p>validation errors</p>";
    }
} else {
    // echo "This is get method access.";
}*/

    // get data from the model and add to f3 hive so it's visible in the page
    // this is controller getting the data from the model
    $meals = DataLayer::getMeals();
    // this is controller sending data to the viewpage
    $f3->set('meals', $meals);


    $view = new Template();
    // render the specific file we want
    echo $view->render('views/order1.html');
});

// define the route for the order menu
$f3->route('GET|POST /order2', function ($f3){
    var_dump($f3->get('SESSION'));

    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        // get data from post array to check
        if (isset($_POST['conds'])){
            $condiments = implode($_POST['conds']);
        } else {
            $condiments = "No condiments selected";
        }
        var_dump($_POST);
        $condiments = $_POST['conds'];

        // if valid, which we assume it is
        if (true){
            // set the data to the session
            // by GETTING the order from the session and then setting the condiments
            // within that order
            $f3->get('SESSION.order')->setCondiments($condiments);

            // send the user to the next form
            $f3->reroute('/summary');
        }
    }

    // get data from the model and add to f3 hive so it's visible in the page
    // this is controller getting the data from the model
    $conds = array('ketchup', 'mustard', 'mayonnaise');
    // this is controller sending data to the viewpage
    $f3->set('conds', $conds);

    $view = new Template();
    // render the specific file we want
    echo $view->render('views/order2.html');
});

$f3->route('GET /summary', function($f3){
    var_dump($f3->get('SESSION'));
    session_destroy();

    $view = new Template();
    echo $view->render('views/order-summary.html');
});

// run fat free, otherwise the page won't load
$f3->run();

?>