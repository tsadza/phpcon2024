<?php

class CharacterFlyweight
{
  private string $value;

  public function setValue(string $value)
  {
    $this->value = $value;
  }

  public function drawLine(int $length = 1)
  {
    echo str_repeat($this->value, $length) . "\n";
  }
}

class Lines
{
  private array $table = [];
  private CharacterFlyweight $flyweight;

  public function __construct(CharacterFlyweight $flyweight)
  {
    $this->flyweight = $flyweight;

    for ($i = 0; $i <= rand(5, 10); $i++) {
      $this->table[] = rand(5, 20);
    }
  }

  public function draw()
  {
    foreach ($this->table as $length) {
      $this->flyweight->drawLine($length);
    }
  }

  public function setCharacter(string $character)
  {
    $this->flyweight->setValue($character);
  }
}


$lines = new Lines(new CharacterFlyweight());
$lines->setCharacter('A');
$lines->draw();
$lines->setCharacter('B');
$lines->draw();
$lines->setCharacter('C');
$lines->draw();
