<?php

namespace NoStrategy;

class Checkout
{
  private $price;
  private $discountType;

  public function __construct(float $price, string $discountType)
  {
    $this->price = $price;
    $this->discountType = $discountType;
  }

  public function getTotalPrice(): float
  {
    $discount = 0;
    switch ($this->discountType) {
      case 'black_friday':
        $discount = 0.3 * $this->price;
        break;
      case 'coupon':
        $discount = $this->price > 100 ? 10 : 0;
        break;
      default:
        break;
    }
    return $this->price - $discount;
  }
}

echo (new Checkout(144, 'coupon'))->getTotalPrice();
echo "\n\n";
echo (new Checkout(144, 'black_friday'))->getTotalPrice();
echo "\n\n";

/**
 * FIXME:: Single Responsibility Principle:
 * Klasa Checkout jest teraz odpowiedzialna za obliczanie ceny po zniżce oraz za implementację wszystkich strategii zniżek.
 *
 * FIXME:: Rozszerzalność:
 * Jeśli chcemy dodać nową strategię zniżki, musimy modyfikować klasę Checkout,
 * co zwiększa ryzyko wprowadzenia błędów.
 *
 * FIXME:: Duplikacja:
 * Jeśli logika obliczania zniżki jest skomplikowana, może pojawić się wiele powtarzających się fragmentów kodu w różnych przypadkach instrukcji switch.
 *
 * FIXME:: Debug:
 * Błędy związane z obliczaniem konkretnej zniżki mogą być trudniejsze do znalezienia i naprawy, ponieważ są ukryte wewnątrz klasy Checkout, zamiast być izolowane w swoich własnych klasach strategii.
 */
