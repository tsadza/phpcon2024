<?php

interface ProReportGeneratorInterface
{
  public function generateReport();
}

abstract class Report implements ProReportGeneratorInterface
{
  protected  function generateHeader()
  {
    //
  }
  protected  function generateData()
  {
    //
  }
  protected function generateFooter()
  {
    echo 'thanks';
  }

  public function generateReport()
  {
    $this->generateHeader();
    $this->generateData();
    $this->generateFooter();
  }
}

class PdfReport extends Report
{
  protected function generateHeader()
  {
    // Generowanie nagłówka w formacie PDF
    echo "Generowanie nagłówka w formacie PDF\n";
  }

  protected function generateData()
  {
    // Generowanie danych w formacie PDF
    echo "Generowanie danych w formacie PDF\n";
  }

  protected function generateFooter()
  {
    // Generowanie stopki w formacie PDF
    echo "Generowanie stopki w formacie PDF\n";
  }
}

class CsvReport extends Report
{

  public function generateReport()
  {
    parent::generateReport();
    echo PHP_EOL;
  }
}

class HtmlReport extends Report
{
  protected function generateHeader()
  {
    // Generowanie nagłówka w formacie HTML
    echo "Generowanie nagłówka w formacie HTML\n";
  }

  protected function generateData()
  {
    // Generowanie danych w formacie HTML
    echo "Generowanie danych w formacie HTML\n";
  }

  protected function generateFooter()
  {
    // Generowanie stopki w formacie HTML
    echo "Generowanie stopki w formacie HTML\n";
  }
}

class SmsReport extends Report
{

  protected string $message = '';

  protected function generateHeader()
  {
    $this->message .= 'Hi,';
  }
  protected function generateData()
  {
    $this->message .= 'Your report is ready.';
  }
  public function generateReport()
  {
    parent::generateReport();
    echo $this->message . "\n";
  }
}

function clientCode(ProReportGeneratorInterface $reportGenerator)
{
  echo $reportGenerator->generateReport();
}

// Przykład użycia

clientCode(new PdfReport());
clientCode(new CsvReport());
clientCode(new HtmlReport());

clientCode(new SmsReport());
