<?php
namespace command;

class UserRigister extends Command{
	private $user_id = null ;
	function doExecute(\registry\RequestRegistry $request){
		$username = $request->get('username');
		$email = $request->get('email');
		$password = $request->get('password');
		$repeat_password= $request->get('repeat_password');

		
		if (isset($username) && isset($email) && isset($password) && isset($repeat_password)) {

			//字符串处理
			$username = addslashes(trim(stripslashes($username)));
			$email = addslashes(trim(stripslashes($email)));
			$password = addslashes(trim(stripslashes($password)));
			$repeat_password = addslashes(trim(stripslashes($repeat_password)));

			// validate
			$errors = \util\Validator::validate($username, $password, $repeat_password, $email);
	
			// validate success
			if (empty($errors)) {
				$reg_time =date("YmdHis",time());
				$password = md5($password);
				$user_obj = new \domain\User(null,$email,$username,$password,$reg_time,"");
				
				
				$rt = \domain\ObjectWatcher::performOperations();
				$this->user_id = $user_obj->getId();
			
				if (empty($rt)) {
					$this->UserInit(); /* 用户初始化 */
					$arr['success'] = 1;
					$arr['msg'] = '注册成功！';
				}
				else {
					$arr['success'] = 0;
					$arr['msg'] = '对不起，由于服务器内部错误，导致注册失败。请稍后再试。';
				}

				
			}else{ //认证失败
				foreach ($errors as $e) {
					$msg ="";
					$msg .= $e->getMessage()."<br>";
				}
				$arr['success'] = 0;
				$arr['msg'] = $msg; 

			}
			echo json_encode($arr);
		}
	} /* end of function */

	private	function UserInit(){
		//插入一个新标签
		$tag_obj = new \domain\Tag(null,$this->user_id,null,'上网');
		
		\domain\ObjectWatcher::performOperations();
		
		$stime = time();
		$date = date('Y-m-d',time());
		$etime = $stime + 1;
		$totalTime = 1;
		$comment = '这是您的第一条备注';
		$reconder = new \domain\Reconder(null,$this->user_id,$tag_obj->getId(),$date,$totalTime,$stime,$etime,$comment);
		\domain\ObjectWatcher::performOperations();

	} /* end of function UseInit */

}	  /* end of class */

?>
