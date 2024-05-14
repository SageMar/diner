<?php
/* Validate
*/
class Validate
{
// return true if food is valid (contains >3 characters)
    static function validFood($food)
    {
        return (strlen(trim($food)) >= 3);
    }

//return true if meal is valid
    static function validMeal($meal)
    {
        return in_array($meal, DataLayer::getMeals());
    }
}