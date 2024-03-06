<?php

namespace Rpg\Models\Archetypes;

use Rpg\Models\Entity;
use Rpg\Models\Player;

class Mage extends Player
{
  public function specialCapacity(\Rpg\Models\Entity $target = null): void
  {
    $damage = round(1 * rand(9, 17) * $this->level * $this->buff);
    $target->takeDamage($damage);
  }
  public function getArchetype(): string
  {
    return "Mage";
  }
}