<?php

namespace Rpg\Models\Archetypes;

use Rpg\Models\Entity;
use Rpg\Models\Player;

class Warrior extends Player
{

  public function specialCapacity(\Rpg\Models\Entity $target = null): void
  {
    $this->buff += 0.3;
  }

  public function getArchetype(): string
  {
    return "Guerrier";
  }
}