<!-- template Mustache -->
<script id="templateListeEtapes" type="text/html">
  <ul>
    {{ #. }}
      <li>
        <a href="etape.php?id_etape={{id_etape}}">
          <h3>{{nom_etape}}</h3>
          <p>Lieu : {{lieu_etape}}</p>
          <p>Date : {{date_etape}}</p>
        </a>
      </li>
    {{ /. }}
  </ul>
</script>
