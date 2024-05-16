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
$con = new Controller($f3);

// define the default for index page with an anonymous function
$f3->route('GET /', function ($f3){
    $GLOBALS['con']->home();
});


// define the route for the breakfast menu
$f3->route('GET /menus/breakfast', function (){
    $GLOBALS['con']->breakfast();
});

// define the route for the lunch menu
$f3->route('GET /menus/lunch', function (){
    $GLOBALS['con']->lunch();

});

// define the route for the dinner menu
$f3->route('GET /menus/dinner', function (){
    $GLOBALS['con']->dinner();

});

// define the route for the order menu
$f3->route('GET|POST /order1', function ()
{
    $GLOBALS['con']->orderStart();
});

// define the route for the order menu
$f3->route('GET|POST /order2', function ($f3){
    //  $GLOBALS['con']->home();
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
    //  $GLOBALS['con']->home();
    var_dump($f3->get('SESSION'));
    session_destroy();

    $view = new Template();
    echo $view->render('views/order-summary.html');
});

// run fat free, otherwise the page won't load
$f3->run();

?>