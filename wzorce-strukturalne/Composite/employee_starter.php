<?php

namespace NoComposite;

class SimpleEmployee
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

class SimpleTeam
{
  private $employees;

  public function __construct()
  {
    $this->employees = [];
  }

  public function addEmployee(SimpleEmployee $employee): void
  {
    $this->employees[] = $employee;
  }

  public function getTeamSalary(): float
  {
    $totalSalary = 0;
    foreach ($this->employees as $employee) {
      $totalSalary += $employee->getSalary();
    }
    return $totalSalary;
  }
}

/**
 * FIXME: Brak Polimorfizmu:
 * IndividualEmployee i Team mogą być traktowane jako jeden i ten sam typ Employee, co pozwala na bardziej ogólne i elastyczne użycie tych klas. W tym kodzie SimpleEmployee i SimpleTeam są traktowane jako dwa różne typy, co ogranicza możliwości ich użycia.
 *
 * FIXME: Brak Rekurencji:
 * Budowanie drzewiastej struktury zespołów, gdzie zespół może składać się z innych zespołów - w tym przypadku nie jest możliwe.
 *
 * FIXME: Mniej Elastyczna:
 * Jeżeli chcielibyśmy dodać więcej szczegółów do struktury, jak np. różne typy pracowników z różnymi właściwościami, byłoby to trudniejsze do zrealizowania bez wzorca Composite.
 *
 * FIXME: Zasada Enkapsulacji:
 * Metoda getTeamSalary() jest odpowiedzialna za sumowanie zarówno wynagrodzenia pracowników, co narusza zasadę enkapsulacji, która sugeruje, że każdy obiekt powinien być odpowiedzialny tylko za swoje własne dane.
 */
