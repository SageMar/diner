<?php
/**
 * controller for the diner project
*/
class Controller {
    private $_f3; // Fat-Free Router

    /**
     * @param $_f3
     */
    public function __construct($f3)
    {
        $this->_f3 = $f3;
    }

    function home()
    {

            $view = new Template();
            // render the specific file we want
            echo $view->render('views/home-page.html');

    }

    function breakfast()
    {
        $view = new Template();
        // render the specific file we want
        echo $view->render('views/breakfast-menu.html');
    }

    function lunch()
    {
        $view = new Template();
        // render the specific file we want
        echo $view->render('views/lunch-menu.html');
    }

    function dinner()
    {
        $view = new Template();
        // render the specific file we want
        echo $view->render('views/dinner-menu.html');
    }

    function orderStart()
    {
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
                $this->_f3->set('errors["food"]', 'Please enter a food');
            }

            if (isset($_POST['meal']) and Validate::validMeal($_POST['meal'])){
                $meal = $_POST['meal'];
            } else {
                $this->_f3->set('errors["meal"]', 'Please select a meal');
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
            $this->_f3->set("SESSION.order", $order);

            // if there are no errors, send to next form
            if (empty($this->_f3->get('errors'))){
                // if data is set and valid, send to step 2 of order form
                $this->_f3->reroute('order2');
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
        $this->_f3->set('meals', $meals);


        $view = new Template();
        // render the specific file we want
        echo $view->render('views/order1.html');
    }
}