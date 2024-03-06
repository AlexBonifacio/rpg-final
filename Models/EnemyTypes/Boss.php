<?php

namespace Rpg\Models\EnemyTypes;

use Rpg\Models\Entity;
use Rpg\Models\Enemy;

class Boss extends Enemy
{
  public function getEnemyType(): string
  {
    return "Boss";
  }


}