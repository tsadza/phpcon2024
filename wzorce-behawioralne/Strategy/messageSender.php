<?php

namespace Strategy;

interface MessageSender
{
  public function send($message, $recipient);
}

class EmailSender implements MessageSender
{
  public function send($message, $recipient)
  {
    echo "Sending an email to $recipient with message: $message \n";
    // Tutaj logika wysyłania email
  }
}

class SmsSender implements MessageSender
{
  public function send($message, $recipient)
  {
    echo "Sending an SMS to $recipient with message: $message \n";
    // Tutaj logika wysyłania SMS
  }
}

class PushSender implements MessageSender
{
  public function send($message, $recipient)
  {
    echo "Sending a push notification to $recipient with message: $message \n";
    // Tutaj logika wysyłania powiadomienia push
  }
}

class User
{
  private $messagingStrategy;

  public function setMessagingStrategy(MessageSender $messagingStrategy)
  {
    $this->messagingStrategy = $messagingStrategy;
  }

  public function sendMessage($message, $recipient)
  {
    $this->messagingStrategy->send($message, $recipient);
  }
}

$user = new User();

// Ustawiamy strategię na wysyłanie email
$user->setMessagingStrategy(new EmailSender());
$user->sendMessage('Hello there!', 'email@example.com');

// Zmieniamy strategię na wysyłanie SMS
$user->setMessagingStrategy(new SmsSender());
$user->sendMessage('Hello there!', '123456789');

// Zmieniamy strategię na wysyłanie powiadomienia push
$user->setMessagingStrategy(new PushSender());
$user->sendMessage('Hello there!', 'user_id_123');
