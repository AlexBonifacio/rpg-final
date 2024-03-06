<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mon super RPG</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="public/game.css" rel="stylesheet">
</head>
<body>
<div class="container mt-3">
    <h1 class="text-center mb-3">Gab Quest</h1>

    <div class="p-2">
      <?php $game->run(); ?>
    </div>

    <div class="fixed-bottom end-0 m-3 font-monospace border game-logs-container bg-body-secondary">
        <ul class="list-group list-group-flush">
          <?php foreach($game->logs as $log): ?>
              <li class="list-group-item"><?= $log ?></li>
          <?php endforeach ?>
        </ul>
    </div>

    <form method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir reprendre de 0 ?')">
        <div class="fixed-bottom m-3">
            <input type="hidden" name="form" value="reset-storage"/>
            <button type="submit" class="btn btn-info">Reset</button>
        </div>
    </form>
</div>
</body>
</html>