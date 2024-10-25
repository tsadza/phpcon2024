<?php

interface Command
{
  public function execute(): void;
}

class AddProductCommand implements Command
{
  private $cart;
  private $product;

  public function __construct($cart, $product)
  {
    $this->cart = $cart;
    $this->product = $product;
  }

  public function execute(): void
  {
    $this->cart->addProduct($this->product);
  }
}

class Cart
{
  private $products = [];

  public function addProduct($product)
  {
    $this->products[] = $product;
  }

  public function getProducts()
  {
    return $this->products;
  }
}

// Invoker
class Button
{
  private $command;

  public function setCommand(Command $command)
  {
    $this->command = $command;
  }

  public function click()
  {
    $this->command->execute();
  }
}

// Client code
$cart = new Cart();
$addCommand = new AddProductCommand($cart, 'Product 1');
$button = new Button();
$button->setCommand($addCommand);
$button->click();
