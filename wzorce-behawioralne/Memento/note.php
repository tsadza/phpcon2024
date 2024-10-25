<?php

namespace Memento;

interface MementoInterface
{
  public function save(): Memento;
  public function restore(Memento $memento): void;
}

class Note implements MementoInterface
{
  private $content;

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

  public function save(): Memento
  {
    return new Memento($this->content);
  }

  public function restore(Memento $memento): void
  {
    $this->content = $memento->getContent();
  }
}

class Memento
{
  private $content;

  public function __construct(string $content)
  {
    $this->content = $content;
  }

  public function getContent(): string
  {
    return $this->content;
  }
}

class NoteHistory
{
  private $history = [];

  public function save(Note $note): void
  {
    $this->history[] = $note->save();
  }

  public function undo(Note $note): void
  {
    if (!empty($this->history)) {
      $memento = array_pop($this->history);
      $note->restore($memento);
    }
  }
}


$note = new Note("abrakadabra \n");
$history = new NoteHistory();

echo $note->getContent();
$history->save($note);
$note->setContent("drugi stan \n");
echo $note->getContent();
$history->save($note);
$note->setContent("trzeci stan \n");
echo $note->getContent();

$history->undo($note);
echo $note->getContent();

$history->undo($note);
echo $note->getContent();
