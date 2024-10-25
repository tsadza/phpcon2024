<?php

namespace AdapterPattern;

interface TimeManagementInterface
{
  public function registerOvertime();
  public function adjustSchedule();
}

interface PayrollManagementInterface
{
  public function adjustSalary();
}

interface LeaveManagementInterface
{
  public function registerLeave();
}

// Implementacje interfejsów
class TimeManagementAdapter implements TimeManagementInterface
{
  private $payrollManagement;

  public function __construct(PayrollManagementInterface $payrollManagement)
  {
    $this->payrollManagement = $payrollManagement;
  }

  public function registerOvertime()
  {
    // Kod do rejestracji nadgodzin...
    $this->payrollManagement->adjustSalary();
  }

  public function adjustSchedule()
  {
    // Kod do dostosowania harmonogramu...
  }
}

class PayrollManagementAdapter implements PayrollManagementInterface
{
  private $payrollManagement;

  public function __construct(PayrollManagement $payrollManagement)
  {
    $this->payrollManagement = $payrollManagement;
  }

  public function adjustSalary()
  {
    $this->payrollManagement->adjustSalary();
  }
}

class LeaveManagementAdapter implements LeaveManagementInterface
{
  private $timeManagement;

  public function __construct(TimeManagementInterface $timeManagement)
  {
    $this->timeManagement = $timeManagement;
  }

  public function registerLeave()
  {
    // Kod do rejestracji urlopu...
    $this->timeManagement->adjustSchedule();
  }
}

// ------------------------------------

class PayrollManagement
{
  public function adjustSalary()
  {
    // Kod do dostosowania wynagrodzenia...
  }
}

class LeaveManagement
{
  private $leaveManagement;

  public function __construct(LeaveManagementInterface $leaveManagement)
  {
    $this->leaveManagement = $leaveManagement;
  }

  public function registerLeave()
  {
    $this->leaveManagement->registerLeave();
  }
}

// Tworzenie obiektów za pomocą adapterów
$payrollManagement = new PayrollManagement();
$payrollManagementAdapter = new PayrollManagementAdapter($payrollManagement);

$timeManagementAdapter = new TimeManagementAdapter($payrollManagementAdapter);
$leaveManagementAdapter = new LeaveManagementAdapter($timeManagementAdapter);

$leaveManagement = new LeaveManagement($leaveManagementAdapter);

// $leaveManagement bez silnych powiązań
$leaveManagement->registerLeave();
