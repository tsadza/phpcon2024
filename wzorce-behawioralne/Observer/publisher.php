<?php

namespace Observer;

interface Observer
{
  public function mainStoryUpdated(string $message);
}

interface Observable
{
  public function attach(User $user);
  public function detach(User $user);
  public function notifyAll(string $message);
}

class User implements Observer
{

  private $name;

  public function __construct(string $name)
  {
    $this->name = $name;
  }

  public function getName()
  {
    return $this->name;
  }

  public function mainStoryUpdated(string $message)
  {
    echo "{$this->name} here. Wow, {$message} !!!\n";
  }
}

class Publisher implements Observable
{

  private $subscribers = [];

  public function attach(Observer $user)
  {
    $this->subscribers[] = $user;
  }

  public function detach(User $user)
  {
    $this->subscribers = array_filter($this->subscribers, function ($subscriber) use ($user) {
      return $subscriber->getName() !== $user->getName();
    });
  }

  public function notifyAll(string $message)
  {
    echo "\n\n {$message} ...\n\n";

    foreach ($this->subscribers as $subscriber) {
      $subscriber->mainStoryUpdated($message);
    }
  }
}

$allegro = new Publisher();
$tomasz = new User('Tomasz');

$allegro->attach(new User('Marek'));
$allegro->attach(new User('Roman'));
$allegro->attach($tomasz);


$allegro->notifyAll('Promocja Bitcoin za 1 zł');

$allegro->detach($tomasz);

$allegro->notifyAll('Kup pan cegłę');
