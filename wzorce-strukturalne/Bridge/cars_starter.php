<?php

namespace NoBridge;

interface CarInterface
{
  public function openDoors();
  public function lockDoors();
  public function honk();
  public function flashLights();
}

class Car implements CarInterface
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

$car = new Car();
$car->honk();
$car->flashLights();
$car->openDoors();
$car->lockDoors();

echo "\n\n";

$fancyNewCar = new FancyNewCar();
$fancyNewCar->honk();
$fancyNewCar->flashLights();
$fancyNewCar->openDoors();
$fancyNewCar->startEngine();
$fancyNewCar->stopEngine();
$fancyNewCar->lockDoors();

/**
 * FIXME: Brak rozdzielenia między interfejsem i implementacją:
 * W pierwotnym kodzie, interfejs zdalnego sterowania (open doors, lock doors, locate in the parking lot) jest oddzielony od implementacji pojazdu. To pozwala na różne implementacje samochodów, które mogą mieć różne sposoby wykonania tych operacji. W nowym kodzie, te operacje są bezpośrednio związane z konkretnymi samochodami.
 *
 * FIXME: Brak polimorfizmu:
 * W pierwotnym kodzie, zdalny sterownik może obsługiwać dowolny obiekt, który implementuje ImplementationLayerInterface. W nowym kodzie, to nie jest możliwe - musimy znać konkretną klasę samochodu i jej metody.
 *
 * FIXME: Rozszerzalność:
 * W pierwotnym kodzie, dodanie nowej funkcji do interfejsu sterowania nie wymaga zmiany istniejących klas samochodów - wystarczy dodać nową metodę do zdalnego sterowania. W nowym kodzie, dodanie nowej funkcji wymaga zmiany wszystkich klas samochodów.
 *
 */
