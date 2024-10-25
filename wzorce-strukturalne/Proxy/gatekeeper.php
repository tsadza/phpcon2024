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
    $this->realOperator->process();
    $this->logAccess();
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

class ACLProxy implements Operator
{
  public function __construct(private Operator $subject) {}

  public function process(): void
  {
    echo "Proxy: Checking access...\n";

    if ($this->checkAccess()) {
      $this->subject->process();
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
}

echo "Running with RealOperator:\n";
$realOperator = new RealOperator();
clientCode($realOperator);

echo "\n";

echo "Running with GatekeeperProxy:\n";
$realOperator = new RealOperator();
$proxy = new GatekeeperProxy($realOperator);
$aclProxy = new ACLProxy($proxy);
clientCode($proxy);
