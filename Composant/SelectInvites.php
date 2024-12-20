<div class="container py-4">
    <!-- Section Ordre -->
    <div class="mb-3">
        <label for="ordre" class="form-label fw-bold">Ordre</label>
        <select class="ordre" class="form-select">
            <option value="nom_invite ASC">Nom (A → Z)</option>
            <option value="nom_invite DESC">Nom (Z → A)</option>
            <option value="prenom_invite ASC">Prénom (A → Z)</option>
            <option value="prenom_invite DESC">Prénom (Z → A)</option>
        </select>
    </div>

    <!-- Section Filtre -->
    <div class="mb-3">
        <label for="filtre" class="form-label fw-bold">Filtre</label>
        <select class="filtre" class="form-select">
            <option value="nom_invite" data-type="text">Nom</option>
            <option value="prenom_invite" data-type="text">Prénom</option>
        </select>
    </div>

    <!-- Section Valeur -->
    <div class="mb-3">
        <label for="filtreValeur" class="form-label fw-bold">Valeur</label>
        <input type="text" class="filtreValeur" class="form-control" placeholder="Entrez une valeur">
    </div>
</div>
