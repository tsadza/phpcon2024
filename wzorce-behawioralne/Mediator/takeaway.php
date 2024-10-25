<?php

namespace Takeaway;

interface Mediator
{
  public function notify(string $wish);
}

class PhoneKeeper implements Mediator
{
  private array $wishes = [];

  public function notify(string $wish)
  {
    $this->wishes[] = $wish;
  }

  public function takeawayOrder()
  {
    echo "Phone Keeper is taking away the following order: \n";
    foreach ($this->wishes as $wish) {
      echo $wish . "\n";
    }
    $this->wishes = [];
  }
}

class TeamMember
{
  private Mediator $mediator;

  public function __construct(private string $name) {}

  public function getName(): string
  {
    return $this->name;
  }

  public function setMediator(Mediator $mediator)
  {
    $this->mediator = $mediator;
  }

  public function iAmHungry(string $wish)
  {
    $this->mediator->notify($wish);
  }
}

$mediator = new PhoneKeeper();

$teamMember1 = new TeamMember('Marek');
$teamMember2 = new TeamMember('Jacek');
$teamMember3 = new TeamMember('Kamil');
$teamMember4 = new TeamMember('Zosia');

$teamMember1->setMediator($mediator);
$teamMember2->setMediator($mediator);
$teamMember3->setMediator($mediator);
$teamMember4->setMediator($mediator);

$teamMember1->iAmHungry('Burger');
$teamMember2->iAmHungry('Pizza');
$teamMember3->iAmHungry('Sushi');
$teamMember4->iAmHungry('Pancakes');

$mediator->takeawayOrder();
