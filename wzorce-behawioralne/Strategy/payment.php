<?php

// Interfejs strategii
interface PaymentStrategy
{
  public function pay($amount);
}

// Konkretne strategie
class CreditCardPayment implements PaymentStrategy
{
  public function pay($amount)
  {
    echo "Paid $amount using Credit Card.\n";
  }
}

class PayPalPayment implements PaymentStrategy
{
  public function pay($amount)
  {
    echo "Paid $amount using PayPal.\n";
  }
}

class BankTransferPayment implements PaymentStrategy
{
  public function pay($amount)
  {
    echo "Paid $amount using Bank Transfer.\n";
  }
}

class BlikPayment implements PaymentStrategy
{
  public function pay($amount)
  {
    echo "Paid $amount using Blik.\n";
  }
}

class OrcPayment implements PaymentStrategy
{
  public function pay($amount)
  {
    echo "Paid $amount using legion of Orcs.\n";
  }
}

// Klasa kontekstowa
class Order
{
  private $paymentStrategy;

  public function setPaymentStrategy(PaymentStrategy $strategy)
  {
    $this->paymentStrategy = $strategy;
  }

  public function processOrder($amount)
  {
    $this->paymentStrategy->pay($amount);
  }
}

// Use Case
$order = new Order();
$order->setPaymentStrategy(new CreditCardPayment());
$order->processOrder(100);

$order->setPaymentStrategy(new PayPalPayment());
$order->processOrder(150);

$order->setPaymentStrategy(new BankTransferPayment());
$order->processOrder(200);


$order->setPaymentStrategy(new BlikPayment());
$order->processOrder(200);

$order->setPaymentStrategy(new OrcPayment());
$order->processOrder(200);
