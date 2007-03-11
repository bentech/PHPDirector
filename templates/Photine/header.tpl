<div id='content'>	
<div id='header'>
<!--<div id='top_info'>Browse <a href='#'>Today's favorites</a> or <a href='#'>All time favorites</a></div>-->
<?php echo logo; ?>
</div>
</div>
<div id='tabs'>
<ul>
<li>
{TITLE}
</li>
<li>
<?php echo all_tab; ?>
</li>
<li>
<?php echo picture_tab; ?>
</li>
<li>
<?php echo random_tab; ?>
</li>
<li>
<?php echo submit_tab; ?>
</li>
<div id="search">
	<form method="post" action="index.php">
	<p><input type="text" name="searching" /> <input type="submit" value="Search"/></p>
</form>
</div>
</div>
<?php echo news_from_db; ?>
<br><br>
<div class="gboxtop"></div>
<div class="gbox">
	<p><?php echo news_display; ?></p>
</div>