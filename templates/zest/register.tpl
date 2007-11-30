{include file="header.tpl"}
			<div class="left_articles">
				<h2>New Member Registration</h2>
                <form id="register" name="register" method="post" action="register.php">
				  <table width="50%" border="0" align="center" cellpadding="5" cellspacing="10">
                    <tr>
                      <td width="28%">Username</td>
                      <td width="72%"><input name="user" type="text" id="user" maxlength="80" /></td>
                    </tr>
                    <tr>
                      <td>Email</td>
                      <td><input name="email" type="text" id="email" maxlength="255" /></td>
                    </tr>
                    <tr>
                      <td>Password</td>
                      <td><input type="password" name="passwrd1" id="passwrd1" /></td>
                    </tr>
                    <tr>
                      <td>Verify</td>
                      <td><input type="password" name="passwrd2" id="passwrd2" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td align="left"><input type="submit" name="register" id="register" value="Create New Account" /></td>
                    </tr>
                  </table>
              </form>
		  </div>
			</div>	
{include file="footer.tpl"}