<!-- template Mustache -->
<script id="templateFormSupprimerEtapes" type="text/html">
    <form action="AdminSupprimer.php" method="POST">
      <select name="id_invite">
      {{ #. }}
        <option value="{{id_etape}}">{{ville_etape}} | {{date_etape}} | {{heure_etape}} | {{nom_etape}}</option>
      {{ /. }}
      </select>
      <input type="submit" value="Supprimer">
    </form>
</script>
