<!-- template Mustache -->
<script id="templateListeInvites" type="text/html">
    <div class="container">
    {{ #. }}
            <a href="invite.php?id_invite={{id_invite}}"> </a>
                <div class="row mb-4 align-items-center text-center">
                    <!-- Colonne pour l'image -->
                    <div class="col-md-6 d-flex justify-content-center">
                        <img src="{{image_invite}}" class="img-fluid" alt="Image invité">
                    </div>
                    <!-- Colonne pour les informations -->
                    <div class="col-md-6 d-flex flex-column justify-content-center">
                        <h5 class="text-danger fw-bold">{{nom_invite}} {{prenom_invite}} </h5>
                        <p>
                            {{description_invite}}<br>
                            <a href="invite.php?id_invite={{id_invite}}" class="btn btn-danger">Découvrir</a>
            
                        </p>
                    </div>
                </div>
            
            
        {{ /. }}
    </div>
</script>


    
            