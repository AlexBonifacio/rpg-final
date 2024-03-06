<?php

namespace Rpg\Models\EnemyTypes;

use Rpg\Models\Entity;
use Rpg\Models\Enemy;

class Goblin extends Enemy
{
  public function getEnemyType(): string
  {
    return "Gobelin";
  }
}