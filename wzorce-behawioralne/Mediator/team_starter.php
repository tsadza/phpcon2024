<?php

namespace NoMediator;

interface TeamMember
{
  public function setLeader(Leader $leader);
  public function getName(): string;
  public function workInProgress(int $progress): void;
  public function notify(int $progress): void;
}

class Leader
{
  public function approveProgress(TeamMember $member, int $progress)
  {
    echo "Hello {$member->getName()} Progress {$progress} approved. \n";

    if ($member->getName() === 'Adam' && $progress === 100) {
      echo "Project completed. We can go home now \n\n\n";
    }

    if ($progress === 100) {
      echo "Good job. \n";
      $member->notify(0);
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

  public function setLeader(Leader $leader): void
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
    $this->leader->approveProgress($this, $progress);
  }

  public function notify(int $progress): void
  {
    if ($progress === 0) {
      echo "Notified, ready for new task.\n";
    }
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
$cezary->workInProgress(60);
$cezary->workInProgress(70);
$cezary->workInProgress(90);
$cezary->workInProgress(100);
$adam->workInProgress(100);


/**
 * FIXME: Zależności w dwóch kierunkach:
 * Wzajemne powiązania pomiędzy obiektami "Leader" i "Developer" tworzą silne zależności w dwóch kierunkach, co może prowadzić do trudności w zarządzaniu i utrzymaniu kodu.
 *
 * FIXME: Single Responsibility Principle:
 * Obiekt "Developer" ma teraz więcej obowiązków, ponieważ musi również zarządzać swoim stanem i powiadamiać o nim, co zwiększa złożoność klasy.
 *
 * FIXME: Brak enkapsulacji:
 * Detale implementacji są teraz bardziej widoczne pomiędzy obiektami, co narusza zasadę enkapsulacji.
 *
 * FIXME: Trudności w rozszerzaniu systemu:
 * Jeśli chcielibyśmy dodać nową rolę lub typ członka zespołu, konieczne mogą być znaczne modyfikacje w istniejących klasach, co jest niezgodne z zasadą otwarte-zamknięte (Open-Closed Principle).
 */
