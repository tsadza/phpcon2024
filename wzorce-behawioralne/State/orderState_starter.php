<?php

namespace NoState;

class Order
{
  const STATE_NEW = 'new';
  const STATE_PAID = 'paid';
  const STATE_SHIPPED = 'shipped';
  const STATE_DELIVERED = 'delivered';

  private string $state;

  public function __construct()
  {
    $this->state = self::STATE_NEW;
  }

  public function proceedToNext()
  {
    if ($this->state === self::STATE_NEW) {
      $this->state = self::STATE_PAID;
    } elseif ($this->state === self::STATE_PAID) {
      $this->state = self::STATE_SHIPPED;
    } elseif ($this->state === self::STATE_SHIPPED) {
      $this->state = self::STATE_DELIVERED;
    }
  }

  public function getState(): string
  {
    return $this->state;
  }
}


$order = new Order();
echo $order->getState(); // Output: new
echo "\n";

$order->proceedToNext();
echo $order->getState(); // Output: paid
echo "\n";

$order->proceedToNext();
echo $order->getState(); // Output: shipped
echo "\n";

$order->proceedToNext();
echo $order->getState(); // Output: delivered
echo "\n";


/**
 * FIXME: Logika:
 * Logika zmiany stanu jest centralizowana w jednej metodzie proceedToNext(), co prowadzi do wielu instrukcji warunkowych. Wraz ze zwiększaniem się liczby stanów, ta metoda stanie się coraz bardziej skomplikowana.
 *
 * FIXME: Single Responsibility Principle:
 * Logika każdego stanu jest zmieszana z klasą Zamówienia - kod w metodzie proceedToNext().
 *
 * FIXME: Open-Closed Principle:
 * Jeśli chcemy dodać nowy stan, musimy zmienić klasę Order, co narusza zasadę otwarte-zamknięte. Wzorzec State pozwoli dodać nowy stan, tworząc nową klasę, bez modyfikowania istniejących klas.
 *
 * FIXME: Zależności między stanami:
 * W tym podejściu, klasa Order musi znać możliwe stany oraz kolejność ich zmian. W przypadku wzorca State, każdy stan wie, do jakiego stanu może przejść następnie, co zmniejsza zależności między stanami.
 */
