<script id="templateFormSupprimerInvites" type="text/html">
  <form action="AdminSupprimer.php" method="POST">
    <select name="id_invite">
      {{ #.}}
      <option value="{{id_invite}}">{{nom_invite}}</option>
      {{ /. }}
    </select>
    <input type="submit" value="Supprimer">
  </form>
</script>
