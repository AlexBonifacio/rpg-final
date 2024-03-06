
<?php
if(!$this->combat->is_over):
?>
<h1> <?= $this->combat->player->name ?> vous entrez dans un combat</h1>

<p>Player : <?= $this->combat->player->name ?><br>Vie : <?= $this->combat->player->getLife(); ?></p>
<p>Enemy : <?= "Le " . $this->combat->enemy->getEnemyType() . " a " ?><br> <?= $this->combat->enemy->getLife(); ?> points de vie</p>

<form method="post">
    <input type="hidden" value="combat-action" name="form">
    <label for="action"><?= $this->combat->player->name ?> il est temps de choisir votre meilleur atout</label>
    <select name="action" id="action">
        <option value="attack">Attaquer</option>
        <option value="heal">Healer</option>
        <option value="special">Pouvoir antique</option>
    </select>
    <button type="submit" class="btn btn-primary">Lancer le tour</button>
</form>

<?php
else:
?>

<h3><strong>Bravo !</strong> Vous avez gagnez votre combat contre le <?= $this->combat->enemy->getEnemyType() ?></h3>
<a href="/"><button class="btn btn-primary">Sortir du combat</button></a>

<pre>

<?= var_dump($this) ?>

</pre>

<?php
endif;
?>