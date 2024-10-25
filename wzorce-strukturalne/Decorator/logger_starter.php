<?php

class FileLogger
{
  public function log(string $message)
  {
    file_put_contents('log.txt', $message . PHP_EOL, FILE_APPEND);
  }
}

class FileAndEmailLogger
{
  public function log(string $message)
  {
    file_put_contents('log.txt', $message . PHP_EOL, FILE_APPEND);
    mail('admin@example.com', 'Log message', $message);
  }
}

class FileEmailAndConsoleLogger
{
  public function log(string $message)
  {
    file_put_contents('log.txt', $message . PHP_EOL, FILE_APPEND);
    mail('admin@example.com', 'Log message', $message);
    echo $message;
  }
}

// Użycie
$logger = new FileEmailAndConsoleLogger();
$logger->log('Some message to log.');


/**
 * FIXME: DRY:
 * aby dodać nową funkcję logowania
 * (na przykład logowanie do bazy danych),
 * musiałbyś stworzyć nowe klasy
 * dla wszystkich kombinacji z tą funkcją
 */
