<script id="templateFormModifEtapes" type="text/html">
  <form action="adminModifier.php" method="POST">
    <select name="id_etape">
      {{ #. }}
      <option value="{{id_etape}}">{{ville_etape}} | {{date_etape}} | {{heure_etape}} | {{nom_etape}}</option>
      {{ /. }}
    </select>
    <input type="submit" value="Page de modification">
  </form>
</script>