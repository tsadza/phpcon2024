<?php

namespace NoMainboardObserver;

class Mainboard
{
  private $temperature;
  private $temperatureDisplays = [];

  public function setTemperature(float $temperature)
  {
    $this->temperature = $temperature;
    $this->updateTemperatureDisplays();
  }

  public function attachTemperatureDisplay(TemperatureDisplay $display)
  {
    $this->temperatureDisplays[] = $display;
  }

  public function detachTemperatureDisplay(TemperatureDisplay $display)
  {
    $index = array_search($display, $this->temperatureDisplays);
    if ($index !== false) {
      unset($this->temperatureDisplays[$index]);
    }
  }

  private function updateTemperatureDisplays()
  {
    foreach ($this->temperatureDisplays as $display) {
      $display->update($this->temperature);
    }
  }
}

class TemperatureDisplay
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

// Użycie bez wzorca Observer

$mainboard = new Mainboard();

$display1 = new TemperatureDisplay('FAN ONE');
$display2 = new TemperatureDisplay('FAN 2.2');
$display3 = new TemperatureDisplay('WaterCoolingUnit 1.0');

$mainboard->attachTemperatureDisplay($display1);
$mainboard->attachTemperatureDisplay($display2);
$mainboard->attachTemperatureDisplay($display3);

$mainboard->setTemperature(122.5);

$mainboard->detachTemperatureDisplay($display2);

$mainboard->setTemperature(198.2);


/**
 * FIXME: Bez automatycznego powiadamiania:
 * Konieczne jest ręczne wywołanie metody update na każdym obserwatorze po każdej zmianie temperatury.
 *
 * FIXME: Słaba kontrola:
 * Zarządzanie obserwatorami jest przeprowadzane bezpośrednio w klasie Mainboard, co prowadzi do rozproszonego kodu i utraty kontroli nad subskrypcjami.
 *
 * FIXME: Brak elastyczności:
 * Klasa Mainboard jest związana tylko z klasą TemperatureDisplay jako obserwatorem, co ogranicza elastyczność systemu i uniemożliwia łatwe dodawanie innych typów obserwatorów.
 *
 * FIXME: Bez łatwego rozszerzania:
 * Dodawanie nowych obserwatorów wymagałoby modyfikacji klasy Mainboard.
 */
