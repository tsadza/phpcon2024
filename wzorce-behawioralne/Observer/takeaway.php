<?php

namespace Takeaway2;

interface Observable
{
  public function notify();
  public function subscribe(Observer $observer);
  public function unsubscribe(Observer $observer);
}

interface Observer
{
  public function update();
}

class PhoneKeeper implements Observable
{
  private array $subscribers = [];
  public function subscribe(Observer $observer)
  {
    $this->subscribers[] = $observer;
  }

  public function unsubscribe(Observer $observer)
  {
    $index = array_search($observer, $this->subscribers, true);
    if ($index !== false) {
      unset($this->subscribers[$index]);
    }
  }

  public function notify()
  {
    foreach ($this->subscribers as $subscriber) {
      $subscriber->update();
    }
  }
}

class User implements Observer
{
  public function __construct(private string $name) {}
  public function update()
  {
    echo "Hey, {$this->name} food is comming! " . PHP_EOL;
  }
}

$phoneKeeper = new PhoneKeeper();

$user1 = new User('John Doe');
$user2 = new User('King Kong');

$phoneKeeper->subscribe($user1);
$phoneKeeper->subscribe($user2);
$phoneKeeper->unsubscribe($user1);

$phoneKeeper->notify();
