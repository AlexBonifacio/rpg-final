<p class="lead">
    Soyez la bienvenue sur Gab Quest, entrez le nom de votre personnage pour commencer l'aventure.
</p>

<form method="POST">
    <div class="mb-3">
        <label class="form-label">Nom du personnage</label>
        <input type="text" name="player-name" class="form-control"/>
    </div>


    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <label class="input-group-text" for="inputGroupSelect01">Archetype de votre joueur</label>
        </div>
        <select class="custom-select" name="archetype" id="archetype">
            <option value="warrior">Guerrier</option>
            <option value="priest">Prêtre</option>
            <option value="mage">Mage</option>
        </select>
    </div>

    <input type="hidden" name="form" value="create-player"/>

    <button type="submit" class="btn btn-primary">Créer</button>
</form>
