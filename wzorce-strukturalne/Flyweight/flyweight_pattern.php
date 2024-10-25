<?php
  
class ProductFlyweight {
  private $name;
  private $brand;
  private $material;
  
  public function __construct($name, $brand, $material) {
    $this->name = $name;
    $this->brand = $brand;
    $this->material = $material;
  }
  
  public function getProductDetails() {
    return "Produkt: {$this->name}, Marka: {$this->brand}, Materiał: {$this->material}";
  }
}

// Flyweight Factory - Zarządzanie współdzielonymi obiektami
class ProductFlyweightFactory {
  private $products = [];
  
  public function getProduct($name, $brand, $material) {
    $key = md5($name . $brand . $material);
    
    if (!isset($this->products[$key])) {
      $this->products[$key] = new ProductFlyweight($name, $brand, $material);
    }
    
    return $this->products[$key];
  }
  
  public function getTotalProducts() {
    return count($this->products);
  }
}

// Context - Warianty produktu (zmienne dane)
class ProductContext {
  private $flyweight;
  private $size;
  private $color;
  
  public function __construct(ProductFlyweight $flyweight, $size, $color) {
    $this->flyweight = $flyweight;
    $this->size = $size;
    $this->color = $color;
  }
  
  public function displayProduct() {
    $details = $this->flyweight->getProductDetails();
    echo "{$details}, Rozmiar: {$this->size}, Kolor: {$this->color}<br>";
  }
}

// Przykład użycia:
$factory = new ProductFlyweightFactory();

// Produkty o tych samych wspólnych cechach, ale różnych wariantach (rozmiar, kolor)
$context1 = new ProductContext($factory->getProduct('T-shirt', 'Nike', 'Bawełna'), 'M', 'Czarny');
$context2 = new ProductContext($factory->getProduct('T-shirt', 'Nike', 'Bawełna'), 'L', 'Biały');
$context3 = new ProductContext($factory->getProduct('T-shirt', 'Adidas', 'Poliester'), 'M', 'Czerwony');

// Wyświetlenie szczegółów
$context1->displayProduct();
$context2->displayProduct();
$context3->displayProduct();

// Sprawdzenie ilości współdzielonych obiektów
echo "Liczba współdzielonych produktów: " . $factory->getTotalProducts() . "<br>";

