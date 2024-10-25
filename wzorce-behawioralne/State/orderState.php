<?php

namespace State;

interface OrderState
{
  public function proceedToNext(OrderContext $context);
  public function toString(): string;
}

class NewOrderState implements OrderState
{
  public function proceedToNext(OrderContext $context)
  {
    //
    //
    //
    //

    $context->setState(new PaidOrderState());
  }

  public function toString(): string
  {
    return 'new';
  }
}

class PaidOrderState implements OrderState
{
  public function proceedToNext(OrderContext $context)
  {
    //

    //

    //

    //
    $context->setState(new ShippedOrderState());
  }

  public function toString(): string
  {
    return 'paid';
  }
}

class ShippedOrderState implements OrderState
{
  public function proceedToNext(OrderContext $context)
  {
    $context->setState(new DeliveredOrderState());
  }

  public function toString(): string
  {
    return 'shipped';
  }
}

class DeliveredOrderState implements OrderState
{
  public function proceedToNext(OrderContext $context)
  {
    // Ostateczny stan, nie może przejść dalej
  }

  public function toString(): string
  {
    return 'delivered';
  }
}

class OrderContext
{
  private OrderState $state;

  public function __construct()
  {
    $this->state = new NewOrderState();
  }

  public function setState(OrderState $state)
  {
    $this->state = $state;
  }

  public function proceedToNext()
  {
    $this->state->proceedToNext($this);
  }

  public function toString()
  {
    return $this->state->toString();
  }
}



$orderContext = new OrderContext();
echo $orderContext->toString(); // Output: new
echo "\n";

$orderContext->proceedToNext();
echo $orderContext->toString(); // Output: paid
echo "\n";

$orderContext->proceedToNext();
echo $orderContext->toString(); // Output: shipped
echo "\n";

$orderContext->proceedToNext();
echo $orderContext->toString(); // Output: delivered
echo "\n";
