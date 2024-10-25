<?php

interface ReportFlow
{
  public function build(): void;
  public function prepareParameters(array $params): void;
  public function query(): Dataset;
  public function parseDataset(): Dataset;
  public function notifyManagment(): void;
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

abstract class AbstractReport implements ReportFlow
{

  protected $reportName = 'Generic Report';
  protected $parameters = [];
  protected $dataset;
  protected $notify = ['nobody@gmail.com'];

  public function build(): void
  {
    $this->dataset = $this->query();
    $this->dataset = $this->parseDataset();
    $this->notifyManagment();
  }

  public function prepareParameters(array $params): void
  {
    $this->parameters = $params;
  }

  public function query(): Dataset
  {
    return new Dataset([]);
  }

  public function parseDataset(): Dataset
  {
    return $this->dataset;
  }

  public function notifyManagment(): void
  {
    if (!is_array($this->notify)) {
      return;
    }

    foreach ($this->notify as $manager) {
      echo "email to {$manager} has been send. \n";
      echo print_r($this->dataset, 1) . "\n\n";
    }
  }
}

class ProjectConditionReport extends AbstractReport
{
  protected $reportName = "Custom Project Condition Report";
  protected $notify = ['team.memebers@domain.com', 'cto@domain.com'];

  public function query(): Dataset
  {
    return new Dataset([1, 2, 3, 4, 45, 55]);
  }

  public function parseDataset(): Dataset
  {
    $total = array_reduce($this->dataset->getData(), function ($carry, $item) {
      return $carry + $item;
    }, 0);

    $this->dataset = new Dataset(array_merge($this->dataset->getData(), ['total' => $total]));

    return $this->dataset;
  }
}


$report = new ProjectConditionReport();
$report->build();
