<?php

namespace Visitor;

// Krok 1: Zdefiniuj interfejs Visitor
interface DocumentVisitor
{
  public function visitTextDocument(TextDocument $document);
  public function visitSpreadsheetDocument(SpreadsheetDocument $document);
  public function visitPresentationDocument(PresentationDocument $document);
}

// Krok 2: Implementacja wizytatora
class WordCountVisitor implements DocumentVisitor
{
  private $wordCount = 0;

  public function visitTextDocument(TextDocument $document)
  {
    // Zliczanie słów w pliku tekstowym
    $content = $document->getContent();
    $words = str_word_count($content);
    $this->wordCount += $words;
  }

  public function visitSpreadsheetDocument(SpreadsheetDocument $document)
  {
    // Nie wykonujemy operacji na arkuszach kalkulacyjnych
  }

  public function visitPresentationDocument(PresentationDocument $document)
  {
    // Nie wykonujemy operacji na prezentacjach
  }

  public function getWordCount()
  {
    return $this->wordCount;
  }
}

// Krok 3: Zdefiniuj interfejs Element
interface Document
{
  public function accept(DocumentVisitor $visitor);
}

// Krok 4: Implementacja elementów
class TextDocument implements Document
{
  private $content;

  public function __construct($content)
  {
    $this->content = $content;
  }

  public function getContent()
  {
    return $this->content;
  }

  public function accept(DocumentVisitor $visitor)
  {
    $visitor->visitTextDocument($this);
  }
}

class SpreadsheetDocument implements Document
{
  // Implementacja arkusza kalkulacyjnego
  public function accept(DocumentVisitor $visitor)
  {
    $visitor->visitSpreadsheetDocument($this);
  }
}

class PresentationDocument implements Document
{
  // Implementacja prezentacji
  public function accept(DocumentVisitor $visitor)
  {
    $visitor->visitPresentationDocument($this);
  }
}

// Krok 5: Wykorzystanie wzorca Visitor
$textDocument = new TextDocument("To jest przykładowy tekst.");
$spreadsheetDocument = new SpreadsheetDocument();
$presentationDocument = new PresentationDocument();

$wordCountVisitor = new WordCountVisitor();

$textDocument->accept($wordCountVisitor);
$spreadsheetDocument->accept($wordCountVisitor);
$presentationDocument->accept($wordCountVisitor);

echo "Liczba słów we wszystkich dokumentach: " . $wordCountVisitor->getWordCount();
