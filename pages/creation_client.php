<?php
// PARTIE PHP


?>
<!-- PARTIE HTML -->
<div class="container">
    <form action="" method="POST">
        <section class="row">
            <div class="form-group col-sm-4">
                <label for="nom">NOM :</label>
                <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom">
            </div>
            <div class="form-group col-sm-4">
                <label for="prenom">PRENOM :</label>
                <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Prénom">
            </div>
            <div class="form-group col-sm-4">
            <label for="provenance">Provenance :</label>
                <select id="provenance" name="provenance" class="form-control">
                    <option>WEB</option>
                    <option>Prospection</option>
                </select>
            </div>
        </section>
        <section class="row">
            <div class="form-group col-sm-8">
                <label for="adresse">ADRESSE :</label>
                <input type="text" class="form-control" id="adresse" name="adresse" placeholder="Adresse">
            </div>
        </section>
        <section class="row">
            <div class="form-group col-sm-4">
                <label for="cp">CODE POSTAL :</label>
                <input type="text" class="form-control" id="cp" name="cp" placeholder="Code Postal">
            </div>
            <div class="form-group col-sm-4">
                <label for="ville">VILLE :</label>
                <input type="text" class="form-control" id="ville" name="ville" placeholder="Ville">
            </div>
            <div class="col-sm-offset-1 col-sm-2">
                <button type="submit" class="btn btn-success">Enregistrer le nouveau client</button>
            </div>
        </section>
        <section class="row">
            <div class="form-group col-sm-4">
                <label for="tel">TELEPHONNE :</label>
                <input type="text" class="form-control" id="tel" name="tel" placeholder="N° téléphone">
            </div>
            <div class="form-group col-sm-4">
                <label for="email">EMAIL :</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Adresse Email">
            </div>
        </section>
        <section class="row">
            <div class="form-group col-sm-8">
                <label for="note">NOTE :</label>
                <textarea name="note" id="note" class="form-control"  rows="10"></textarea>
            </div>
        </section>
    </form> 
</div>