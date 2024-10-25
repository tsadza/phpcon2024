<?php

namespace Prototype;

interface Prototype
{
  public function clone(): Prototype;
}

class Order implements Prototype
{
  private $products;
  private $customer;
  private $deliveryAddress;

  public function __construct($products, $customer, $deliveryAddress)
  {
    $this->products = $products;
    $this->customer = $customer;
    $this->deliveryAddress = $deliveryAddress;
  }

  public function clone(): Order
  {
    $order = new Order($this->products, $this->customer, $this->deliveryAddress);

    return $order;
  }

  // Getters and setters for order details
  public function setDeliveryAddress($deliveryAddress)
  {
    $this->deliveryAddress = $deliveryAddress;
  }

  public function addProduct($product)
  {
    $this->products[] = $product;
  }

  // .. etc
}

// Tworzenie oryginalnego zamówienia
$originalOrder = new Order($products, $customer, $deliveryAddress);

// Klonowanie zamówienia
$clonedOrder = $originalOrder->clone();

// Modyfikowanie sklonowanego zamówienia
$clonedOrder->setDeliveryAddress($newAddress);
$clonedOrder->addProduct($newProduct);

// Tworzenie kolejnych zamówień na podstawie sklonowanego zamówienia
$newOrder1 = $clonedOrder->clone();
$newOrder2 = $clonedOrder->clone();
