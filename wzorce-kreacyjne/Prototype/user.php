<?php

namespace PrototypeUser;

interface PrototypeUser
{
  public function clone(string $name): PrototypeUser;
}

class User
{
  private $details = [];

  public function addDetail($key, $value)
  {
    $this->details[$key] = $value;
  }

  public function clone(string $name): User
  {
    $clone = new User();
    foreach ($this->details as $key => $value) {
      $clone->addDetail($key, $value);
    }
    $clone->details['name'] = $name;
    $clone->details['is_real'] = true;
    return $clone;
  }
}

$student = new User();
$student->addDetail('name', '-');
$student->addDetail('age', 21);
$student->addDetail('city', '-');
$student->addDetail('email', '-@example.com');
$student->addDetail('happy', false);
print_r($student);


$piotrek = $student->clone('Piotrek');
$piotrek->addDetail('email', 'piotrek@example.com');
print_r($piotrek);
