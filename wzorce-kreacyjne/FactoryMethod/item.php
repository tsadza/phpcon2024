<?php


// Wzorzec Factory Method zakłada użycie metody fabrykującej, która jest zdefiniowana w abstrakcyjnej klasie lub interfejsie i implementowana przez konkretne klasy fabryczne.



interface FactoryMethod
{
  public function create(): Product;
}

abstract class Product
{
  // Abstrakcyjna klasa Product może zawierać wspólne metody lub właściwości dla produktów
}

class Item extends Product
{
  // Konkretna klasa Item może mieć specyficzne właściwości i metody
}

class ItemFactory implements FactoryMethod
{
  public function create(): Product
  {
    return new Item();
  }
}

function clientCode(FactoryMethod $factory)
{
  $product = $factory->create();

  // some use case or checkpoint ..
  print_r($product);
}

// Użycie

$itemFactory = new ItemFactory();
clientCode($itemFactory);
