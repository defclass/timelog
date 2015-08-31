<?php
namespace command;

class GetPage extends Command{
	function doExecute(\registry\RequestRegistry $req){
		$page = $req ->get("Page");
	

		if (! \util\Login::isLoggedin()) {
		
			header('location:index.php');
			
		
		}else{
			$str = '\\controller\\'.$page;
			$page_obj = new $str();
			$page_obj->display($req);
		}
	
	}
}
?>
