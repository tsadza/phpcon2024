<?php

namespace Composite;

interface CompositeName
{
  public function getName(): string;
}

class Leaf implements CompositeName
{
  private $name;

  public function __construct()
  {
    $this->name = '-leaf';
  }

  public function getName(): string
  {
    return $this->name;
  }
}

class Branch implements CompositeName
{

  private $name;
  private $leaves = [];
  private $branches = [];

  public function __construct()
  {
    $this->name = "\n_branch_ ";
    $countLeaves = rand(0, 10);
    $countBranches = rand(0, 2);

    for ($i = 0; $i < $countLeaves; $i++) {
      $this->leaves[] = new Leaf();
    }
    for ($i = 0; $i < $countBranches; $i++) {
      $this->branches[] = new Branch();
    }
  }

  public function getName(): string
  {
    $out = $this->name;
    foreach ($this->leaves as $leaf) {
      $out .= $leaf->getName();
    }
    foreach ($this->branches as $branch) {
      $out .= $branch->getName();
    }

    return $out;
  }
}


$tree = new Branch();
echo $tree->getName();
echo "\n\n\n\n";
// print_r($tree);

// go ahead and run multiple times ..