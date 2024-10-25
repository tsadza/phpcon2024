<?php

namespace NoBuilder;

class User
{
  private $username;
  private $password;
  private $permissions;

  public function __construct($username, $password, $permissions)
  {
    $this->username = $username;
    $this->password = $password;
    $this->permissions = $permissions;
  }

  public function displayUser()
  {
    echo "Username: " . $this->username . "\n";
    echo "Password: " . $this->password . "\n";
    echo "Permissions: " . implode(', ', $this->permissions) . "\n";
  }
}

// Przykład użycia
$adminUser = new User("admin", "admin123", ['create', 'read', 'update', 'delete']);
$adminUser->displayUser();

$regularUser = new User("user", "user123", ['read']);
$regularUser->displayUser();

/**
 * FIXME: Długa lista argumentów konstruktora:
 * Jeśli mamy wiele opcjonalnych składników użytkownika, kilkanaście i więcej, to konstruktor klasy staje się długi i nieczytelny, szczególnie gdy wiemy, że pojawi się więcej opcji w przyszłości.
 *
 * FIXME: Brak elastyczności:
 * Bez wzorca Builder, konstrukcja obiektu jest związana z jednym miejscem utworzenia. Trudniej jest dodać lub zmienić opcje konfiguracji obiektu, co ogranicza elastyczność w tworzeniu różnych kombinacji obiektów
 *
 * FIXME: Trudności w zarządzaniu:
 * Bez wzorca Builder, kod staje się bardziej skomplikowany i trudniejszy do zarządzania, szczególnie gdy dodajemy więcej opcji lub konfiguracji. Może być trudno śledzić i zarządzać różnymi kombinacjami wartości dla obiektów.
 */
