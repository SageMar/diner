<?php
// diner/model/data-layer.php
/* This is my Data Layer.
 * It belongs to the model.
*/
class DataLayer
{
// Get the meals for the diner app
    static function getMeals()
    {
        return array('breakfast', 'lunch', 'dinner');
    }

    static function getCondiments()
    {
        return array('ketchup', 'mustard', 'mayonnaise');
    }
}
?>