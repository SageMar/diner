<?php
/** Order class represents a diner order */
class Order
{
    private $_food;
    private $_meal;
    private $_condiments;

    /**
     * Constructor creates an order object
     * @param $_food String food the user ordered
     * @param $_meal String selected meal
     * @param $_condiments String selected condiments
     */
    public function __construct($_food = "none", $_meal = "No meal", $_condiments = [])
    {
        $this->_food = $_food;
        $this->_meal = $_meal;
        $this->_condiments = $_condiments;
    }

    public function getFood(): string
    {
        return $this->_food;
    }

    public function setFood(string $food): void
    {
        $this->_food = $food;
    }

    public function getMeal(): string
    {
        return $this->_meal;
    }

    public function setMeal(string $meal): void
    {
        $this->_meal = $meal;
    }

    /** Returns the selected condiments
     * @return array an array of condiments
     */
    public function getCondiments(): array
    {
        return $this->_condiments;
    }

    public function setCondiments(array $condiments): void
    {
        $this->_condiments = $condiments;
    }


}
/*
echo "<pre>";
$order = new Order('pad thai', 'lunch', ['soy sauce']);
var_dump($order);
$order2 = new Order();
$order2->setFood("nachos");
$order2->setMeal("dinner");
$order2->setCondiments(['salsa', 'guacamole']);
var_dump($order2);
echo "</pre>";*/