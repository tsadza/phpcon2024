<?php

interface Operator
{
  public function process(): void;
}

class RealOperator implements Operator
{
  public function process(): void
  {
    echo "RealOperator: I can process this case.\n";
  }
}

class GatekeeperProxy implements Operator
{
  private $realOperator;

  public function __construct(RealOperator $realOperator)
  {
    $this->realOperator = $realOperator;
  }

  public function process(): void
  {
    if ($this->checkAccess()) {
      $this->realOperator->process();
      $this->logAccess();
    } else {
      echo "Proxy: Access denied!\n";
    }
  }

  private function checkAccess(): bool
  {
    // Here could be a real access checking logic
    if (rand(0, 1) === 1) {
      echo "Proxy: Access granted!\n";
      return true;
    }
    return false;
  }

  private function logAccess(): void
  {
    echo "Proxy: Access attempt has been logged.\n";
  }
}

function clientCode(Operator $Operator)
{
  // ...

  $Operator->process();

  // ...
}

echo "Running with RealOperator:\n";
$realOperator = new RealOperator();
clientCode($realOperator);

echo "\n";

echo "Running with GatekeeperProxy:\n";
$proxy = new GatekeeperProxy($realOperator);
clientCode($proxy);
