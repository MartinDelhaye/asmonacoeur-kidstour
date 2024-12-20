<script id="templateFormModifInvites" type="text/html">
  <form action="adminModifier.php" method="POST">
    <select name="id_invite">
      {{ #. }}
      <option value="{{id_invite}}">{{nom_invite}}</option>
      {{ /. }}
    </select>
    <input type="submit" value="Page de modification">
  </form>
</script>