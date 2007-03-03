<?php
define("PHPdirector", 1);
define("submtitab", 1);
?>
<?php
require("header.php");
?>

<br>
<br>
	<table border="0" width="1016" align="center">
		<tr>
			<td>
<div align="center">
	<table height="68" width="1029" border="0" cellpadding="0" cellspacing="0" >
		<!--DWLayoutTable--><tr>
			<td></td>
			<td rowspan="3" valign="top">
			<img src="images/ytlogo.gif" alt="You Tube Link:" width="198" height="48" />
			</td>
			<td rowspan="3" valign="middle">
			<div align="center">
				<form action="process_youtube.php" method="post">
					<input type="text" name="ytstring" size="50" /> </div></td>
			<td></td>
			<td height="13"></td>
			</tr>
		<tr>
			<td>&nbsp;</td>
			<td valign="top">
			<input name="submit" type="submit" value="Submit Video" /></form></td>
			<td height="26">&nbsp;</td>
			</tr>
		<tr>
			<td></td>
			<td></td>
			<td height="13"></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td valign="top">
			<p align="center"><span class="style2"><span class="style3">&nbsp;Example</span>:<u>http://www.youtube.com/watch?v=jr3JEwXtudA</u></span></td>
			<td></td>
			<td height="15"></td>
			</tr>
		<tr>
			<td width="140"></td>
			<td width="198"></td>
			<td width="358"></td>
			<td width="120"></td>
			<td height="1" width="213"></td>
		</tr>
		<tr>
			<td></td>
			<td rowspan="3" valign="top">
			<img src="images/google.gif" alt="Google Video Link:"/><sup>BETA</sup>
			</td>
			<td rowspan="3" valign="middle">
			<div align="center">
				<form action="processgoogle.php" method="post">
					<input type="text" name="gvideo" size="50" /> </div></td>
			<td></td>
			<td height="13"></td>
			</tr>
		<tr>
			<td>&nbsp;</td>
			<td valign="top">
			<input name="submit" type="submit" value="Submit Video" /></form></td>
			<td height="26">&nbsp;</td>
			</tr>
		<tr>
			<td></td>
			<td></td>
			<td height="13"></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td valign="top">
			<p align="center"><span class="style2"><span class="style3">&nbsp;Example</span>:<u>http://video.google.com/videoplay?docid=-6459339159268485356</u></span></td>
			<td></td>
			<td height="15"></td>
			</tr>
		<tr>
			<td width="140"></td>
			<td width="198"></td>
			<td width="358"></td>
			<td width="120"></td>
			<td height="1" width="213"></td>
		</tr>
	</table></div>
<?php include("footer.php")?>