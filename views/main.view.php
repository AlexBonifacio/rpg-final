<p class="lead">
    C'est ici que tout commence <strong><?= $this->player->name ?></strong>, la
    classe <?= $this->player->getArchetype() ?> est un choix judicieux pour aller au bout de cette aventure.
</p>
<p>Vous avez 50 niveaux à accomplir.</p>

<p>Vous êtes au niveau : <?= $this->player->level ?></p>
<p>Le niveau de jeu est : <?= $this->gameLevel ?></p>

<?php
if(isset($this->combat)):
if($this->combat->is_over):
?>

<p><strong>Bravo !</strong> vous avez gagnez votre combat</p>

<?php
endif;
endif;
?>

<form method="post">

    <input type="hidden" value="new-combat" name="form">
    <button type="submit" class="btn btn-primary">Entrer dans un combat</button>

</form>