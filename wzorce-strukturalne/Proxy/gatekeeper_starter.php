<?php

interface Operator
{
  public function process(): void;
}

class RealOperator implements Operator
{
  public function process(): void
  {
    if ($this->checkAccess()) {
      echo "RealOperator: I can process this case.\n";
      $this->logAccess();
    } else {
      echo "RealOperator: Access denied!\n";
    }
  }

  private function checkAccess(): bool
  {
    // Here could be a real access checking logic
    if (rand(0, 1) === 1) {
      echo "RealOperator: Access granted!\n";
      return true;
    }
    return false;
  }

  private function logAccess(): void
  {
    echo "RealOperator: Access attempt has been logged.\n";
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


/**
 * FIXME: Brak kontroli dostępu:
 * Nie mamy kontroli nad tym, kto ma dostęp do RealOperator.
 * Wszystko, co wymaga pewnego poziomu kontroli dostępu, jest teraz dostępne dla wszystkich.
 *
 * FIXME: Brak logowania:
 * Nie jesteśmy już w stanie logować, kto próbował uzyskać dostęp do RealOperator.
 *
 * FIXME: Brak ochrony przed operacjami kosztownymi zasobowo:
 * RealOperator jest narażony na wszelkiego rodzaju żądania, co może prowadzić do problemów z wydajnością.
 *
 * FIXME: Single Responsibility Principle:
 * Bez wzorca Proxy, RealOperator jest zmuszony do przejęcia dodatkowych obowiązków, takich jak logowanie i kontrola dostępu => To zwiększa też ryzyko wprowadzenia błędów do kodu i czyni go trudniejszym do utrzymania i rozszerzania.
 */
