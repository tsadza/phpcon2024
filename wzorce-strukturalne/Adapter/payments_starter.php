<?php

namespace NoAdapter;


class Przelewy24
{
  public function pay(float $amount): bool
  {
    // Logika płatności za pomocą Przelewy24
    echo "Paying $amount via Przelewy24... Payment successful.\n";
    return true;
  }
}

class Dotpay
{
  public function pay(float $amount): bool
  {
    // Logika płatności za pomocą Dotpay
    echo "Paying $amount via Dotpay... Payment successful.\n";
    return true;
  }
}

// Klient korzystający z bramki

function processPayment($paymentMethod, float $amount)
{
  $paymentMethod->pay($amount);
}

$przelewy24 = new Przelewy24();
processPayment($przelewy24, 100.50);
echo "\n";

$dotpay = new Dotpay();
processPayment($dotpay, 75.25);

/**
 * FIXME: Struktura:
 * Brak spójnego interfejsu.
 *
 * FIXME: Łamanie zasady Open/Closed:
 * Jeśli chcielibyśmy dodać nową metodę płatności, musielibyśmy modyfikować istniejący kod, zamiast po prostu dodać nową klasę, która implementuje spójny interfejs. Wzorzec Adapter pozwala uniknąć tego problemu, ponieważ pozwala dostosować istniejące klasy do nowego interfejsu bez konieczności modyfikacji istniejącego kodu.
 *
 * FIXME: Brak elastyczności:
 * Jeśli kiedykolwiek zmieni się logika płatności w Dotpay, na przykład jeśli metoda pay() zostanie zmieniona na makePayment(), będziemy musieli zmienić nasz kod w każdym miejscu, gdzie używamy tej metody. Adapter zapewnia dodatkową warstwę abstrakcji, która izoluje nasz kod od takich zmian.
 *
 */
