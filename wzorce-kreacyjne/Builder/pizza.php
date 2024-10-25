<?php

namespace Builder;

interface PizzaRecipe
{
  public function makePizzaDough();
  public function addTomatoSauce();
  public function addPepperoni();
  public function addCheese();
  public function bake();
  public function slice();
}

class Pizza
{
  private $content = '';
  public function add(string $something): void
  {
    $this->content .= $something . "\n";
  }

  public function about(): string
  {
    return $this->content;
  }
}

class PizzaBuilder implements PizzaRecipe
{
  protected $pizza;

  public function __construct()
  {
    $this->pizza = new Pizza();
  }

  public function getPizza(): Pizza
  {
    $pizza = $this->pizza;
    // $this->pizza = new Pizza(); // reset

    return $pizza;
  }

  public function makePizzaDough()
  {
    $this->pizza->add(" + pizza dough");

    return $this;
  }

  public function addTomatoSauce()
  {
    $this->pizza->add(" + pizza tomato sauce");

    return $this;
  }

  public function addPepperoni()
  {
    $this->pizza->add(" + Pepperoni");

    return $this;
  }

  public function addCheese()
  {
    $this->pizza->add(" + Cheese");

    return $this;
  }

  public function bake()
  {
    $this->pizza->add(" .... baking");

    return $this;
  }

  public function slice()
  {
    $this->pizza->add(" / / /  slicing");

    return $this;
  }
}

class Director
{
  public static function getPepperoni(): Pizza
  {
    $builder = new PizzaBuilder();
    return $builder->makePizzaDough()
      ->addTomatoSauce()
      ->addPepperoni()
      ->addCheese()
      ->addCheese()
      ->bake()
      ->slice()
      ->getPizza();
  }
  public static function getMargherita(): Pizza
  {
    $builder = new PizzaBuilder();
    return $builder->makePizzaDough()
      ->addTomatoSauce()
      ->addCheese()
      ->bake()
      ->slice()
      ->getPizza();
  }
}
echo "\n\n";
$pepperoni = Director::getPepperoni();
print_r($pepperoni->about());
echo "\n\n";
$margherita = Director::getMargherita();
print_r($margherita->about());
echo "\n\n";
