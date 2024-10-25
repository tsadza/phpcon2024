<?php

interface Connectionable
{
  public function getConnection(): PDO;
}

class SuperConfigProvider
{
  public static function dbSetup(): array
  {
    return [
      'db_host' => 'localhost',
      'db_name' => 'mydatabase',
      'db_user' => 'username',
      'db_pass' => 'password',
    ];
  }
}

class DatabaseConnection
{
  private static $instance;
  private $connection;

  private function __construct()
  {
    $config = SuperConfigProvider::dbSetup();
    // Utworzenie połączenia z bazą danych
    $this->connection = new PDO('mysql:host=localhost;dbname=mydatabase', $config['db_user'], $config['db_pass']);
  }

  public static function getInstance()
  {
    if (self::$instance == null) {
      self::$instance = new DatabaseConnection();
    }

    return self::$instance;
  }

  public static function getConnection(): PDO
  {
    $instance = DatabaseConnection::getInstance();
    return $instance->connection;
  }
}

$dbConnection = DatabaseConnection::getConnection();
