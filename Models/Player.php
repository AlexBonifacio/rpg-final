<?php

namespace Rpg\Models;

// J'utilse la classe Entity dans ce fichier donc je l'appel
use Rpg\Models\Entity;

abstract class Player extends Entity
{

  public string $name;

  // if > 1 -> buff or in[0;1] debuff
  protected float $buff;

  public int $damageDealt = 1;


  public function __construct($name)
  {
    parent::__construct();
    $this->name = $name;
    $this->buff = 1.0;
  }

  public function attack(Entity $target): int
  {
    $damage = round(1 * rand(5, 13) * $this->level * $this->buff);
    $target->takeDamage($damage);
    return $damage;
  }


  public function heal(): void
  {
    $heal = 10 * $this->level * $this->buff;
    $this->receiveHeal($heal);
  }

  //Force les classes enfants à définirent une spé
  public abstract function specialCapacity(Entity $target = null): void;

  // Force les classes archetypes à donner leur archetype
  public abstract function getArchetype(): string;

}