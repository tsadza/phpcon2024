<?php

class SimpleLines
{
  private array $table = [];

  public function __construct()
  {
    for ($i = 0; $i <= rand(5, 10); $i++) {
      $this->table[] = rand(5, 20);
    }
  }

  public function draw(string $character)
  {
    foreach ($this->table as $length) {
      echo str_repeat($character, $length) . "\n";
    }
  }
}

$lines = new SimpleLines();
$lines->draw('A');
$lines->draw('B');
$lines->draw('C');

/**
 * FIXME: Brak wykorzystania wzorca Flyweight:
 * Wzorzec Flyweight jest używany do współdzielenia obiektu CharacterFlyweight między różnymi liniami. W tej implementacji każda linia tworzy i korzysta z własnych danych.
 *
 * FIXME: Brak oszczędności pamięci:
 * Wzorzec Flyweight ma na celu minimalizację zużycia pamięci poprzez współdzielenie wspólnych stanów. W tej implementacji każda linia tworzy i przechowuje własne dane, co może prowadzić do większego zużycia pamięci w porównaniu do wykorzystania wzorca Flyweight.
 *
 * FIXME: Brak elastyczności:
 * Ta implementacja nie udostępnia możliwości zmiany wartości CharacterFlyweight w locie dla różnych linii.
 */
