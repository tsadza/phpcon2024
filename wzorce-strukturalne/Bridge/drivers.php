<?php

namespace Drivers;

interface PackageAbstractInterface
{
  public function getDescription(): string;
  public function getWeight(): float;
  public function sendPackage();
}

interface TransportImplementationInterface
{
  public function deliverPackage(PackageAbstractInterface $package): void;
}

// paczka => kurier
// premium paczka => express
// cargo paczka => cargo transport


class Package implements PackageAbstractInterface
{
  public function __construct(private string $description, private  float $weight) {}

  public function getDescription(): string
  {
    return $this->description;
  }
  public function getWeight(): float
  {
    return $this->weight;
  }
  public function sendPackage(): void
  {
    echo "Sending package: " . $this->getDescription() . "\n";
  }
}

class PremiumPackage extends Package
{
  public function getDescription(): string
  {
    echo "Heavy load ! ";
    return parent::getDescription();
  }
}

class CargoPackage extends Package {}


class Courier implements TransportImplementationInterface
{
  public function deliverPackage(PackageAbstractInterface $package): void
  {
    echo "Delivering package using courier: " . $package->getDescription() . "\n";
  }
}

class ExpressCourier implements TransportImplementationInterface
{
  public function deliverPackage(PackageAbstractInterface $package): void
  {
    if ($package instanceof PremiumPackage) {
      echo "Delivering PREMIUM package using express courier: " . $package->getDescription() . "\n";
      return;
    }
    echo "Delivering package using lazy courier (3d++): " . $package->getDescription() . "\n";
  }
}

class CargoCourier implements TransportImplementationInterface
{
  public function deliverPackage(PackageAbstractInterface $package): void
  {
    echo "Delivering package using cargo courier: " . $package->getDescription() . "\n";
  }
}

class ExpressDelivery implements TransportImplementationInterface
{
  public function deliverPackage(PackageAbstractInterface $package): void
  {
    if ($package instanceof PremiumPackage) {
      echo "Delivering EXPRESS PREMIUM package using express delivery: " . $package->getDescription() . "\n";
      return;
    }
    if ($package->getWeight() > 5) {
      echo "Oooooo... so heavy ! ";
    }
    echo "nothing. No express delivery for this package. \n";
  }
}

// użycie
$package = new Package("Pizza", 2.5);
$premiumPackage = new PremiumPackage("Premium pizza", 3.0);
$cargo = new CargoPackage("Cargo pizza box", 15);

$courier = new Courier();
$expressCourier = new ExpressCourier();
$cargoCourier = new CargoCourier();
$expressDelivery = new ExpressDelivery();

$courier->deliverPackage($package);
$expressCourier->deliverPackage($package);
$cargoCourier->deliverPackage($package);
$expressDelivery->deliverPackage($package);
echo PHP_EOL;
$courier->deliverPackage($premiumPackage);
$expressCourier->deliverPackage($premiumPackage);
$cargoCourier->deliverPackage($premiumPackage);
$expressDelivery->deliverPackage($premiumPackage);
echo PHP_EOL;
$courier->deliverPackage($cargo);
$expressCourier->deliverPackage($cargo);
$cargoCourier->deliverPackage($cargo);
$expressDelivery->deliverPackage($cargo);
echo PHP_EOL;



class PackageDispatcherService
{
  public static function dispatchPackage(PackageAbstractInterface $package)
  {
    if ($package->getWeight() > 50) {
      $transport = new CargoCourier();
    } elseif ($package->getWeight() > 5) {
      $transport = new ExpressDelivery();
    } elseif ($package instanceof PremiumPackage) {
      $transport = new ExpressCourier();
    }

    $transport->deliverPackage($package);
  }
}
