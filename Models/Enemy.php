<?php

namespace Rpg\Models;

use Rpg\Models\Entity;

abstract class Enemy extends Entity
{

  protected float $buff_enemy = 1.0;

  public abstract function getEnemyType(): string;


  public function attack(Entity $target): int
  {
    $damage = 1 * rand(4, 12) * $this->level * $this->buff_enemy;
    $target->takeDamage($damage);
    return $damage;
  }
}