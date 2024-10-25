<?php

namespace NoComposite;

class TreeNode
{
  private $name;
  private $children = [];

  public function __construct()
  {
    $this->name = "\n_node_ ";
    $countChildren = rand(0, 10);

    for ($i = 0; $i < $countChildren; $i++) {
      $this->children[] = new TreeNode();
    }
  }

  public function getName()
  {
    $out = $this->name;
    foreach ($this->children as $child) {
      $out .= $child->getName();
    }
    return $out;
  }
}

$tree = new TreeNode();
echo $tree->getName();

/**
 * FIXME: Brak szczegółowej struktury:
 * Brak koncepcji "Branch" (gałęzi) i "Leaf" (liścia), które są naturalne dla drzewa.
 *
 * FIXME: Mniej elastyczna:
 * Jeżeli chcielibyśmy dodać więcej szczegółów do struktury drzewa, jak np. różne typy węzłów z różnymi właściwościami, byłoby to trudniejsze do zrealizowania bez wzorca Composite.
 *
 * FIXME: Wzorzec Composite umożliwia łatwe manipulowanie i reprezentowanie hierarchii obiektów. Bez użycia wzorca Composite, takie manipulacje mogą być trudniejsze do osiągnięcia i utrzymania.
 *
 * FIXME: Zasada enkapsulacji:
 * W tej implementacji, metoda getName() jest odpowiedzialna za przetwarzanie zarówno bieżącego węzła, jak i jego dzieci. To narusza zasadę enkapsulacji, która sugeruje, że każdy obiekt powinien być odpowiedzialny tylko za swoje własne dane.
 */
