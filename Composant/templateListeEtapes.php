<!-- template Mustache -->
<script id="templateListeEtapes" type="text/html">
    <div class="container">
    {{ #. }}
            <div class="row mb-4 align-items-center text-center">
                <!-- Colonne pour l'image -->
                <div class="col-md-6 d-flex justify-content-center">
                    <img src="{{image_etape}}" class="img-fluid" alt="Image étape">
                </div>
                <!-- Colonne pour les informations -->
                <div class="col-md-6 d-flex flex-column justify-content-center">
                    <h5 class="text-danger fw-bold">{{nom_etape}}</h5>
                    <p>
                        <div class="fst-italic"> {{date_etape}}<br>
                        {{lieu_etape}}<br> </div>
                        {{description_etape}}<br>
                        <a href="etape.php?id_etape={{id_etape}}" class="btn btn-danger" >En savoir plus..</a>
                    </p>
                </div>
            </div>
        {{ /. }}
    </div>
</script>
