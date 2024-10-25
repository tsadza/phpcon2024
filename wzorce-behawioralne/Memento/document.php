<?php

namespace Memento2;

interface MementoInterface
{
  public function save(Memento $memento): void;
  public function undo(): Memento;
}

class Memento
{
  private string $state;

  public function __construct($state)
  {
    $this->state = $state;
  }

  public function getState(): string
  {
    return $this->state;
  }
}

class Document
{
  private $content;

  public function __construct($content)
  {
    $this->content = $content;
  }

  public function setContent($content): void
  {
    $this->content = $content;
  }

  public function getContent(): string
  {
    return $this->content;
  }

  public function save(): Memento
  {
    return new Memento($this->content);
  }

  public function restore(Memento $memento): void
  {
    $this->content = $memento->getState();
  }
}

class UndoManager implements MementoInterface
{
  private $mementos = [];

  public function save(Memento $memento): void
  {
    array_push($this->mementos, $memento);
  }

  public function undo(): Memento
  {
    return array_pop($this->mementos);
  }
}

// Przykład użycia
$document = new Document("Hello World \n");
$undoManager = new UndoManager();

$undoManager->save($document->save());

$document->setContent("Hello Poland \n");
$undoManager->save($document->save());

$document->setContent("Hello Gdansk \n");
// $undoManager->save($document->save());

$document->restore($undoManager->undo());
echo $document->getContent(); // Wypisze: "Hello Poland"

// $document->restore($undoManager->undo());
echo $document->getContent(); // Wypisze: "Hello world"

print_r($undoManager);
