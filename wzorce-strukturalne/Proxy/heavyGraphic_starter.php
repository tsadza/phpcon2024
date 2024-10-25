<?php

namespace Proxy;

class HeavyGraphic
{
  public function __construct()
  {
    // Simulation of a heavy constructor process
    echo "HeavyGraphic: Loading a heavy graphic resource.\n";
    sleep(5); // simulate a delay
  }

  public function display(): void
  {
    echo "HeavyGraphic: Displaying\n";
  }
}

function clientCode()
{
  // This call will be slow due to the direct loading of the heavy graphic.
  $graphic = new HeavyGraphic();
  $graphic->display();

  // This call will be instant, as the heavy graphic was already loaded.
  $graphic->display();
}

echo "Running client code:\n";
clientCode();
echo "Running client code:\n";
clientCode();

/**
 * FIXME: Zbędne obciążenie:
 * Klasa HeavyGraphic ładuje zasoby zawsze, gdy jest tworzona, co może prowadzić do dużego obciążenia systemu i niepotrzebnego marnowania zasobów.
 *
 * FIXME: Brak pamięci podręcznej (memoizacja):
 * Jeśli chcielibyśmy używać tych samych zasobów dla wielu instancji HeavyGraphic, nie ma tu żadnej możliwości ich przechowywania i ponownego wykorzystania. Za każdym razem, gdy tworzymy nowy obiekt HeavyGraphic, musimy ponownie ładować te same zasoby.
 */
