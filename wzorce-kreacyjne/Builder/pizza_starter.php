<?php

namespace NoBuilder;

class Pizza
{
  private $content = '';

  public function add(string $something): void
  {
    $this->content .= $something . "\n";
  }

  public function about(): string
  {
    return $this->content;
  }
}

class Director
{
  public static function getPepperoni(): Pizza
  {
    $pizza = new Pizza();
    $pizza->add(" + pizza dough");
    $pizza->add(" + pizza tomato sauce");
    $pizza->add(" + Pepperoni");
    $pizza->add(" + Cheese");
    $pizza->add(" + Cheese");
    $pizza->add(" .... baking");
    $pizza->add(" / / /  slicing");

    return $pizza;
  }

  public static function getMargherita(): Pizza
  {
    $pizza = new Pizza();
    $pizza->add(" + pizza dough");
    $pizza->add(" + pizza tomato sauce");
    $pizza->add(" + Cheese");
    $pizza->add(" .... baking");
    $pizza->add(" / / /  slicing");

    return $pizza;
  }
}

$pepperoni = Director::getPepperoni();
echo $pepperoni->about();

$margherita = Director::getMargherita();
echo $margherita->about();

/**
 * FIXME: Duplikacja:
 * W tym przypadku, kod tworzenia pizzy jest powielany w każdej funkcji fabrykującej w klasie Director. To prowadzi do duplikacji kodu i utrudnia wprowadzanie zmian, zwłaszcza jeśli potrzebne jest zmienienie procesu tworzenia pizzy.
 *
 * FIXME: Brak modularności:
 * Bez wzorca Builder, konstrukcja pizzy jest silnie powiązana z klasą Director, co prowadzi do braku modularności. Dodanie nowych opcji lub zmian w procesie tworzenia pizzy wymaga modyfikacji bezpośrednio w funkcjach fabrykujących.
 *
 * FIXME: Brak elastyczności:
 * Bez wzorca Builder, trudniej jest dodać lub zmienić opcje konfiguracji pizzy w prosty sposób. Konstrukcja pizzy jest sztywna i nieelastyczna, ponieważ każda funkcja fabrykująca ma z góry ustalone kroki i składniki.
 */
