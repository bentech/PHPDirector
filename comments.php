<?php
$result = mysql_query("SELECT * FROM pp_comments WHERE video_id='$_GET[id]' ORDER BY id DESC LIMIT 5");
while($row = mysql_fetch_array($result)){
echo"
<table border='1' width='450' cellpadding=\"3\">
<tr><td>
	<b>By:</b> " . $row["ip"] . "
</td></tr>
<tr><td>
	<b>Comment:</b> " . $row["comment"] . "
</td></tr>
</table>
";
}
echo"
<br>
<form action='videos.php?id=" . $_GET["id"] ."' method='POST'>
Message:<br><TEXTAREA name='comment' rows='10' cols='30'></TEXTAREA>
<br>
<input type='submit' value='Submit'>";
?>