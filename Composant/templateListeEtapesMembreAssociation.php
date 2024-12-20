
  <!-- Template Mustache -->
  <script id="templateListeEtapes" type="text/html">
    <div class="row g-4 justify-content-center">
      {{ #. }}
        <div class="col-md-6 col-lg-4 d-flex justify-content-center">
          <div class="card h-100 shadow-sm text-center">
            <div class="card-body">
              <h5 class="card-title text-danger">{{nom_etape}}</h5>
              <p class="card-text text-danger"><strong>Lieu :</strong> {{lieu_etape}}</p>
              <p class="card-text text-danger"><strong>Date :</strong> {{date_etape}}</p>
            </div>
            <div class="card-footer">
              <a href="etape.php?id_etape={{id_etape}}" class="btn btn-primary">Voir l'étape</a>
            </div>
          </div>
        </div>
      {{ /. }}
    </div>
  </script>
