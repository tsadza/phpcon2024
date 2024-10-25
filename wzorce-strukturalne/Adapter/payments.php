<?php

namespace Adapter;

/**
 * klasy - Przelewy24 i Dotpay są implementacjami interfejsu PaymentGateway
 * i mają swoją własną logikę płatności.
 * Dodatkową klasą jest DotpayAdapter, która działa jako adapter dla klasy Dotpay,
 * aby dostosować ją do interfejsu PaymentGateway.
 * Dzięki temu mamy możliwość używania obiektu Dotpay jako implementacji PaymentGateway
 * w funkcji processPayment(), która obsługuje płatności.
 */


interface PaymentGateway
{
  public function pay(float $amount): bool;
}

class Przelewy24
{
  public function pay(float $amount): bool
  {
    // Logika płatności za pomocą Przelewy24
    echo "Paying $amount via Przelewy24... Payment successful.\n";
    return true;
  }
}

class Przelewy24Adapter implements PaymentGateway
{
  private $przelewy24;

  public function __construct(Przelewy24 $przelewy24)
  {
    $this->przelewy24 = $przelewy24;
  }

  public function pay(float $amount): bool
  {
    return $this->przelewy24->pay($amount);
  }
}


class Dotpay
{
  public function makePayment(float $amount): bool
  {
    // Logika płatności za pomocą Dotpay
    echo "Making payment of $amount via Dotpay... Payment successful.\n";
    return true;
  }
}

class DotpayAdapter implements PaymentGateway
{
  private $dotpay;

  public function __construct(Dotpay $dotpay)
  {
    $this->dotpay = $dotpay;
  }

  public function pay(float $amount): bool
  {
    return $this->dotpay->makePayment($amount);
  }
}

class TPay
{
  public function payByTPay(float $amount): bool
  {
    return true;
  }
}

class TPayAdapter implements PaymentGateway
{
  private $tpay;
  public function __construct(TPay $tpay)
  {
    $this->tpay = $tpay;
  }
  public function pay(float $amount): bool
  {
    echo "Paying $amount via TPay... Payment successful.\n";
    return $this->tpay->payByTPay($amount);
  }
}

// Klient korzystający z PaymentGateway

function processPayment(PaymentGateway $paymentGateway, float $amount)
{
  $paymentGateway->pay($amount);
}

$przelewy24 = new Przelewy24Adapter(new Przelewy24());
$dotpay = new DotpayAdapter(new Dotpay());
$tpay = new TPayAdapter(new TPay());


processPayment($przelewy24, 100.50);
echo "\n";
processPayment($dotpay, 75.25);

processPayment($tpay, 100.50);
