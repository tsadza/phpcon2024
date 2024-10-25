<?php

interface Mediator
{
  public function notify(TeamMember $member, int $payload);
}

interface TeamMember
{
  public function setLeader(Mediator $mediator);
  public function getName(): string;
  public function workInProgress(int $progress): void;
}

class Leader implements Mediator
{
  public function notify(TeamMember $member, int $progress)
  {

    echo "Hello {$member->getName()} Progress {$progress} approved. \n";


    if ($member->getName() === 'Adam' && $progress === 100) {
      echo "Project completed. We can go home now \n\n\n";
    }

    if ($progress === 100) {
      echo "Good job. \n";
      //$member->workInProgress(0);
    }
  }
}

class Developer implements TeamMember
{

  private $name;
  private $leader;

  public function __construct(string $name)
  {
    $this->name = $name;
  }

  public function setLeader(Mediator $leader): void
  {
    $this->leader = $leader;
  }

  public function getName(): string
  {
    return $this->name;
  }

  public function workInProgress(int $progress): void
  {
    echo "{$this->getName()} reporting ... {$progress} % \n";
    $this->leader->notify($this, $progress);
  }
}


$adam = new Developer('Adam');
$bartek = new Developer('Bartek');
$cezary = new Developer('Cezary');

$leader = new Leader();

$adam->setLeader($leader);
$bartek->setLeader($leader);
$cezary->setLeader($leader);

$adam->workInProgress(40);
$bartek->workInProgress(20);
$cezary->workInProgress(50);
$cezary->workInProgress(100);
$adam->workInProgress(100);
