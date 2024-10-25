<?php

namespace NoPrototype;

interface Prototype
{ // Cloneable interface
  public function clone(): Prototype;
}

class Order implements Prototype
{
  private $products;
  private $customer;
  private $deliveryAddress;

  public function setProducts($products)
  {
    $this->products = $products;
    return $this;
  }

  public function setCustomer($customer)
  {
    $this->customer = $customer;
    return $this;
  }
  public function setDeliveryAddress($deliveryAddress)
  {
    $this->deliveryAddress = $deliveryAddress;
    return $this;
  }

  public function clone(): Order
  {
    return (new Order())
      ->setProducts($this->copyProducts())
      ->setCustomer($this->customer)
      ->setDeliveryAddress($this->deliveryAddress);
  }

  private function copyProducts()
  {
    $copiedProducts = [];
    foreach ($this->products as $product) {
      $copiedProducts[] = $product;
    }
    return $copiedProducts;
  }

  // Getters and setters for order details
  // ...
}

class Product
{
  public function __construct(private string $name) {}
}

$order1 = new Order();
$order1->setProducts([new Product('Product A'), new Product('Product B')]);
$order1->setCustomer('John Doe');
$order1->setDeliveryAddress('123 Main St');

$order2 = $order->clone();


/**
 * FIXME: Dont Repeat Yourself:
 * W przypadku skomplikowanych obiektów, które mają wiele właściwości,
 * konieczne będzie ręczne kopiowanie każdej właściwości.
 * To prowadzi do powielania kodu i zwiększa ryzyko popełnienia błędów.
 *
 * FIXME: Zależności:
 * Jeśli struktura oryginalnego obiektu ulegnie zmianie,
 * konieczne będzie również dostosowanie kodu obejmującego funkcjonalność kopiowania,
 * co może być czasochłonne i podatne na błędy.
 *
 * FIXME: Brak elastyczności:
 * Trudno jest dynamicznie rozszerzać i modyfikować proces kopiowania.
 * W przypadku zmiany wymagań dotyczących kopiowania,
 * konieczne będzie wprowadzenie zmian w wielu miejscach w kodzie.
 */
