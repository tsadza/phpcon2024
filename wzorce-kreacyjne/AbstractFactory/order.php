<?php

// Wzorzec Abstract Factory zakłada, że mamy fabrykę tworzącą rodziny powiązanych obiektów. Dlatego powinniśmy zdefiniować interfejs fabryki oraz konkretne fabryki tworzące różne typy zamówień.

interface AbstractOrderFactory
{
  public function createOrder(): OrderInterface;
  public function createSpecificOrder(): SpecificOrderInterface;
}

class ConcreteOrderFactory implements AbstractOrderFactory
{
  public function createOrder(): OrderInterface
  {
    return new Order();
  }

  public function createSpecificOrder(): SpecificOrderInterface
  {
    return new SpecificOrder();
  }
}

class ConcreteSpecificOrderFactory implements AbstractOrderFactory
{
  public function createOrder(): OrderInterface
  {
    return new SpecificOrder();
  }

  public function createSpecificOrder(): SpecificOrderInterface
  {
    return new SpecificOrder();
  }
}

interface OrderInterface
{
  public function submit(): OrderInterface;
}

interface SpecificOrderInterface
{
  public function activeCargo(): void;
}

class Order implements OrderInterface
{
  public function submit(): OrderInterface
  {
    return new Order();
  }
}

class SpecificOrder implements OrderInterface, SpecificOrderInterface
{
  public function submit(): OrderInterface
  {
    return new SpecificOrder();
  }

  public function activeCargo(): void
  {
    // Implementacja aktywacji ładunku
  }
}

function clientCode(AbstractOrderFactory $factory)
{
  $order = $factory->createOrder();
  $specificOrder = $factory->createSpecificOrder();

  echo get_class($order) . "\n";
  $order->submit();

  echo get_class($specificOrder) . "\n";
  $specificOrder->activeCargo();
}

// Użycie konkretnej fabryki
clientCode(new ConcreteOrderFactory());

echo "\n";

// Użycie konkretnej fabryki specyficznych zamówień
clientCode(new ConcreteSpecificOrderFactory());
