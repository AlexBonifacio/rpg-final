<?php

namespace Rpg;

// Appel de la class Warrior
use Rpg\Models\Archetypes\Warrior;
use Rpg\Models\Archetypes\Mage;
use Rpg\Models\Archetypes\Priest;
use Rpg\Models\Combat;
use Rpg\Models\Enemy;
use Rpg\Models\Player;

class GameEngine
{
  private SessionStorage $storage;
  public ?Player $player;
  public array $logs;
  public int $gameLevel;
  public bool $is_in_combat = false;
  public bool $gameWin = false;
  private ?Combat $combat;

  public function __construct()
  {
    $this->storage = new SessionStorage();
    $this->gameLevel = 1;

  }

  // Accède à l'objet storage afin d'alimenter les attributs dans notre moteur
  private function retrieveDataFromSession(): void
  {
    $this->logs = $this->storage->get('logs') ?: [];
    $this->player = $this->storage->get('player');
    $this->combat = $this->storage->get("combat") ?: null;
    $this->is_in_combat = $this->storage->get("is_in_combat") ?: false;
    $this->gameWin = $this->storage->get("game-win") ?: false;
    $this->gameLevel = $this->storage->get("game-level") ?: 1;
  }

  // Ajoute un message à la boîte de log en bas à droite
  private function logAction(string $action): void
  {
    $message = date("H:i:s") . " : " . $action;
    $this->logs[] = $message;
    $this->storage->save('logs', $this->logs);
  }

  // Réinitialise le storage, associé au bouton en bas à droite
  private function resetStorage(): void
  {
    $this->storage->reset();
  }

  // Utilisation du formulaire de choix de nom
  private function createPlayer(array $formData): void
  {
    if($formData["archetype"] == "warrior") {
      $this->player = new Warrior($formData["player-name"]);
    }else if($formData["archetype"] == "mage") {
      $this->player = new Mage($formData["player-name"]);
    }else if($formData["archetype"] == "priest") {
      $this->player = new Priest($formData["player-name"]);
    };+
    // add other archetypes
    $this->storage->save('player', $this->player);
    $this->logAction("Personnage créé : " . $this->player->name);
  }

  private function handleNewCombat(): void
  {
    // Créer un nouveau combat et met a jours le combat dans le game engine
    $this->combat = new Combat($this->player, $this->gameLevel);
    // Met le jeu en mode combat
    $this->is_in_combat = true;
    // Stocke le combat
    $this->storage->save('combat', $this->combat);
    $this->storage->save('is_in_combat', $this->is_in_combat);
    $this->logAction("Vous êtes en combat");
  }

  private function handleCombatTurn(array $formData): void
  {
    $this->combat->turn($formData["action"]);

    $turnResult = $this->combat->turn($formData["action"]);
    $this->logAction("Le joueur " . $this->player->name . " inflige " . $turnResult['playerDamage'] . " dégâts.");
    $this->logAction("L'ennemi inflige " . $turnResult['enemyDamage'] . " dégâts.");

    // Handle combat over
    if($turnResult["is_over"]){
      $this->is_in_combat = false;
    }
    
    // Level up
    if($turnResult["is_win"]){
      $this->player->levelUp(1);

      if($this->player->level % 10 == 0){
        $this->gameLevel++;
      }

      if($turnResult['is_final_combat']){
        $this->gameWin = true;
      }
    }
    
    // log the combat in case
    // $this->logAction("<pre>" . var_export($this->combat, true) . "</pre>");
    
    // Save des données
    $this->storage->save('combat', $this->combat);
    $this->storage->save('player',$this->player);
    $this->storage->save('is_in_combat', $this->is_in_combat);
    $this->storage->save('game-win', $this->gameWin);
    $this->storage->save('game-level', $this->gameLevel);
  }

  // Méthode appelée lorsqu'on fait soumet un formulaire,
  // utilise le champ caché "form" afin de rediriger sur la méthode associée
  // Une fois la requête traitée, on redirige sur la page par défaut
  private function handleForm(array $formData): void
  {
    // Chaque case est une action en front
    switch($formData['form']) {
      case 'reset-storage':
        $this->resetStorage();
        break;
      case 'create-player':
        $this->createPlayer($formData);
        break;
      case 'new-combat':
        $this->handleNewCombat();
        break;
      case 'combat-action':
        $this->handleCombatTurn($formData);
        break;
      default:
        $this->logAction("No form handler");
        break;
    }

    // Redirection sur la page par défaut
    header('Location: /');
    exit;
  }

  public function run(): void
  {
    // Récupération des données
    $this->retrieveDataFromSession();

    // Traitement des formulaires
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
      $this->handleForm($_POST);
    }else {
      // Choix du template d'affichage selon l'état du jeu
      if($this->gameWin){
        require 'views/win.view.php';
      }else if($this->is_in_combat) {
        require 'views/combat.view.php';
      }else if($this->player) {
        require 'views/main.view.php';
      }else {
        require 'views/player-creation.view.php';
      }
    }
  }
}