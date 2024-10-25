<?php

interface Handler
{
  public function setNext(Handler $handler): Handler;
  public function handle(Vehicle $vehicle);
}

abstract class AbstractHandler implements Handler
{
  private Handler $nextHandler;

  public function setNext(Handler $handler): Handler
  {
    $this->nextHandler = $handler;
    return $handler;
  }

  public function handle(Vehicle $vehicle)
  {
    if ($this->nextHandler) {
      return $this->nextHandler->handle($vehicle);
    }

    return null;
  }
}

// ----------------------------

class CarwashHandler extends AbstractHandler
{
  public function handle(Vehicle $vehicle)
  {
    echo "\n\n\nWelcome to carwash {$vehicle->getName()} ! \n";
    return parent::handle($vehicle);
  }
}

class WheelAndTiresHandler extends AbstractHandler
{
  public function handle(Vehicle $vehicle)
  {
    echo "cleaning {$vehicle->getName()} wheels and tires \n";
    return parent::handle($vehicle);
  }
}

class ShampooHandler extends AbstractHandler
{
  public function handle(Vehicle $vehicle)
  {
    echo "shampoo all over .. \n";
    return parent::handle($vehicle);
  }
}

class RinseHandler extends AbstractHandler
{
  public function handle(Vehicle $vehicle)
  {
    echo "{$vehicle->getName()} is rinsed from top down \n";
    return parent::handle($vehicle);
  }
}

class DryHandler extends AbstractHandler
{
  public function handle(Vehicle $vehicle)
  {
    echo "dry with hot air \n";
    return parent::handle($vehicle);
  }
}

class WaxHandler extends AbstractHandler
{
  public function handle(Vehicle $vehicle)
  {
    echo "waxing {$vehicle->getName()} with premium wax \n";
    return parent::handle($vehicle);
  }
}

class CheckoutHandler extends AbstractHandler
{
  public function handle(Vehicle $vehicle)
  {
    echo "Thank you {$vehicle->getName()}, come again ! \n";
    return null;
  }
}

class Vehicle
{
  private $name;

  public function __construct(string $name)
  {
    $this->name = $name;
  }

  public function getName(): string
  {
    return $this->name;
  }
}

// -------------------------------

$carwash = new CarwashHandler();
$wheels = new WheelAndTiresHandler();
$shampoo = new ShampooHandler();
$rinse = new RinseHandler();
$dry = new DryHandler();
$wax = new WaxHandler();
$doubleWax = new WaxHandler();
$checkout = new CheckoutHandler();

$vehicle = new Vehicle('Volvo');
$carwash
  ->setNext($wheels)
  ->setNext($shampoo)
  ->setNext($rinse)
  ->setNext($dry)
  ->setNext($doubleWax)
  ->setNext($wax)
  ->setNext($checkout);
$carwash->handle($vehicle);

$vehicle = new Vehicle('Opel');
$carwash
  ->setNext($shampoo)
  ->setNext($rinse)
  ->setNext($checkout);
$carwash->handle($vehicle);
