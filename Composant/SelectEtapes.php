<div class="container py-4">
    <!-- Section Ordre -->
    <div class="mb-3">
    <div class="bg-light p-4 rounded shadow-md">
        <label for="ordre" class="form-label fw-bold">Ordre</label>
        <select class="ordre form-select">
            <option value="date_etape ASC, heure_etape ASC">Date (ascendant)</option>
            <option value="date_etape DESC, heure_etape DESC">Date (descendant)</option>
            <option value="nom_etape ASC">Nom (A -> Z)</option>
            <option value="nom_etape DESC">Nom (Z -> A)</option>
            <option value="ville_etape ASC">Ville (A -> Z)</option>
            <option value="ville_etape DESC">Ville (Z -> A)</option>
        </select>
   

    <!-- Section Filtre -->
    <div class="mb-3">
        <label for="filtre" class="form-label fw-bold">Filtre</label>
        <select class="form-select filtre">
            <option value="nom_etape" data-type="text">Nom</option>
            <option value="ville_etape" data-type="text">Ville</option>
            <option value="date_etape" data-type="date">Date</option>
        </select>
    </div>

    <!-- Section Valeur -->
    <div class="mb-3">
        <label for="filtreValeur" class="form-label fw-bold">Valeur</label>
        <input type="text" class="form-control filtreValeur" placeholder="Entrez une valeur">
    </div>
    </div>
</div>
