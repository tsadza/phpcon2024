<?php

namespace Memento2;

class Document
{
  private $content;
  private $history = [];

  public function __construct($content)
  {
    $this->content = $content;
    array_push($this->history, $this->content);
  }

  public function setContent($content): void
  {
    $this->content = $content;
    array_push($this->history, $this->content);
  }

  public function getContent(): string
  {
    return $this->content;
  }

  public function undo(): void
  {
    array_pop($this->history);
    $this->content = end($this->history);
  }
}

// Przykład użycia
$document = new Document("Hello World \n");

$document->setContent("Hello Poland \n");

$document->setContent("Hello Gdansk \n");

$document->undo();
echo $document->getContent(); // Wypisze: "Hello Poland"

$document->undo();
echo $document->getContent(); // Wypisze: "Hello world"


/**
 * FIXME: Single Responsibility Principle:
 * we wzorcu Memento odpowiedzialność za zarządzanie historią jest oddzielona od obiektu, którego stan jest zapisywany. W tym podejściu obie te odpowiedzialności są połączone w jednym obiekcie.
 *
 * FIXME: Złożoność:
 * Klasa Document ta nie tylko przechowuje swoją zawartość, ale również historię zmian, co zwiększa jej złożoność i odpowiedzialności
 *
 * FIXME: Rozbudowa
 * Więcej operacji na historii, takich jak przewijanie do przodu, itp. dodawałoby więcej logiki do klasy Document, co jeszcze bardziej zwiększyłoby jej złożoność.
 *
 * FIXME: Elastyczność:
 * W tym podejściu mamy tylko jeden typ obiektu, który przechowuje swoją historię, co nie jest  elastyczne.
 */
