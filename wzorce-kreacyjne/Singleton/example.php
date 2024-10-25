<?php

final class Singleton
{

  private static $instance = null;

  private function __construct()
  {
    //
  }

  public static function getInstance(): Singleton
  {
    if (self::$instance == null) {
      self::$instance = new Singleton();
    }

    return self::$instance;
  }
}

$mySingleton = Singleton::getInstance();
$yourSingleton = Singleton::getInstance();

if ($mySingleton === $yourSingleton) {
  echo "Same instance";
} else {
  echo "Different instances";
}
