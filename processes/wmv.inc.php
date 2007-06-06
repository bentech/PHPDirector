<?php
//check if its allready there

$videoid = trim($videourl);  //removes whitespaces at the end
		$smarty->assign('videoid', $videoid);
		if($videoid !== null){
			
		$smarty->assign('vidtype', 'wmv');
		
				}//check for blank end
 ?>