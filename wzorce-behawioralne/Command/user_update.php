<?php

interface Command
{
  public function execute();
}

// Konkretna komenda do aktualizacji danych użytkownika
class UpdateUserCommand implements Command
{
  private $user;
  private $newDetails;

  public function __construct(User $user, array $newDetails)
  {
    $this->user = $user;
    $this->newDetails = $newDetails;
  }

  public function execute()
  {
    $this->user->update($this->newDetails);
  }
}

// Klasa User
class User
{
  private $details = [];

  public function __construct(array $details)
  {
    $this->details = $details;
  }

  public function update(array $newDetails)
  {
    // aktualizacja szczegółów użytkownika
    $this->details = array_merge($this->details, $newDetails);
    echo "User details updated.\n";
  }

  public function getDetails()
  {
    return $this->details;
  }
}

// Invoker - np. formularz w interfejsie użytkownika
class Form
{
  private $command;

  public function setCommand(Command $command)
  {
    $this->command = $command;
  }

  public function submit()
  {
    $this->command->execute();
    echo "Form submitted and command executed.\n";
  }
}

// Klient
$user = new User(['name' => 'Jan', 'email' => 'jan@example.com']);
$updateDetails = ['email' => 'nowy_jan@example.com'];




$updateUserCommand = new UpdateUserCommand($user, $updateDetails);


$form = new Form();
$form->setCommand($updateUserCommand);
$form->submit();

// Wypisz zaktualizowane dane, aby zobaczyć efekt
print_r($user->getDetails());
