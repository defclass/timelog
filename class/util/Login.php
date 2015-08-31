<?php
/*
 *@2013年1月11日
 *@mike huang
 */
namespace util;
class Login {
	protected static $user_id;


	public static function AuthUser($email,$password){
		$finder =\mapper\PersistenceFactory::getFinder('domain\\User');
		$idobj = new \mapper\IdentityObject();
		$idobj->field('email')->eq($email);
		$rt = $finder->findOne($idobj);
				
		//如果选出一行
		if(!is_null($rt) && is_object($rt)){

			//被禁止的用户
			if($rt->getBanned() == 1) return new Error("banned","该用户被限止登陆");

			//密码匹配,开始会话，设置cookies
		
			elseif($rt->getPassword() == md5($password)){ 
				self :: $user_id = $rt->getId();
				self :: setSession();
				return "认证成功";
				

			}

			else return new Error("password","注册邮箱或密码不正确");

		}else  return new Error("email","注册邮箱不存在"); // 注册邮箱不存在
	}

	//设置Session，并给cookie
	public static function setSession(){
		//开始会话

		 
		$_SESSION['user_id'] = self ::$user_id;
	 
		//设置cookies	
		$cookie_time = 60*60*24*30;
		$cookiepath = ".".DIRECTORY_SEPARATOR ;

	

		//ob_start();
		//ob_end_flush();
		//配套使用，阻止 cannot modify header information - headers already sent by ... 这类错误
		setcookie('user_id',self::$user_id,time()+$cookie_time,$cookiepath) ;

	} //end of setSession

	public static function isLoggedin(){
		//检查是否有cookie
	
	
		if(isset($_COOKIE['user_id'])){

			//会话继续
		
			return true ;

			//检查是否有session
		}elseif(isset($_SESSION['user_id'])){

		
			return true ;

			//都没有则返回失败
		}else return false;


	}
	
	//用户注销
	public static function userLogout(){
	
	
		unset($_SESSION['user_id']);
		
		//设置cookie 在前一小时失效；
		setcookie('user_id','',time()-3600);

	}

	




}





?>
