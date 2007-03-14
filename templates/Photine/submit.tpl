{include file="header.tpl"}

<table border="0" width="1016" align="center">
		<tr>
			<td>
<div align="center">
	<table height="192" width="1029" border="0" cellpadding="0" cellspacing="0" >
		<!--DWLayoutTable--><tr>
			<td>&nbsp;</td>
			<td valign="middle" colspan="6">
			<p align="center">
			<img border="0" src="images/ytlogo.gif" width="198" height="48">&nbsp;&nbsp;
			<img border="0" src="images/google.gif" width="150" height="48">&nbsp;&nbsp;
			<img border="0" src="images/dailymotion.jpg" width="147" height="48"></td>
			<td height="72">&nbsp;</td>
			</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td valign="middle" colspan="2">
				<div align="center">
					<form action="process.php" method="post">
					<input type="text" name="videourl" size="50" /> 
				</div>
			</td>
			<td valign="middle">
				<select name='catigory'>
{section name=catigories loop=$catigories}
		<option value='{$catigories[catigories].name}'>{$catigories[catigories].name}</option>
{/section}
				
				</select>
			</td>
			<td valign="middle" colspan="3">
				&nbsp;
				<input name="submit" type="submit" value="Submit Video" />
				</form>
			</td>
			<td>&nbsp;</td>
			<td height="30">&nbsp;</td>
			</tr>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td width="332"></td>
			<td width="37"></td>
			<td></td>
			<td></td>
			<td height="14"></td>
			</tr>
		<tr>
			<td width="253">&nbsp;</td>
			<td width="55">&nbsp;</td>
			<td width="26">&nbsp;</td>
			<td valign="top" colspan="2">
			<p align="center"><span class="style2"><span class="style3">&nbsp;<?php echo LAN_37; ?></span>:<u>
			http://www.youtube.com/watch?v=jr3JEwXtudA
			</u><span class="style3">&nbsp;</span></span>
			<p align="center"><span class="style2"><span class="style3"><?php echo LAN_37; ?></span>:<u>
			http://video.google.com/videoplay?docid=-6459339159268485356</u></span></td>
			<td width="83">&nbsp;</td>
			<td width="14">&nbsp;</td>
			<td height="76" width="229">&nbsp;</td>
		</tr>
	</table></div>
{include file="footer.tpl"}