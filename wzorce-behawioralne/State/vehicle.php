<?php

namespace State;

interface VehicleState
{
  public function drive(): void;
  public function stop(): void;
}

class Vehicle
{
  private VehicleState $state;

  public function __construct()
  {
    $this->state = new StopState($this);
  }

  public function changeState(VehicleState $state): void
  {
    $this->state = $state;
  }

  public function drive(): void
  {
    $this->state->drive();
  }

  public function stop(): void
  {
    $this->state->stop();
  }
}

class StopState implements VehicleState
{
  private Vehicle $vehicle;

  public function __construct(Vehicle $vehicle)
  {
    $this->vehicle = $vehicle;
  }

  public function drive(): void
  {
    echo "Starting the engine...\n";
    $this->vehicle->changeState(new DrivingState($this->vehicle));
  }

  public function stop(): void
  {
    echo "Already stopped.\n";
  }
}

class DrivingState implements VehicleState
{
  private Vehicle $vehicle;

  public function __construct(Vehicle $vehicle)
  {
    $this->vehicle = $vehicle;
  }

  public function drive(): void
  {
    echo "Already driving.\n";
  }

  public function stop(): void
  {
    echo "Stopping the vehicle...\n";
    $this->vehicle->changeState(new StopState($this->vehicle));
  }
}

$car = new Vehicle();
$car->drive();
$car->drive();
$car->drive();
$car->drive();
$car->drive();
$car->drive();
$car->stop();
$car->stop();
$car->stop();
$car->stop();
$car->stop();
