<?php

namespace NoMediator;

class TimeManagement
{
  private $payrollManagement;

  public function __construct(PayrollManagement $payrollManagement)
  {
    $this->payrollManagement = $payrollManagement;
  }

  public function registerOvertime()
  {
    // Code to register overtime...
    $this->payrollManagement->adjustSalary();
  }
}

class PayrollManagement
{
  // No changes here...
  public function adjustSalary()
  {
    // Code to adjust salary...
  }
}

class LeaveManagement
{
  private $timeManagement;

  public function __construct(TimeManagement $timeManagement)
  {
    $this->timeManagement = $timeManagement;
  }

  public function registerLeave()
  {
    // Code to register leave...
    $this->timeManagement->adjustSchedule();
  }
}

$timeManagement = new TimeManagement(new PayrollManagement());
$leaveManagement = new LeaveManagement($timeManagement);

/**
 * FIXME: Silne powiązania:
 * Obiekty są teraz silnie powiązane. Na przykład, TimeManagement musi znać PayrollManagement, a LeaveManagement musi znać TimeManagement. Jeśli chcemy dodać nowy moduł, który musi komunikować się z innymi, będzie to wymagało modyfikacji istniejących klas.
 *
 * FIXME: Brak enkapsulacji:
 * Komunikacja między obiektami jest teraz otwarta. Zasada enkapsulacji jest naruszona, ponieważ każdy obiekt musi znać szczegóły implementacji innych obiektów, aby z nimi skutecznie komunikować się.
 *
 * FIXME: Trudności w utrzymaniu i testowaniu:
 * Ze względu na silne powiązania i naruszenie enkapsulacji, kod jest teraz trudniejszy do utrzymania i testowania. Każda zmiana może mieć nieprzewidziane konsekwencje w innych częściach systemu.
 */
