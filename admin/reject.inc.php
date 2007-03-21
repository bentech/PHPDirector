<?php
/*
+ ----------------------------------------------------------------------------+
|     PHPDirector.
|		$License: GNU General Public License
|		$Website: phpdirector.co.uk
+----------------------------------------------------------------------------+
*/ if (isset($submitted)) {
if ($_POST['reject'] == "reject"){
$reason = $_POST['reason'];

}
} else { ?>
<form method="POST" action="<?php echo $SCRIPT_NAME ?>">
<input type="text" name="reason" value="" /><br/><input type="submit" name="reject" value="reject">
</form>
<?php } // end of form ?>