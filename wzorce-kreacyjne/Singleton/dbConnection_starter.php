<?php

class DatabaseConnection
{
  private $connection;

  public function __construct()
  {
    // Utworzenie połączenia z bazą danych
    $this->connection = new PDO('mysql:host=localhost;dbname=mydatabase', 'username', 'password');
  }

  public function getConnection()
  {
    return $this->connection;
  }

  public function disconnect()
  {
    $this->connection = null;
  }
}

$dbConnection = new DatabaseConnection();
$connection = $dbConnection->getConnection();

/**
 * FIXME: Wiele instancji:
 * Bez wzorca Singleton nie ma mechanizmu uniemożliwiającego utworzenie więcej niż jednej instancji klasy. Może to prowadzić do nieprzewidywalnego zachowania i potencjalnych problemów z zarządzaniem połączeniami do bazy danych.
 *
 * FIXME: Brak globalnego dostępu:
 * Konieczne jest tworzenie i przekazywanie instancji DatabaseConnection między różnymi częściami kodu. Może to prowadzić do niepotrzebnej złożoności i utrudniać zarządzanie połączeniami w większych aplikacjach.
 *
 * FIXME: Brak kontroli dostępu:
 * Bez wzorca Singleton, każdy może tworzyć nowe instancje DatabaseConnection. To może prowadzić do przypadkowego zamknięcia i utraty połączenia z bazą danych, jeśli kilka miejsc w kodzie zamknie swoje instancje niezależnie od siebie.
 */
