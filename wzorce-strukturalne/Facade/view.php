<?php

class ViewFacade
{
  public static function view(string $name)
  {
    $fileView = new FileView($name);
    if (!$fileView->checkIfThisFileExists()) {
      return "This {$name} file does not exist";
    }

    return $fileView->getFileContent();
  }
}

class FileView
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
    return file_get_contents('./' . $this->filename);
  }
}

echo ViewFacade::view('foobar');
echo "\n\n";
echo ViewFacade::view('view.php');
