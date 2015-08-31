<?php
namespace command;

class Load extends Command{
	
	function doExecute(\registry\RequestRegistry $req){
	
		if ($req->get('flag') == 'login') {
			$arr = $this->login($req);
			echo json_encode($arr);
		}
		else  $this->logout();

	
	}

	private	function login(\registry\RequestRegistry $req){
		$email = $req->get("email");
		$password = $req->get("password");
		//开始认证
		$rt = \util\Login :: AuthUser($email,$password);
		if($rt == "认证成功"){
			$arr['success'] = 1;
			$arr['msg'] = "登录成功";
		} else{
			$arr['success'] = 0;
			$arr['msg'] =$rt->getMessage()."<br>"; 
		}
	
		return $arr ;
	}

	private	function logout(){
		\util\Login:: userLogout();
	}

}

?>
