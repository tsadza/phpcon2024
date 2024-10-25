<?php

namespace MainboardObserver;

interface Observer
{
  public function update(float $temperature);
}

class Mainboard
{
  private $temperature;
  private $observers = [];

  public function setTemperature(float $temperature)
  {
    $this->temperature = $temperature;
    $this->notifyObservers();
  }

  public function attach(Observer $observer)
  {
    $this->observers[] = $observer;
  }

  public function detach(Observer $observer)
  {
    $index = array_search($observer, $this->observers);
    if ($index !== false) {
      unset($this->observers[$index]);
    }
  }

  private function notifyObservers()
  {
    foreach ($this->observers as $observer) {
      $observer->update($this->temperature);
    }
  }
}

class TemperatureDisplay implements Observer
{
  private $cooler;

  public function __construct(string $cooler)
  {
    $this->cooler = $cooler;
  }

  public function update(float $temperature)
  {
    echo "Cooler {$this->cooler}! temperature here is: {$temperature} °C\n";
  }
}

// Użycie wzorca Observer

$mainboard = new Mainboard();

$display1 = new TemperatureDisplay('FAN ONE');
$display2 = new TemperatureDisplay('FAN 2.2');
$display3 = new TemperatureDisplay('WaterCoolingUnit 1.0');

$mainboard->attach($display1);
$mainboard->attach($display2);
$mainboard->attach($display3);

$mainboard->setTemperature(122.5);

$mainboard->detach($display2);

$mainboard->setTemperature(198.2);
