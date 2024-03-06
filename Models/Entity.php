<?php

namespace Rpg\Models;

// Ne sera jamais instancier donc abstraite
abstract class Entity
{
  private int $life_points;
  public bool $is_alive;
  public float $level;
  private int $max_life_points;

  // Global life points accesible partout via la class entity
  public const REFERENCE_LIFE_POINTS = 100;

  public function __construct(int $level = 1)
  {
    $this->life_points = Entity::REFERENCE_LIFE_POINTS * $level;
    $this->is_alive = true;
    $this->level = $level;
    $this->max_life_points = $this->life_points;
  }

  public function takeDamage(int $amount): void
  {
    $this->life_points -= $amount;
    if($this->getLife() < 1) {
      $this->die();
    }
  }

  public function getLife(): int
  {
    return $this->life_points;
  }

  public function receiveHeal(int $amount): void
  {
    $this->life_points += $amount;
    // Check si on dépasse pas les points de vie max
    if($this->getLife() > $this->max_life_points) {
      $this->life_points = $this->max_life_points;
    }
  }

  public function die(): void
  {
    $this->is_alive = false;
    $this->life_points = 0;
  }

  public function levelUp(float $amount = 1): void
  {
    $this->level += $amount;
    $this->life_points = Entity::REFERENCE_LIFE_POINTS * $this->level;
    $this->max_life_points = $this->life_points;
  }
}