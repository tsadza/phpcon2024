<?php

// Wzorzec Factory Method zakłada użycie metody fabrykującej, która jest zdefiniowana w abstrakcyjnej klasie lub interfejsie i implementowana przez konkretne klasy fabryczne.


interface RenderableDocument
{
  public function render(): string;
}

class PdfDocument implements RenderableDocument
{
  public function render(): string
  {
    return "Rendering PDF...";
  }
}

class HtmlDocument implements RenderableDocument
{
  public function render(): string
  {
    return "Rendering HTML...";
  }
}

class SmsDocument implements RenderableDocument
{
  public function render(): string
  {
    return "Sending SMS...";
  }
}

abstract class DocumentFactory implements RenderableDocument
{
  abstract public function createDocument(): RenderableDocument;

  public function renderDocument(): string
  {
    $document = $this->createDocument();

    return $document->render();
  }
}

class PdfDocumentFactory extends DocumentFactory
{
  public function createDocument(): RenderableDocument
  {
    return new PdfDocument();
  }
}

class HtmlDocumentFactory extends DocumentFactory
{
  public function createDocument(): RenderableDocument
  {
    return new HtmlDocument();
  }
}

class SmsDocumentFactory extends DocumentFactory
{
  public function createDocument(): RenderableDocument
  {
    return new SmsDocument();
  }
}

class DottedLineDocument implements RenderableDocument
{
  public function render(): string
  {
    return "Rendering dotted line...";
  }
}

class DotsDocumentFactory extends DocumentFactory
{
  public function createDocument(): RenderableDocument
  {
    return new DottedLineDocument();
  }
}

// Użycie

function clientCode(DocumentFactory $factory)
{
  echo $factory->renderDocument();
}

$pdfFactory = new PdfDocumentFactory();
clientCode($pdfFactory);

$htmlFactory = new HtmlDocumentFactory();
clientCode($htmlFactory);
