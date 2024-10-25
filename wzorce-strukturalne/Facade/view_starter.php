<?php

namespace NoFacade;

class SimpleFileView
{
  private $filename;

  public function __construct(string $filename)
  {
    $this->filename = $filename;
  }

  public function checkIfThisFileExists(): bool
  {
    return file_exists('./' . $this->filename);
  }

  public function getFileContent(): string
  {
    if ($this->checkIfThisFileExists()) {
      return file_get_contents('./' . $this->filename);
    }
    return "This {$this->filename} file does not exist";
  }
}

$fileView = new SimpleFileView('foobar');
echo $fileView->getFileContent();

echo "\n\n";

$fileView = new SimpleFileView('index.php');
echo $fileView->getFileContent();

/**
 * FIXME: Brak prostoty:
 * Klient musi tworzyć nową instancję SimpleFileView i wywoływać metodę getFileContent() dla każdego pliku, zamiast po prostu wywoływać statyczną metodę ViewFacade::view(). Jest to mniej wygodne i prowadzi do bardziej skomplikowanego kodu klienta.
 *
 * FIXME: Mniejsza enkapsulacja:
 * FileView powinien być ukryty za ViewFacade, co pozwoli na łatwe zmiany w implementacji FileView bez wpływu na klienta. W powyższym kodzie, SimpleFileView jest bezpośrednio używany przez klienta, co sprawia, że każda zmiana w SimpleFileView może wpłynąć na klienta.
 *
 * FIXME: Bezpieczeństwo:
 * Klient ma bezpośredni dostęp do wszystkich metod klasy SimpleFileView, co zwiększa ryzyko nieprawidłowego użycia klasy.
 */
