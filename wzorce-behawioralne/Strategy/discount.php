<?php

namespace Strategy;

interface Discount
{
  public function calculateDiscount(float $price): float;
}

class NoDiscount implements Discount
{
  public function calculateDiscount(float $price): float
  {
    return 0;
  }
}

class CouponDiscount implements Discount
{
  public function calculateDiscount(float $price): float
  {
    return $price > 100 ? 10 : 0;
  }
}

class BlackFridayDiscount implements Discount
{
  public function calculateDiscount(float $price): float
  {
    return 0.3 * $price;
  }
}

class Checkout
{
  private $price;
  private $discountStrategy;

  public function __construct(float $price, Discount $discount)
  {
    $this->price = $price;
    $this->discountStrategy = $discount;
  }

  public function getTotalPrice(): float
  {
    return $this->price - $this->discountStrategy->calculateDiscount($this->price);
  }
}

class CheckoutFactory
{
  public static function create($price, $discountType): Checkout
  {

    switch ($discountType) {
      case 'black_friday':
        $discount = new BlackFridayDiscount($price);
        break;
      case 'coupon':
        $discount = new CouponDiscount($price);
        break;
      default:
        $discount = new NoDiscount($price);
    }

    return new Checkout($price, $discount);
  }
}

echo (new Checkout(150, new BlackFridayDiscount(150)))->getTotalPrice();

echo (CheckoutFactory::create(144, 'coupon'))->getTotalPrice();
echo "\n\n";
echo (CheckoutFactory::create(144, 'blue monday'))->getTotalPrice();
echo "\n\n";
