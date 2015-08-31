<?php
namespace command;
/* 这个类是处理 userset 页面修改用户信息的页面 */
class userSetUpdate extends Command{
	function doExecute(\registry\RequestRegistry $req){
		$username = $req->get('username');
		$origin_password =  $req->get('origin_password');
		$change_password =  $req->get('change_password');
		$repeat_change_password = $req->get('repeat_change_password');
	

		//获取该用户对象
		$user_id = $req->get('user_id');
		$idobj = new \mapper\IdentityObject();
		$idobj->field('id')->eq($user_id);
		$finder = \mapper\PersistenceFactory :: getFinder('domain\\User');
		$user_obj = $finder->findOne($idobj);
	
	

		if ($change_password !== $repeat_change_password ){
			$arr['success'] = 0;
			$arr['msg'] = '修改密码，两次输入不一致';
		}elseif(md5($origin_password) !== $user_obj->getPassword()  ){
			$arr['success'] = 0;
			$aar['msg'] = '原始密码输入错误';
		}else{
			if ( !is_null($username) )$user_obj->setUsername($username);
			$user_obj->setPassword(md5($change_password));
			$rt = \domain\ObjectWatcher :: performOperations();
			if (empty($rt)){
				$arr['success'] = 1;
				$arr['msg'] = '修改成功';
			}else{
				$arr['success'] = 0;
				$arr['msg'] = '找后端程序员，他的问题';
			}
		
		}
		
		echo json_encode($arr);
               
		

	} /* end of function */

} /* end of class */

?>