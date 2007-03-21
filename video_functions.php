<?php
/*
+ ----------------------------------------------------------------------------+
|     PHPDirector.
|		$License: GNU General Public License
|		$Website: phpdirector.co.uk
+----------------------------------------------------------------------------+
*/
class video_views{
	function add_views(){
		$new_views = $row["views"] + 1;
		mysql_query("UPDATE pp_files SET views = '$new_views'
		WHERE id = '$_GET[$id]'");
	}
	function get_views(){
		$display_video_views = $row["views"];
		echo LAN_32.":<b>$display_video_views</b>";
	}
}
add_views();
?>