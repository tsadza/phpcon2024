<?php

// Wzorzec Abstract Factory zakłada, że mamy fabrykę tworzącą rodziny powiązanych obiektów. Dlatego powinniśmy zdefiniować interfejs fabryki oraz konkretne fabryki tworzące różne typy zamówień.


interface AbstractFactory
{
  public function createEnduro(): AbstractDriver;
  public function createBmx(): AbstractBike;
  public function createAirBike(): AbstractAirBike;
}

class ConcreteFactory implements AbstractFactory
{
  public function createEnduro(): AbstractDriver
  {
    return new Enduro();
  }

  public function createBmx(): AbstractBike
  {
    return new Bmx();
  }

  public function createAirBike(): AbstractAirBike
  {
    return new AirBike();
  }
}

class ConcretePremiumFactory implements AbstractFactory
{
  public function createEnduro(): AbstractDriver
  {
    return new Enduro('All terrain bike');
  }

  public function createBmx(): AbstractBike
  {
    return new Bmx('Have fun kids');
  }

  public function createAirBike(): AbstractAirBike
  {
    return new AirBike('localhost bike');
  }
}

interface AbstractDriver
{
  public function drive(): string;
}

interface AbstractBike
{
  public function ride(): string;
}

interface AbstractAirBike
{
  public function spinning(): string;
}




abstract class Product
{
  private $name;

  public function __construct($name = '.....')
  {
    $this->name = $name;
  }

  public function getName(): string
  {
    return $this->name;
  }
}

class Enduro extends Product implements AbstractDriver
{
  public function drive(): string
  {
    return "This {$this->getName()} Enduro drives music. \n";
  }
}

class Bmx extends Product implements AbstractBike
{
  public function ride(): string
  {
    return "Ride the highway till sun down on this {$this->getName()} bike. \n";
  }
}

class AirBike extends Product implements AbstractAirBike
{
  public function spinning(): string
  {
    return "spinninging the AirBike... {$this->getName()} \n";
  }
}


function clientCode(AbstractFactory $factory)
{
  $driver = $factory->createEnduro();
  $bike = $factory->createBmx();
  $airBike = $factory->createAirBike();

  echo $driver->drive();
  echo $bike->ride();
  echo $airBike->spinning();
}

clientCode(new ConcreteFactory());
echo "\n\n";
clientCode(new ConcretePremiumFactory());
