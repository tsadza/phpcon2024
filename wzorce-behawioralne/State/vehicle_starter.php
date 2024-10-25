<?php

namespace NoState;

class Vehicle
{
  const STATE_STOPPED = 'stopped';
  const STATE_DRIVING = 'driving';

  private string $state;

  public function __construct()
  {
    $this->state = self::STATE_STOPPED;
  }

  public function drive(): void
  {
    if ($this->state === self::STATE_STOPPED) {
      echo "Starting the engine...\n";
      $this->state = self::STATE_DRIVING;
    } else {
      echo "Already driving.\n";
    }
  }

  public function stop(): void
  {
    if ($this->state === self::STATE_DRIVING) {
      echo "Stopping the vehicle...\n";
      $this->state = self::STATE_STOPPED;
    } else {
      echo "Already stopped.\n";
    }
  }
}

$car = new Vehicle();
$car->drive();
$car->drive();
$car->stop();
$car->stop();

/**
 * FIXME: Zależności:
 * Cała logika związana ze stanami i przejściami między nimi jest zagnieżdżona w klasie Vehicle. Dzięki temu kod jest mniej modularny i trudniejszy do utrzymania, zwłaszcza jeśli liczba stanów rośnie.
 *
 * FIXME: Kontrola:
 * W tym podejściu, zmiana stanu jest kontrolowana zewnętrznie, a nie przez same stany. W wyniku tego, zewnętrzny kod musi znać wszystkie możliwe stany i przejścia między nimi.
 *
 * FIXME: Enkapsulacja (brak):
 * Logika związana z każdym stanem nie jest enkapsulowana. Jeśli logika związana z jednym stanem musi być zmieniona, musimy znaleźć i zmodyfikować odpowiedni fragment kodu w metodach drive() i stop().
 *
 * FIXME: Wysoka sprzężenie:
 * Pojedyncza klasa Vehicle jest odpowiedzialna za zarządzanie wszystkimi stanami, co prowadzi do wysokiego sprzężenia między różnymi stanami i klasą Vehicle.
 *
 * FIXME: Naruszenie zasady otwarte-zamknięte:
 * Jeśli chcemy dodać nowy stan, musimy zmienić klasę Vehicle, co narusza zasadę otwarte-zamknięte, która mówi, że "klasy powinny być otwarte na rozszerzenia, ale zamknięte na modyfikacje".
 * Wzorzec State pozwoli dodać nowy stan, tworząc nową klasę, bez modyfikowania istniejących klas.
 */
