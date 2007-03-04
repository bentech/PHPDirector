<?php
define("PHPdirector", 1);
define("submtitab", 1);
?>
<?php
require("header.php");
?>

&nbsp;<table border="0" width="1016" align="center">
		<tr>
			<td>
<div align="center">
	<table height="183" width="1029" border="0" cellpadding="0" cellspacing="0" >
		<!--DWLayoutTable--><tr>
			<td>&nbsp;</td>
			<td rowspan="3" valign="top">
			<img src="images/ytlogo.gif" alt="You Tube Link:" width="198" height="48" /><p>&nbsp;<img src="images/google.gif" alt="Google Video Link:"/><sup>BETA</sup>
			</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td height="38">&nbsp;</td>
			</tr>
		<tr>
			<td>&nbsp;</td>
			<td valign="middle">
			<div align="center">
				<form action="process.php" method="post">
					<input type="text" name="videourl" size="50" /> </div></td>
			<td valign="top" colspan="2">
			<input name="submit" type="submit" value="Submit Video" /></form></td>
			<td height="26">&nbsp;</td>
			</tr>
		<tr>
			<td>&nbsp;</td>
			<td width="358">&nbsp;</td>
			<td width="12">&nbsp;</td>
			<td>&nbsp;</td>
			<td height="43">&nbsp;</td>
			</tr>
		<tr>
			<td width="140">&nbsp;</td>
			<td width="198">&nbsp;</td>
			<td valign="top" colspan="2">
			<p align="center"><span class="style2"><span class="style3">&nbsp;Example</span>:<u>http://www.youtube.com/watch?v=jr3JEwXtudA</u><span class="style3">&nbsp;</span></span><p align="center">
			<span class="style2"><span class="style3">Example</span>:<u>http://video.google.com/videoplay?docid=-6459339159268485356</u></span></td>
			<td width="108">&nbsp;</td>
			<td width="213" height="76">&nbsp;</td>
			</tr>
	</table></div>
<?php include("footer.php")?>