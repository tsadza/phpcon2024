<?php

// Wzorzec Abstract Factory zakłada, że mamy fabrykę tworzącą rodziny powiązanych obiektów. Dlatego powinniśmy zdefiniować interfejs fabryki oraz konkretne fabryki tworzące różne typy zamówień.


namespace AbstractFactory;

interface Mouse
{
  public function click();
  public function doubleClick();
  public function scroll(int $direction);
}

interface Keyboard
{
  public function connect();
}

interface Printable
{
  public function print();
}


interface ComputerPeripheralsFactory
{
  public function createMouse(): Mouse;
  public function createKeyboard(): Keyboard;
  public function createPrinter(): Printable;
}

class GamingMouse implements Mouse
{
  // implementacja interfejsu Mouse
}

class GamingKeyboard implements Keyboard
{
  // implementacja interfejsu Keyboard
}

class GamingPeripheralsFactory implements ComputerPeripheralsFactory
{
  public function createMouse(): Mouse
  {
    return new GamingMouse();
  }

  public function createKeyboard(): Keyboard
  {
    return new GamingKeyboard();
  }
}

class OfficeMouse implements Mouse
{
  // implementacja interfejsu Mouse
}

class OfficeKeyboard implements Keyboard
{
  // implementacja interfejsu Keyboard
}

class OfficePeripheralsFactory implements ComputerPeripheralsFactory
{
  public function createMouse(): Mouse
  {
    return new OfficeMouse();
  }

  public function createKeyboard(): Keyboard
  {
    return new OfficeKeyboard();
  }
}

// Kod klienta
function clientCode(ComputerPeripheralsFactory $factory)
{
  $mouse = $factory->createMouse();
  $keyboard = $factory->createKeyboard();

  // ...
}

// Stosowanie wzorca
clientCode(new GamingPeripheralsFactory());
clientCode(new OfficePeripheralsFactory());
