<?php

/**
 * W tym kodzie, HeavyGraphic reprezentuje duży obiekt graficzny,
 * który trwa długo do załadowania. GraphicProxy działa jako proxy
 * dla HeavyGraphic - pierwsze wywołanie display() powoduje,
 * że HeavyGraphic jest ładowany, a następne wywołania display()
 * są szybkie, ponieważ HeavyGraphic jest już załadowany.
 * Dzięki temu klient nie musi czekać na załadowanie HeavyGraphic
 * za każdym razem, kiedy chce go wyświetlić.
 *
 * transparentna implementacja Memoizacji
 */

namespace Proxy;

interface Graphic
{
  public function display(): void;
}

class HeavyGraphic implements Graphic
{
  public function __construct()
  {
    // Simulation of a heavy constructor process
    echo "HeavyGraphic: Loading a heavy graphic resource.\n";
    sleep(2); // simulate a delay
  }

  public function display(): void
  {
    echo "HeavyGraphic: Displaying\n";
  }
}

class GraphicProxy implements Graphic
{
  private $heavyGraphic = null;

  public function display(): void
  {
    if ($this->heavyGraphic == null) {
      $this->heavyGraphic = new HeavyGraphic();
    }
    $this->heavyGraphic->display();
  }
}

function clientCode(Graphic $graphic)
{
  // This call will be quick due to the use of the proxy.
  $graphic->display();

  // This call will be instant, as the proxy already loaded the heavy graphic.
  $graphic->display();
}

echo "Running with HeavyGraphic:\n";
$realGraphic = new HeavyGraphic();
clientCode($realGraphic);

echo "\nRunning with GraphicProxy:\n";
$proxy = new GraphicProxy();
clientCode($proxy);
clientCode($proxy);
clientCode($proxy);
