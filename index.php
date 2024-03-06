<?php

function psr4_autoloader($class)
{
  // On retire le Rpg\ par défaut
  $prefix = 'Rpg\\';

  if(str_starts_with($class, $prefix)) {
    $classPath = str_replace($prefix, '', $class);
    // On remplace les \ par des /
    $classPath = str_replace('\\', '/', $classPath);

    // Transformation de la classe en chemin relatif
    $file = __DIR__ . '/' . $classPath . '.php';

    if(file_exists($file)) {
      require $file;
    }
  }

}

spl_autoload_register('psr4_autoloader');

$game = new Rpg\GameEngine();

require 'views/game.view.php';