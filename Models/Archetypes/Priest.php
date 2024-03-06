<?php

namespace Rpg\Models\Archetypes;

use Rpg\Models\Entity;
use Rpg\Models\Player;

class Priest extends Player
{
  public function specialCapacity(\Rpg\Models\Entity $target = null): void
  {
    $heal = 30 * $this->level * $this->buff;
    $this->receiveHeal($heal);
  }
  public function getArchetype(): string
  {
    return "Prêtre";
  }
}