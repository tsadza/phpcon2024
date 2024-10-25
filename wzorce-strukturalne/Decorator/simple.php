<?php

interface SayMyName
{
  public function getName(): string;
}

class User
{
  public function __construct(protected string $name) {}

  public function getName(): string
  {
    return $this->name;
  }
}

class Professor extends User implements SayMyName
{
  public function lecture(): string
  {
    return "Hello, my name is {$this->getName()} and I'm a professor.";
  }
}

$professor = new Professor('John Doe');
echo $professor->lecture(); // Hello, my name is John Doe and I'm a professor.
