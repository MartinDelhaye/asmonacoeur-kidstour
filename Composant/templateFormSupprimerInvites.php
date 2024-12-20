<script id="templateFormSupprimerInvites" type="text/html">
  <form  action="adminSupprimer.php" method="POST">
    <select class="form-select" size="5" name="id_invite">
      {{ #.}}
      <option value="{{id_invite}}">{{nom_invite}}</option>
      {{ /. }}
    </select>
    <input type="submit"  class="btn btn-danger shadow-sm"value="Supprimer">
  </form>
</script>
