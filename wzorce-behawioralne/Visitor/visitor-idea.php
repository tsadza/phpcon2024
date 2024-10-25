<?php

interface Element
{
  // interfejs elementu deklaruje metode ACCEPT która
  // przyjmuje argument typu interface bazowy odwiedzającego
  public function accept(Visitor $visitor);
}

class Category implements Element
{
  // wybór odpowiedniej metody Odwiedzającego oddany
  // zostaje obiektom przekazywanym odwiedzającemu w charakterze argumentu
  // tzw. podwójna dyspozycja
  public function accept(Visitor $visitor)
  {
    $visitor->visit($this);
  }

  // exclusive method w/o interface
  public function validateAvailability()
  {
    //
    // sprawdzamy elementy w kategorii .. czy są dostępne?
    //
  }
}

// -----------------------------------

interface Visitor
{
  // interface deklaruje zestaw metod służących odwiedzaniu, które
  // odpowiadają poszczególnym klasom elementów
  public function visit(Category $category);
}

// konkretni odwiedzający implementują wiele wersji tego samego algorytmu,
// które mogą działać z wszystkimi konkretnymi klasami elementów
class MenuVisitor implements Visitor
{
  public function visit(Category $category)
  {
    $category->validateAvailability();
  }
}
