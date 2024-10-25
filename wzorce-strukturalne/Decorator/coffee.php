<?php

namespace Decorator;

interface Coffee
{
  public function getCost(): float;
  public function getDescription(): string;
}

class SimpleCoffee implements Coffee
{
  public function getCost(): float
  {
    return 10;
  }

  public function getDescription(): string
  {
    return 'Simple coffee';
  }
}

abstract class CoffeeDecorator implements Coffee
{
  protected $coffee;

  public function __construct(Coffee $coffee)
  {
    $this->coffee = $coffee;
  }
}

class MilkDecorator extends CoffeeDecorator
{
  public function getCost(): float
  {
    return $this->coffee->getCost() + 2;
  }

  public function getDescription(): string
  {
    return $this->coffee->getDescription() . ', milk' . PHP_EOL;
  }
}

class WhippedCreamDecorator extends CoffeeDecorator
{
  public function getCost(): float
  {
    return $this->coffee->getCost() + 5;
  }

  public function getDescription(): string
  {
    return $this->coffee->getDescription() . ', whipped cream' . PHP_EOL;
  }
}

// Użycie
$coffee = new SimpleCoffee();
echo $coffee->getCost(); // 10
echo $coffee->getDescription(); // Simple coffee


$coffee = new WhippedCreamDecorator($coffee);
echo $coffee->getCost(); // 17
echo $coffee->getDescription(); // Simple coffee, milk, whipped cream
$coffee = new MilkDecorator($coffee);
echo $coffee->getCost(); // 12
echo $coffee->getDescription(); // Simple coffee, milk
