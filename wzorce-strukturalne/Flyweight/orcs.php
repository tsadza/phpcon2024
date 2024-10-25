<?php

class GameCharacter
{
  private array $attributes = [];
  public function __construct(private string $profile) {}
  public function addAttribute(string $attribute): void
  {
    $this->attributes[] = $attribute;
  }

  public function countAttributes(): int
  {
    return count($this->attributes);
  }

  public function shout(string $name): string
  {
    return "{$this->profile}: Aaahhh! I'm an orc {$name}! I have {$this->countAttributes()} attributes!";
  }
}

class OrcsFactory
{

  private array $orcFlyweigths = [];

  public function create(string $profile): GameCharacter
  {
    $key = $profile;
    if (!isset($this->orcFlyweigths[$key])) {
      $this->orcFlyweigths[$key] = $this->createOrc($profile);
    }
    return $this->orcFlyweigths[$key];
  }

  private function createOrc(string $profile): GameCharacter
  {
    $orc = new GameCharacter($profile);
    $orc->addAttribute('Strength');
    $orc->addAttribute('Intelligence');
    $orc->addAttribute('Agility');
    $orc->addAttribute('Luck');
    return $orc;
  }
}

$orcFactory = new OrcsFactory();
$archer = $orcFactory->create('Archer');
$warrior = $orcFactory->create('Warrior');
$warrior2 = $orcFactory->create('Warrior');
$gatekeeper = $orcFactory->create('Gatekeeper');

echo $archer->shout('Titan');
echo PHP_EOL;
$warrior->addAttribute('Fire Resistance');
echo $warrior->shout('Ragnarok');
echo PHP_EOL;
echo $warrior2->shout('Blacky');
echo PHP_EOL;
echo $gatekeeper->shout('Gronn');
echo PHP_EOL;
