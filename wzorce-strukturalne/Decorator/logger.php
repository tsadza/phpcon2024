<?php

namespace Decorator;

interface Logger
{
  public function log(string $message);
}

class FileLogger implements Logger
{
  public function log(string $message)
  {
    file_put_contents('log.txt', $message . PHP_EOL, FILE_APPEND);
  }
}

abstract class LoggerDecorator implements Logger
{
  protected $logger;

  public function __construct(Logger $logger)
  {
    $this->logger = $logger;
  }
}

class EmailLogger extends LoggerDecorator
{
  public function log(string $message)
  {
    $this->logger->log($message);
    // dodatkowo wysyłamy email
    mail('admin@example.com', 'Log message', $message);
  }
}

class ConsoleLogger extends LoggerDecorator
{
  public function log(string $message)
  {
    $this->logger->log($message);
    // dodatkowo wyświetlamy na konsoli
    echo $message;
  }
}

// Użycie
$logger = new FileLogger();
//$logger = new EmailLogger($logger);
$logger = new ConsoleLogger($logger);

$logger->log('Some message to log.');
