{if isset($errorMessage)}
<div align="center"><strong><font color="#990000">{$error}</font></strong></div>
  <?php
{/if}
<form action="login.php" method="post" name="frmLogin" id="frmLogin">
  <div align="center">
    <p>&nbsp;</p>
    <p><span class="categoria_h">{$admin_39}:</span>
      <input name="txtUserId" type="text" id="txtUserId">
      <span class="categoria_h">{$admin_40}:</span>
      <input name="txtPassword" type="password" id="txtPassword">
    </p>
    <p>
      <input name="btnLogin" type="submit" id="btnLogin" value="Login">
    </p>
  </div>
</form>
</body>
</html>