<?php

namespace UserProxy;

interface PerformTasks
{
  public function getName(): string;
  public function performAdminTask(): void;
}

class AdminUser implements PerformTasks
{
  private $name;

  public function __construct(string $name)
  {
    $this->name = $name;
  }

  public function getName(): string
  {
    return $this->name;
  }

  public function performAdminTask(): void
  {
    echo "Admin {$this->name} is performing an admin task.\n";
  }
}

class ACLProxy implements PerformTasks
{
  private array $allowedUsers = ['admin1', 'admin2'];
  private  $realSubject;

  public function as(PerformTasks $realSubject)
  {
    $this->realSubject = $realSubject;
    return $this;
  }

  public function getName(): string
  {
    return $this->realSubject->getName();
  }

  public function performAdminTask(): void
  {
    if ($this->isAllowed()) {
      $this->realSubject->performAdminTask();
    } else {
      echo "Access denied. You are not an allowed user.\n";
    }
  }

  private function isAllowed(): bool
  {
    return in_array($this->realSubject->getName(), $this->allowedUsers);
  }
}

// code base
$adminUser = new AdminUser('admin1');
$proxy = new ACLProxy();
$proxy->as($adminUser)->performAdminTask(); // Admin admin1 is performing an admin task.

$unauthorizedUser = new AdminUser('unauthorized');
$unauthorizedProxy = new ACLProxy();
$unauthorizedProxy->as($unauthorizedUser)->performAdminTask(); // Access denied. You are not an allowed user.
