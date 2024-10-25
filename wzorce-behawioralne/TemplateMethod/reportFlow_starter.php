<?php

namespace NoTemplateMethod;

interface ReportFlow
{
  public function build(array $params): void;
}

class Dataset
{
  private $data;
  public function __construct(array $data)
  {
    $this->data = $data;
  }

  public function getData()
  {
    return $this->data;
  }
}

class AbstractReport implements ReportFlow
{
  protected $reportName;
  protected $notify;

  public function build(array $params): void
  {
    $dataset = $this->query($params);
    $dataset = $this->parseDataset($dataset);
    $this->notifyManagement($dataset);
  }

  protected function query(array $params): Dataset
  {
    return new Dataset([]);
  }

  protected function parseDataset(Dataset $dataset): Dataset
  {
    return $dataset;
  }

  protected function notifyManagement(Dataset $dataset): void
  {
    if (!is_array($this->notify)) {
      return;
    }

    foreach ($this->notify as $manager) {
      echo "email to {$manager} has been sent. \n";
      echo print_r($dataset, 1) . "\n\n";
    }
  }
}

class ProjectConditionReport extends AbstractReport
{
  protected $reportName = "Custom Project Condition Report";
  protected $notify = ['team.memebers@domain.com', 'cto@domain.com'];

  protected function query(array $params): Dataset
  {
    return new Dataset([1, 2, 3, 4, 45, 55]);
  }

  protected function parseDataset(Dataset $dataset): Dataset
  {
    $total = array_reduce($dataset->getData(), function ($carry, $item) {
      return $carry + $item;
    }, 0);

    $dataset = new Dataset(array_merge($dataset->getData(), ['total' => $total]));

    return $dataset;
  }
}

$report = new ProjectConditionReport();
$report->build([]);

/**
 * FIXME: Duplikacja:
 * W obu klasach AbstractReport i ProjectConditionReport istnieje powtarzający się kod w metodach query(), parseDataset() i notifyManagement().
 *
 * FIXME: Brak jednolitej struktury:
 * Każda klasa raportu ma niezależne metody query(), parseDataset() i notifyManagement().
 *
 * FIXME: Brak elastyczności:
 * Nie ma łatwej możliwości rozszerzania funkcjonalności raportów. Dla każdej nowej funkcji raportu konieczne jest modyfikowanie kodu w każdej klasie raportu.
 *
 * FIXME: Brak kontroli nad kolejnością wywołań:
 * Kolejność wywołań zależy od implementacji w klasach raportów, co może prowadzić do problemów w przypadku dodawania lub zmiany kroków w procesie generowania raportu.
 */
