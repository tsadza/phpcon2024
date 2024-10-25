<?php

namespace Composite;

interface Employee
{
  public function getSalary(): float;
}

class IndividualEmployee implements Employee
{
  private $salary;

  public function __construct(float $salary)
  {
    $this->salary = $salary;
  }

  public function getSalary(): float
  {
    return $this->salary;
  }
}

class Team implements Employee
{
  private $employees;

  public function __construct()
  {
    $this->employees = [];
  }

  public function addEmployee(Employee $employee): void
  {
    $this->employees[] = $employee;
  }

  public function getSalary(): float
  {
    $totalSalary = 0;
    foreach ($this->employees as $employee) {
      $totalSalary += $employee->getSalary();
    }
    return $totalSalary;
  }
}

$company = new Team();
$developers = new Team();
$testers = new Team();
$testers->addEmployee(new IndividualEmployee(800));
$developers->addEmployee($testers);
$managers = new Team();
$developers->addEmployee(new IndividualEmployee(1000));
$developers->addEmployee(new IndividualEmployee(1500));
$managers->addEmployee(new IndividualEmployee(5000));

$company->addEmployee($developers);
$company->addEmployee($managers);

echo $company->getSalary();

print_r($company);
