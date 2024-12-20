<div class="container py-4">
    <!-- Section Ordre -->
    <div class="mb-3">
    <div class="bg-light p-4 rrounded shadow-md">
        <label for="ordre" class="form-label fw-bold">Ordre</label>
        <select class="form-select ordre">
            <option value="nom_invite ASC">Nom (A → Z)</option>
            <option value="nom_invite DESC">Nom (Z → A)</option>
            <option value="prenom_invite ASC">Prénom (A → Z)</option>
            <option value="prenom_invite DESC">Prénom (Z → A)</option>
        </select>
    

    <!-- Section Filtre -->
    <div class="mb-3">
        <label for="filtre" class="form-label fw-bold">Filtre</label>
        <select class="form-select filtre">
            <option value="nom_invite" data-type="text">Nom</option>
            <option value="prenom_invite" data-type="text">Prénom</option>
        </select>
    </div>

    <!-- Section Valeur -->
    <div class="mb-3">
        <label for="filtreValeur" class="form-label fw-bold">Valeur</label>
        <input type="text" class="form-control filtreValeur" placeholder="Entrez une valeur">
    </div>
    </div>
</div>
