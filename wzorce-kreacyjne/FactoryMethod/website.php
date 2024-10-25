<?php

// Wzorzec Factory Method zakłada użycie metody fabrykującej, która jest zdefiniowana w abstrakcyjnej klasie lub interfejsie i implementowana przez konkretne klasy fabryczne.


abstract class Website
{
  // Wspólne metody i właściwości dla wszystkich typów stron internetowych
}

class OnlineShop extends Website
{
  // Specyficzne metody i właściwości dla sklepu internetowego
}

class Blog extends Website
{
  // Specyficzne metody i właściwości dla bloga
}

class Portfolio extends Website
{
  // Specyficzne metody i właściwości dla portfolio
}

abstract class WebsiteFactory
{
  abstract public function createWebsite(): Website;
}

class OnlineShopFactory extends WebsiteFactory
{
  public function createWebsite(): Website
  {
    return new OnlineShop();
  }
}

class BlogFactory extends WebsiteFactory
{
  public function createWebsite(): Website
  {
    return new Blog();
  }
}

class PortfolioFactory extends WebsiteFactory
{
  public function createWebsite(): Website
  {
    return new Portfolio();
  }
}

// Funkcja klienta, która używa fabryki do stworzenia strony internetowej
function clientCode(WebsiteFactory $factory)
{
  $website = $factory->createWebsite();

  // checkpoint or use case..
  print_r($website);
}

// Użycie konkretnych fabryk do stworzenia różnych typów stron internetowych
$shopFactory = new OnlineShopFactory();
clientCode($shopFactory);

echo "\n";

$blogFactory = new BlogFactory();
clientCode($blogFactory);

echo "\n";

$portfolioFactory = new PortfolioFactory();
clientCode($portfolioFactory);
