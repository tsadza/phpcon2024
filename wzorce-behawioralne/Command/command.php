<?php

namespace Command;

interface CommandInterface
{
  public function execute();
}

abstract class Command implements CommandInterface
{

  protected $order;

  public function __construct(Order $order)
  {
    $this->order = $order;
  }

  public function execute() {}
}

class OpenOrderCommand extends Command
{
  public function execute()
  {
    $this->order->open();
  }
}

class ProcessOrderCommand extends Command
{
  public function execute()
  {
    $this->order->process();
  }
}

class CloseOrderCommand extends Command
{
  public function execute()
  {
    $this->order->close();
  }
}

// -----------

class Order
{
  private $number;
  private $progress = 0;

  public function __construct(string $number)
  {
    $this->number = $number;
  }

  public function open()
  {
    echo "order {$this->number} is now open \n";
  }

  public function process()
  {
    $this->progress += 10;
    echo "processing order : {$this->progress} %\n";
  }

  public function close()
  {
    echo "order is now closed \n";
  }
}


$order = new Order('ABC 11');
$open = new OpenOrderCommand($order);
$process = new ProcessOrderCommand($order);
$close = new CloseOrderCommand($order);

foreach (
  [
    $open,
    $process,
    $process,
    $process,
    $process,
    $close,
    $open,
    $process,
    $process,
    $process,
    $process,
    $process,
    $process,
    $close
  ] as $command
) {
  $command->execute();
}
