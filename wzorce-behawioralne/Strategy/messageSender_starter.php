<?php

namespace Strategy;

class User
{
  private $messageType;

  public function setMessageType($messageType = null)
  {
    $this->messageType = $messageType;
  }

  public function sendMessage($message, $recipient)
  {
    switch ($this->messageType) {
      case 'email':
        echo "Sending an email to $recipient with message: $message \n";
        // Tutaj logika wysyłania email
        break;
      case 'sms':
        echo "Sending an SMS to $recipient with message: $message \n";
        // Tutaj logika wysyłania SMS
        break;
      case 'push':
        echo "Sending a push notification to $recipient with message: $message \n";
        // Tutaj logika wysyłania powiadomienia push
        break;
      default:
        throw new \Exception("Invalid message type: $this->messageType");
    }
  }
}

$user = new User();

// Ustawiamy typ wiadomości na email
$user->setMessageType('email');
$user->sendMessage('Hello there!', 'email@example.com');

// Zmieniamy typ wiadomości na SMS
$user->setMessageType('sms');
$user->sendMessage('Hello there!', '123456789');

// Zmieniamy typ wiadomości na powiadomienie push
$user->setMessageType('push');
$user->sendMessage('Hello there!', 'user_id_123');


/**
 * FIXME:: Rozszerzalność:
 * Jeśli chcemy dodać nowy typ wysyłki wiadomości, musimy modyfikować klasę User, dodając nowy przypadek do instrukcji switch w metodzie sendMessage.
 *
 * FIXME: Single Responsibility Principle:
 * Klasa User jest teraz odpowiedzialna nie tylko za zarządzanie danymi użytkownika, ale także za implementację logiki wysyłania różnych typów wiadomości.
 *
 * FIXME:: Testowanie:
 * Klasa User jest teraz trudniejsza do przetestowania, ponieważ każda zmiana w logice wysyłania wiadomości wymaga modyfikacji testów dla klasy User. W przypadku użycia wzorca Strategii, moglibyśmy testować każdą strategię wysyłania wiadomości niezależnie.
 *
 * FIXME:: Duplikacja:
 * Jeśli logika wysyłania wiadomości jest skomplikowana, może pojawić się wiele powtarzających się fragmentów kodu w różnych przypadkach instrukcji switch,  co nie jest dobrą praktyką.
 *
 * FIXME:: Debug:
 * Błędy związane z wysyłaniem konkretnego typu wiadomości mogą być trudniejsze do znalezienia i naprawy, ponieważ są ukryte wewnątrz klasy User, zamiast być izolowane w swoich własnych klasach strategii.
 *
 */
