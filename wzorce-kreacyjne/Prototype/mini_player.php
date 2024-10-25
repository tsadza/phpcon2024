<?php

interface Prototype
{
  public function clone(): Prototype;
}

class PlayerPrototype implements Prototype
{
  public $name;
  public $skills;

  public function clone(): PlayerPrototype
  {
    $this->skills = clone $this->skills;
    return new PlayerPrototype();
  }
}

$one = new PlayerPrototype();
$one->name = "Blue rider";
$one->skills = (object) ['jumping' => 5, 'driving' => 10];
print_r($one);

$two = $one->clone();
print_r($two);

echo $two->skills === $one->skills
  ? "Not working, same reference"
  : "It's separated ! It's alive !";
