<?php

interface Subsciption
{
  public function subscribe();
  public function unsubscribe();
  public function notify();
}

class SubscriptionFacade implements Subsciption
{

  public function subscribe()
  {
    $repo = new SubscribersRepository();
    $repo->addSubscriber();
  }

  public function unsubscribe()
  {
    $repo = new SubscribersRepository();
    $repo->removeSubscriber();
  }

  public function notify()
  {
    $repo = new SubscribersRepository();
    $notifier = new SubscriptionNotifier();
    $notifier->notifySubscribers($repo);
  }
}

class SubscribersRepository
{
  public function getSubscribers()
  {
  }
  public function addSubscriber()
  {
  }
}

class SubscriptionNotifier
{
  public function notifySubscribers($repo)
  {
    $repo->sendNotification();
  }
}
