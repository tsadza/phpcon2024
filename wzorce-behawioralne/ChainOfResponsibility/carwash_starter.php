<?php

namespace NoChainOfResponsibility;

class Vehicle
{
  private $name;

  public function __construct(string $name)
  {
    $this->name = $name;
  }

  public function getName(): string
  {
    return $this->name;
  }
}

class Carwash
{
  public function wash(Vehicle $vehicle, array $steps)
  {
    echo "\n\n\nWelcome to carwash {$vehicle->getName()} ! \n";

    foreach ($steps as $step) {
      switch ($step) {
        case "wheels":
          echo "cleaning {$vehicle->getName()} wheels and tires \n";
          break;
        case "shampoo":
          echo "shampoo all over .. \n";
          break;
        case "rinse":
          echo "{$vehicle->getName()} is rinsed from top down \n";
          break;
        case "dry":
          echo "dry with hot air \n";
          break;
        case "wax":
          echo "waxing {$vehicle->getName()} with premium wax \n";
          break;
        case "checkout":
          echo "Thank you {$vehicle->getName()}, come again ! \n";
          break;
        default:
          throw new \Exception("Unknown step: $step");
      }
    }
  }
}

$carwash = new Carwash();
$vehicle = new Vehicle('Volvo');
$carwash->wash($vehicle, ["wheels", "shampoo", "rinse", "dry", "wax", "checkout"]);

$vehicle = new Vehicle('Opel');
$carwash->wash($vehicle, ["shampoo", "rinse", "checkout"]);

/**
 * FIXME: Single Responsibility Principle:
 * Wszystkie kroki procesu mycia pojazdu są zaimplementowane w jednej klasie (Carwash), co prowadzi do naruszenia zasady Single Responsibility. W przeciwnym razie, używając wzorca Chain of Responsibility, każdy krok jest oddzielnym handlerem, co pozwala na łatwe modyfikacje i rozbudowę.
 *
 * FIXME: Brak hermetyzacji:
 * Wszystkie szczegóły kroków procesu mycia pojazdu są widoczne dla klienta. Klient musi znać wszystkie dostępne kroki i w jakiej kolejności powinny być wykonane. W przypadku wzorca Chain of Responsibility, te szczegóły są ukryte w handlerach i klient musi tylko skonfigurować łańcuch.
 *
 * FIXME: Mniej elastyczne:
 * Ten kod jest mniej elastyczny w przypadku zmian. Jeżeli chcielibyśmy dodać nowy krok do procesu mycia samochodu, musielibyśmy dodatkowo zmodyfikować klasę Carwash, podczas gdy w przypadku Chain of Responsibility wystarczyłoby dodać nowy handler.
 *
 * FIXME: Potrzeba ręcznego zarządzania błędami:
 * Bez wzorca Chain of Responsibility, musimy ręcznie obsługiwać sytuacje, w których podany jest nieznany krok (patrz default w instrukcji switch). W przypadku Chain of Responsibility, taka sytuacja byłaby obsługiwana automatycznie - jeśli żaden handler nie mógłby obsłużyć żądania, po prostu by przeszło przez cały łańcuch bez efektu.
 *
 */
