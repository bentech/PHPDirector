<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>PHP Director -Youtube Image Fixer</title>
</head>

<body>
<?php 
require("config.php");

$mysql_link = mysql_connect($cfg["db_host"], $cfg["db_user"], $cfg["db_pass"]) or die(mysql_error());
echo "Connected<br />";


mysql_select_db($cfg["db_name"], $mysql_link) or die(mysql_error());
echo "Selected DB<br />";

//$sql = "SELECT * FROM `pp_files` WHERE `picture` LIKE '%static-02%'";
$sql = "SELECT * FROM `pp_files` WHERE `picture` LIKE '%static-%' AND `video_type` = 'dailymotion'";
echo "Found Images<br />";

$result = mysql_query($sql, $mysql_link);

while ($row = mysql_fetch_array($result)) {
 $id = $row['id'];
   echo '<br /><b>Old Url</b>'.$row['picture'].'<br />';
   $motion = explode(".dailymotion.com", $row['picture']);
  // echo "http://limelight-424.static.dailymotion.com".$motion[1];
   echo '<img src="http://limelight-424.static.dailymotion.com'.$motion[1].'" />';
   echo "<br />";
  
  
  mysql_query('UPDATE `pp_files` SET `picture` = \'http://limelight-424.static.dailymotion.com'.$motion[1].'\' WHERE id = '.$id.' LIMIT 1;');
}

mysql_free_result($result);
?>
---<br />
Copyright Ben Swanson 2007<br />
---<br />
Thanks for using the script
</body>

</html>
