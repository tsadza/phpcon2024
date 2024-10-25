<?php

namespace ChainOfResponsibility;

interface Handler
{
  public function setNext(Handler $handler): Handler;
  public function handle(string $request): ?string;
}

abstract class AbstractHandler implements Handler
{
  private $nextHandler = null;

  public function setNext(Handler $handler): Handler
  {
    $this->nextHandler = $handler;
    return $handler;
  }

  public function handle(string $request): ?string
  {
    if ($this->nextHandler) {
      return $this->nextHandler->handle($request);
    }
    return null;
  }
}

class Helpdesk extends AbstractHandler
{
  public function handle(string $request): ?string
  {
    if ($request === "software") {
      return "Helpdesk obsługuje zgłoszenie dotyczące oprogramowania.\n";
    }

    return parent::handle($request);
  }
}

class SystemAdmin extends AbstractHandler
{
  public function handle(string $request): ?string
  {
    if ($request === "network") {
      return "SystemAdmin obsługuje zgłoszenie dotyczące sieci.\n";
    }

    return parent::handle($request);
  }
}

class Developer extends AbstractHandler
{
  public function handle(string $request): ?string
  {
    if ($request === "system_bug") {
      return "Developer obsługuje zgłoszenie dotyczące błędu systemu.\n";
    }

    return parent::handle($request);
  }
}

function clientCode(Handler $handler)
{
  foreach (['software', 'network', 'system_bug', 'never'] as $type) {
    echo "\n";
    echo "Klient: Kto obsługuje zgłoszenie dotyczące $type?\n";
    $result = $handler->handle($type);

    if ($result) {
      echo "  $result";
    } else {
      echo "  Nikt nie obsłużył zgłoszenia.\n";
    }
  }
}

$helpdesk = new Helpdesk();
$systemAdmin = new SystemAdmin();
$developer = new Developer();

$helpdesk->setNext($systemAdmin)->setNext($developer);

clientCode($helpdesk);
