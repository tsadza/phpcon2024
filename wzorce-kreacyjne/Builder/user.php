<?php

namespace Builder;

// Klasa reprezentująca użytkownika
class User
{
  private $username;
  private $password;
  private $permissions;

  public function setUsername($username)
  {
    $this->username = $username;
  }

  public function setPassword($password)
  {
    $this->password = $password;
  }

  public function setPermissions($permissions)
  {
    $this->permissions = $permissions;
  }

  public function displayUser()
  {
    echo "Username: " . $this->username . "\n";
    echo "Password: " . $this->password . "\n";
    echo "Permissions: " . implode(', ', $this->permissions) . "\n";
  }
}

// Interfejs Builder
interface UserBuilder
{
  public function setUsername($username);
  public function setPassword($password);
  public function setPermissions($permissions);
  public function getResult(): User;
}

// Klasa ConcreteBuilder
class UserBuilderImpl implements UserBuilder
{
  private $user;

  public function __construct()
  {
    $this->user = new User();
  }

  public function setUsername($username)
  {
    $this->user->setUsername($username);
  }

  public function setPassword($password)
  {
    $this->user->setPassword($password);
  }

  public function setPermissions($permissions)
  {
    $this->user->setPermissions($permissions);
  }

  public function getResult(): User
  {
    return $this->user;
  }
}

// Klasa Director
class UserDirector
{
  private $builder;

  public function __construct(UserBuilder $builder)
  {
    $this->builder = $builder;
  }

  public function buildAdminUser($username, $password)
  {
    $this->builder->setUsername($username);
    $this->builder->setPassword($password);
    $this->builder->setPermissions(['create', 'read', 'update', 'delete']);
  }

  public function buildRegularUser($username, $password)
  {
    $this->builder->setUsername($username);
    $this->builder->setPassword($password);
    $this->builder->setPermissions(['read']);
  }
}

// Przykład użycia
$builder = new UserBuilderImpl();
$director = new UserDirector($builder);

// Budowa użytkownika administratora
$director->buildAdminUser("admin", "admin123");
$adminUser = $builder->getResult();
$adminUser->displayUser();

// Budowa zwykłego użytkownika
$director->buildRegularUser("user", "user123");
$regularUser = $builder->getResult();
$regularUser->displayUser();
