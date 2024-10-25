<?php

namespace NoIterator;



class SimpleIterator
{
  private $collection;
  private $position = 0;

  public function __construct($collection)
  {
    $this->collection = $collection;
  }

  public function rewind(): void
  {
    $this->position = 0;
  }

  public function key()
  {
    return $this->position;
  }

  public function next(): void
  {
    $this->position++;
  }

  public function current()
  {
    return $this->collection->getItems()[$this->position];
  }

  public function valid(): bool
  {
    return isset($this->collection->getItems()[$this->position]);
  }
}

class SimpleWordsCollection
{
  private $items = [];

  public function getItems()
  {
    return $this->items;
  }

  public function addItem($item)
  {
    $this->items[] = $item;
  }

  public function getIterator(): SimpleIterator
  {
    return new SimpleIterator($this);
  }
}

$collection = new SimpleWordsCollection();

$sentence = explode(' ', "Crazy lazy dog is walking by the sea");

foreach ($sentence as $word) {
  $collection->addItem($word);
}

echo "Hello \n\n";
$iterator = $collection->getIterator();
for ($iterator->rewind(); $iterator->valid(); $iterator->next()) {
  $item = $iterator->current();
  echo "- {$item} \n";
}

/**
 * FIXME: Brak interfejsów Iterator i IteratorAggregate:
 * Wzorzec korzysta z wbudowanych interfejsów, co ułatwia iterację i tworzenie kolekcji. W tym kodzie te interfejsy są zastąpione odpowiednimi klasami i metodami, co prowadzi do bardziej skomplikowanego kodu.
 *
 * FIXME: Mniej elastyczna:
 * Nie korzysta z wbudowanych interfejsów i klas do iteracji i tworzenia kolekcji. W przypadku dodania innych typów kolekcji lub zmiany sposobu iteracji, kod musiałby być zmodyfikowany.
 *
 * FIXME: Mniejsza czytelność:
 * Używamy pętli for i jawnie wywołujemy metody rewind(), valid() i next(), co może sprawić, że kod będzie trudniejszy do zrozumienia dla osób, które nie są zaznajomione z tą implementacją iteracji.
 */
