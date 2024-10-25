<?php

namespace Bridge;

interface AbstractRemoteInterface
{
  public function openDoors();
  public function lockDoors();
  public function locateInTheParkingLot();
}

interface ImplementationLayerInterface
{
  public function openDoors();
  public function lockDoors();
  public function honk();
  public function flashLights();
}

class Remote implements AbstractRemoteInterface
{
  public Car $car;

  public function __construct(Car $car)
  {
    $this->car = $car;
  }

  public function openDoors()
  {
    $this->car->openDoors();
  }

  public function lockDoors()
  {
    $this->car->lockDoors();
  }

  public function locateInTheParkingLot()
  {
    $this->car->honk();
    $this->car->flashLights();
  }
}

class Car implements ImplementationLayerInterface
{

  protected $doorLock = true;

  public function openDoors()
  {
    $this->doorLock = false;
    echo "Doors are open \n";
  }

  public function lockDoors()
  {
    $this->doorLock = true;
    echo "Doors are locked \n";
  }

  public function honk()
  {
    echo "Hoooooooonk !!! Do you hear me ? \n";
  }

  public function flashLights()
  {
    echo "Lights are flashing, I'm here ! \n";
  }
}

class FancyNewCar extends Car
{
  public function startEngine()
  {
    echo "Engine started \n";
  }

  public function stopEngine()
  {
    echo "Engine stopped \n";
  }
}

class FancyNewRemote extends Remote
{
  public function startEngine()
  {
    if ($this->car instanceof FancyNewCar) {
      $this->car->startEngine();
    }
  }

  public function stopEngine()
  {
    if ($this->car instanceof FancyNewCar) {
      $this->car->stopEngine();
    }
  }
}

$remote = new Remote(new Car());
$remote->locateInTheParkingLot();
$remote->openDoors();
$remote->lockDoors();
echo "\n\n";

$remote = new Remote(new FancyNewCar());
$remote->locateInTheParkingLot();
$remote->openDoors();
$remote->lockDoors();
echo "\n\n";

$remote = new FancyNewRemote(new Car());
$remote->locateInTheParkingLot();
$remote->openDoors();
$remote->startEngine();
$remote->stopEngine();
$remote->lockDoors();
echo "\n\n";

$remote = new FancyNewRemote(new FancyNewCar());
$remote->locateInTheParkingLot();
$remote->openDoors();
$remote->startEngine();
$remote->stopEngine();
$remote->lockDoors();
