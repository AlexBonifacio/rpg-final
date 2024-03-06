<?php

namespace Rpg\Models;

use Rpg\Models\EnemyTypes\Boss;
use Rpg\Models\EnemyTypes\Goblin;


class Combat
{

  public Player $player;
  public Enemy $enemy;
  public int $turn = 0;
  public bool $is_final_combat;
  public bool $is_over = false;

  public function __construct(Player $player, int $gameLevel)
  {
    $this->player = $player;
    if($gameLevel > 5) {
      $this->enemy = new Boss($this->player->level-2);
      $this->is_final_combat = true;
    }else {
      $this->enemy = new Goblin($this->player->level-2);
      $this->is_final_combat = false;
    }
  }

  public function turn(string $action): array
  {
    $damage = 0;
    if($action == "attack") {
      $damage = $this->player->attack($this->enemy);
    }else if($action == "heal") {
      $this->player->heal();
    }else if($action == "special") {
      $this->player->specialCapacity($this->enemy);
    }else {
      throw new \Exception("Pas d'action valide");
    }


    $enemyDamage = $this->enemy->attack($this->player);

    //if($this->turn % 3 == 0){
    // Reset facteurs à implementer dans class Player (reset des buff)
    // $this->player->resetFactors();
    //}

    // Check si l'ennemy est mort si oui fin du combat
    if($this->enemy->is_alive === false) {
      $this->is_over = true;
    }else {
      $this->turn++;
    }

    return [
      'playerDamage' => $damage,
      'enemyDamage' => $enemyDamage,
      'is_over' => $this->is_over,
      'is_win' => $this->is_over && $this->player->is_alive,
      'is_final_combat' => $this->is_final_combat
    ];

  }

}