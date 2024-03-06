<?php

namespace Rpg;

class SessionStorage
{
  public function __construct()
  {
    session_start();
  }

  public function save(string $key, mixed $value): void
  {
    $_SESSION[$key] = serialize($value);
  }

  public function get(string $key): mixed
  {
    if(isset($_SESSION[$key])) {
      return unserialize($_SESSION[$key]);
    }

    return NULL;
  }

  public function reset(): void
  {
    session_destroy();
  }
} 