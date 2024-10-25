<?php

namespace NoMemento;

class Note
{
  private $content;
  private $mementoNotes = [];

  public function __construct(string $text)
  {
    $this->setContent($text);
  }

  public function setContent(string $text)
  {
    $this->content = $text;
  }

  public function getContent(): string
  {
    return $this->content;
  }

  public function save(): void
  {
    $this->mementoNotes[] = $this->content;
  }

  public function undo(): void
  {
    $this->content = array_pop($this->mementoNotes);
  }
}


$note = new Note("abrakadabra \n");

echo $note->getContent();
$note->save();
$note->setContent("drugi stan \n");
echo $note->getContent();
$note->save();
$note->setContent("trzeci stan \n");
echo $note->getContent();

$note->undo();
echo $note->getContent();

$note->undo();
echo $note->getContent();

/**
 * FIXME: Single Responsibility Principle:
 * Obiekt Memento powinien być przechowywany poza klasą, której stan jest zapisywany
 *
 * FIXME: Enkapsulacja:
 * Stan wewnętrzny obiektu powinien być ukryty i nie powinien być dostępny bezpośrednio. Obecnie, Note zarządza swoją historią stanów, co łamie tę zasadę.
 *
 * FIXME: Niemutowalność:
 * Obiekt Memento powinien być cienkim obiektem, który przechowuje jedynie stan, bez logiki i zachowań klasy Note, inaczej mogłyby pojawić się problemy z zarządzaniem stanem i niespójnością danych
 *
 * FIXME: Bezpieczeństwo:
 * W momencie, kiedy Note przechowuje własną historię stanów, jest ryzyko, że stan tych notatek może zostać przypadkowo zmieniony. Kiedy stan jest przechowywany w osobnym obiekcie (memento), jest on chroniony przed przypadkowymi zmianami.
 */
