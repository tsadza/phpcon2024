<?php

namespace Decorator;

class SimpleCoffee
{
  protected $milk = false;
  protected $whippedCream = false;

  public function addMilk()
  {
    $this->milk = true;
  }

  public function addWhippedCream()
  {
    $this->whippedCream = true;
  }

  public function getCost(): float
  {
    $cost = 10;

    if ($this->milk) {
      $cost += 2;
    }

    if ($this->whippedCream) {
      $cost += 5;
    }

    return $cost;
  }

  public function getDescription(): string
  {
    $description = 'Simple coffee';

    if ($this->milk) {
      $description .= ', milk';
    }

    if ($this->whippedCream) {
      $description .= ', whipped cream';
    }

    return $description;
  }
}

// Użycie
$coffee = new SimpleCoffee();
$coffee->addMilk();
$coffee->addWhippedCream();
echo $coffee->getCost(); // 17
echo $coffee->getDescription(); // Simple coffee, milk, whipped cream


/**
 * FIXME: Open-Closed:
 * domyślcie się jakie ma wady .. :)
 *
 */
