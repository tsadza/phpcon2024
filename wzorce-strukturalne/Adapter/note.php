<?php

namespace Adapter;

/** interfejs NoteInterface definiuje wspólne metody
 * dla klasy Note i Adapter.
 * To pozwala na elastyczniejsze korzystanie
 * z różnych typów obiektów adaptowanych.
 * */

interface NoteInterface
{
  public function getContent(): string;
}

class Note implements NoteInterface
{
  public function getContent(): string
  {
    return "String is the default content for a note!";
  }
}

class IncomingTransmission
{
  public function get(): array
  {
    return ['And', 'I', 'want', 'to', 'become', 'a', 'regular', 'note.'];
  }
}

class Adapter implements NoteInterface
{
  private $adaptee;

  public function __construct(IncomingTransmission $adaptee)
  {
    $this->adaptee = $adaptee;
  }

  public function getContent(): string
  {
    return "Adapter: " . implode(' ', $this->adaptee->get());
  }
}

function clientCode(NoteInterface $note)
{
  echo $note->getContent();
}

clientCode(new Note());
echo "\n\n";

$adapter = new Adapter(new IncomingTransmission());
clientCode($adapter);

echo "\n\n done";
