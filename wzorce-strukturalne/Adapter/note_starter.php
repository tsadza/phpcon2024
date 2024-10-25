<?php

namespace NoAdapter;

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

class IncomingTransmission implements NoteInterface
{
  public function get(): array
  {
    return ['And', 'I', 'want', 'to', 'become', 'a', 'regular', 'note.'];
  }

  public function getContent(): string
  {
    return implode(' ', $this->get());
  }
}

function clientCode(NoteInterface $note)
{
  echo $note->getContent();
}

clientCode(new Note());
echo "\n\n";

$client = new IncomingTransmission();
clientCode($client);

echo "\n\n done";

/**
 * FIXME: Brak separacji obowiązków:
 * Wzorzec adaptera pozwala utrzymać pojedynczą odpowiedzialność klasy IncomingTransmission dla pobierania danych, podczas gdy w naszym rozwiązaniu musi również implementować logikę konwersji danych na format zgodny z NoteInterface.
 *
 * FIXME: Trudność utrzymania:
 * Jeśli interfejs NoteInterface zmieniłby się, na przykład przez dodanie nowej metody, konieczne byłoby zaktualizowanie wszystkich klas implementujących ten interfejs, co mogłoby być trudne do zarządzania w dużym systemie.
 *
 * FIXME: Brak elastyczności:
 * Jeżeli chcemy dodać nową klasę, która ma być zgodna z NoteInterface, musimy znać specyficzny interfejs tej klasy, co może prowadzić do błędów. Wzorzec adaptera pozwala na elastyczne korzystanie z różnych typów obiektów bez konieczności zmiany istniejącego kodu.
 */
