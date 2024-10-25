<?php

namespace NoVisitor;

// Hierarchia klas dokumentów

class Document
{
  protected $content;

  public function __construct($content = '')
  {
    $this->content = $content;
  }

  public function getContent()
  {
    return $this->content;
  }

  public function countWords()
  {
    return str_word_count($this->content);
  }
}

class TextDocument extends Document
{
  // Dodatkowe metody i właściwości dla plików tekstowych
}

class SpreadsheetDocument extends Document
{
  // Dodatkowe metody i właściwości dla arkuszy kalkulacyjnych
}

class PresentationDocument extends Document
{
  // Dodatkowe metody i właściwości dla prezentacji
}

// Wykorzystanie bez użycia wzorca Visitor

$textDocument = new TextDocument("To jest przykładowy tekst.");
$spreadsheetDocument = new SpreadsheetDocument();
$presentationDocument = new PresentationDocument();

$totalWordCount = $textDocument->countWords() + $spreadsheetDocument->countWords() + $presentationDocument->countWords();

echo "Liczba słów we wszystkich dokumentach: " . $totalWordCount;

/**
 * FIXME: Single Responsibility Principle:
 * Obiekty dokumentów są odpowiedzialne zarówno za przechowywanie danych jak i za wykonywanie operacji zliczania słów. To prowadzi do mieszania odpowiedzialności i utrudnia utrzymanie i rozbudowę kodu.
 *
 * FIXME: Brak elastyczności:
 * Jeśli chcemy dodać nowe operacje do zestawu dokumentów, musimy zmieniać implementacje wszystkich klas dokumentów. To prowadzi do silnego powiązania między klasami i utrudnia dodawanie nowych funkcjonalności.
 *
 * FIXME: Trudności w obsłudze różnych typów dokumentów:
 * Bez wzorca Visitor, musimy sprawdzać typy dokumentów ręcznie i wywoływać odpowiednie operacje dla każdego typu. To prowadzi do powielania kodu i trudniejszej obsługi różnych przypadków.
 *
 * FIXME: Open-Closed Principle:
 * Brak możliwości rozszerzania operacji dla nowych typów dokumentów. Jeśli dodamy nowy typ dokumentu, musimy zmodyfikować istniejący kod, aby dodać obsługę nowego typu dokumentu. To prowadzi do łamania zasady otwarte-zamkniętej (Open-Closed Principle).
 */
