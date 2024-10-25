<?php

namespace BridgeOs;

// Implementacja
interface OperatingSystem
{
  public function run(): string;
}

// Abstrakcja - jakiś Program
abstract class Program
{
  public function __construct(protected OperatingSystem $os) {}

  abstract public function execute(): string;
}

// Specjalistyczna Abstrakcja - np.Edytor
class TextEditor extends Program
{
  public function execute(): string
  {
    if ($this->os instanceof Android) {
      return "Text Editor (" . $this->os->run() . $this->os::NAME . ") NOT WORKING. ";
    }

    return "Text Editor: " . $this->os->run();
  }
}

class WebBrowser extends Program
{
  public function execute(): string
  {
    $res = "Web Browser: " . $this->os->run();
    $res .= "<br>Web Browser opening URL: " . $this->openUrl("https://example.com");

    return $res;
  }

  public function openUrl($url): string
  {
    return "Web Browser opening URL: " . $url;
  }
}

// Konkretne implementacje - systemy operacyjne
class Linux implements OperatingSystem
{
  public function run(): string
  {
    return "Running on Linux";
  }
}

class Windows implements OperatingSystem
{
  public function run(): string
  {
    return "Running on Windows";
  }
}


// kod bazowy
$linux = new Linux();
$windows = new Windows();

$textEditorOnLinux = new TextEditor($linux);
echo $textEditorOnLinux->execute() . PHP_EOL;

$webBrowserOnWindows = new WebBrowser($windows);
echo $webBrowserOnWindows->execute() . PHP_EOL;

$textEditorOnWindows = new TextEditor($windows);
echo $textEditorOnWindows->execute() . PHP_EOL;

$webBrowserOnLinux = new WebBrowser($linux);
echo $webBrowserOnLinux->execute() . PHP_EOL;




// możliwy rozwój kodu :

class MacOS implements OperatingSystem
{
  public function run(): string
  {
    return "Running on MacOS";
  }
}

class Android implements OperatingSystem
{
  const NAME = "Android 1.00.1";
  public function run(): string
  {
    return "Running on Android";
  }
}

class Game extends Program
{
  public function execute(): string
  {
    return "Game: " . $this->os->run();
  }
}

// Przykład użycia
$gameOnLinux = new Game($linux);
echo $gameOnLinux->execute() . PHP_EOL;

// kod bazowy
$macOs = new MacOS();
$android = new Android();
$textEditorOnMac = new TextEditor($macOs);
echo $textEditorOnMac->execute() . PHP_EOL;

$textEditorOnAndroid = new TextEditor($android);
echo $textEditorOnAndroid->execute() . PHP_EOL;

// Kod można rozwijać:
// 	= Nowe systemy operacyjne bez modyfikacji klas programów.
// 	= Nowe programy bez modyfikowania klas systemów operacyjnych.
// 	= Dodatkowe metody w istniejących programach i systemach.
// 	= Specyficzne cechy lub konfiguracje, takie jak obsługa dotykowych ekranów, tryby bezpieczeństwa, itd.