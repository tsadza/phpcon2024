<?php

namespace NoObserver;

class User
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
    echo "It's {$this->name}. Wow, I like {$message} \n";
  }
}

class Publisher
{
  private $subscribers = [];

  public function attach(User $user)
  {
    $this->subscribers[] = $user;
  }

  public function detach(User $user)
  {
    $index = array_search($user, $this->subscribers);
    if ($index !== false) {
      unset($this->subscribers[$index]);
    }
  }

  public function notifyAll(string $message)
  {
    foreach ($this->subscribers as $subscriber) {
      $subscriber->mainStoryUpdated($message);
    }
  }
}

$allegro = new Publisher();
$marek = new User('Marek');
$roman = new User('Roman');
$tomasz = new User('Tomasz');

$allegro->attach($marek);
$allegro->attach($roman);
$allegro->attach($tomasz);

$allegro->notifyAll('Promocja Bitcoin za 1 zł');

$allegro->detach($tomasz);

$allegro->notifyAll('Kup pan cegłę');


/**
 * FIXME: Brak automatyzacji:
 * W tym przypadku konieczne jest ręczne wywołanie metody mainStoryUpdated na każdym subskrybencie po każdej aktualizacji. To może prowadzić do pominięcia powiadomienia dla niektórych subskrybentów lub powielania kodu.
 *
 * FIXME: Słaba kontrola:
 * Zarządzanie subskrypcjami jest przeprowadzane bezpośrednio w klasie Publisher, co może prowadzić do rozproszonego kodu i utraty kontroli nad subskrypcjami.
 *
 * FIXME: Brak elastyczności:
 * Klasa Publisher jest związana tylko z klasą User jako obserwatorem, co ogranicza elastyczność systemu.
 */
