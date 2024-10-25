<?php

namespace Repository;

interface UserRepositoryInterface
{
  public function find($id);
  public function save(User $user);
  public function remove(User $user);
}

class UserRepository implements UserRepositoryInterface
{
  private $users = [];

  public function find($id)
  {
    return isset($this->users[$id]) ? $this->users[$id] : null;
  }

  public function save(User $user)
  {
    $this->users[$user->getId()] = $user;
  }

  public function remove(User $user)
  {
    unset($this->users[$user->getId()]);
  }
}


class User
{
  private int $id;
  public function __construct()
  {
    $this->id = rand(1, 100);
  }

  public function getId(): int
  {
    return $this->id;
  }
}
