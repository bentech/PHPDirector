{include file="admin_header.tpl"}

<font color="#990000">{$error |default:"Login"}&nbsp;</font>
<form action="login.php?do=login" method="post" onsubmit="return aValidator();" id="frmLogin"> 
  <div align="center">
			User:
			<input type="text" name="username" id="txtUserId" />
	 		Password:
			<input type="password" name="password" id="txtPassword" />

	<div style="visibility:hidden">	<input name="remme" type="checkbox" checked="checked" /></div>
			<input type="submit" name="submit" value="Login"  id="btnLogin" />
			</div>
        </form>
		
</body>
</html>