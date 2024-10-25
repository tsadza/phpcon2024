<?php

class MyIterator implements \Iterator
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

  public function key(): mixed
  {
    return $this->position;
  }

  public function next(): void
  {
    $this->position += 2;
  }

  public function current(): mixed
  {
    return $this->collection->getItems()[$this->position];
  }

  public function valid(): bool
  {
    return isset($this->collection->getItems()[$this->position]);
  }
}

class WordsCollection implements \IteratorAggregate
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

  public function getIterator(): Traversable
  {
    return new MyIterator($this);
  }
}


$collection = new WordsCollection();

$sentence = explode(' ', "Crazy lazy dog i walking by the sea");

foreach ($sentence as $word) {
  $collection->addItem($word);
}

echo "Hello \n\n";
foreach ($collection->getIterator() as $item) {
  echo "- {$item} \n";
}
