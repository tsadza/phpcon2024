<?php

namespace Decorator;

interface Order
{
  public function getPrice(): float;
  public function getDescription(): string;
}

class BasicOrder implements Order
{
  public function getPrice(): float
  {
    return 20;
  }

  public function getDescription(): string
  {
    return 'Basic order';
  }
}

abstract class OrderDecorator implements Order
{
  protected $order;

  public function __construct(Order $order)
  {
    $this->order = $order;
  }

  public function get(): Order
  {
    return $this->order;
  }
}

class InsuranceDecorator extends OrderDecorator
{
  public function getPrice(): float
  {
    return $this->order->getPrice() + 5;
  }

  public function getDescription(): string
  {
    return $this->order->getDescription() . ', insurance';
  }
}

class ExpressDeliveryDecorator extends OrderDecorator
{
  public function getPrice(): float
  {
    return $this->order->getPrice() + 10;
  }

  public function getDescription(): string
  {
    return $this->order->getDescription() . ', express delivery';
  }
}

class GiftWrapDecorator extends OrderDecorator
{
  public function getPrice(): float
  {
    return $this->order->getPrice() + 2;
  }

  public function getDescription(): string
  {
    return $this->order->getDescription() . ', gift wrap';
  }
}

// Użycie
$order = new BasicOrder();
echo $order->getPrice(); // 20
echo $order->getDescription(); // Basic order
echo PHP_EOL;

$order = new InsuranceDecorator($order);
echo $order->getPrice(); // 25
echo $order->getDescription(); // Basic order, insurance
echo PHP_EOL;

$order = new ExpressDeliveryDecorator($order);
echo $order->getPrice(); // 35
echo $order->getDescription(); // Basic order, insurance, express delivery
echo PHP_EOL;

$order = new GiftWrapDecorator($order);
echo $order->getPrice(); // 37
echo $order->getDescription(); // Basic order, insurance, express delivery, gift wrap
echo PHP_EOL;

print_r($order->get()); // BasicOrder