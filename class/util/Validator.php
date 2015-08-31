<?php
/**
 * Validator for Register.
 * @2013年1月10日
 * 
 * 这是用户认证正则验证的一个类。
 */
namespace util;
final class Validator {
	private function __construct() {
	}
	/**
	 * Validate the given username, password, repeat_password and email.
	 * @param $username, $password, $repeat_password and $email to be validated
	 * @return array array of {@link Error} s
  	 */
	public static function validate($username, $password, $repeat_password, $email) {
		$errors = array();
		$username = trim($username);
		$password = trim($password);
		if (!$username) {
			$errors[] = new Error('1', '用户名不能为空。');
		} elseif (strlen($username)<3) {
			$errors[] = new Error('2', '用户名长度不能小于3个字符。');
		} elseif (strlen($username)>30) {
			$errors[] = new Error('3', '用户名长度不能超过30个字符。');
		} elseif (!preg_match('/^(?![_0-9])[\w\x{4e00}-\x{9fa5}]{4,15}$/u',$username)) {
			$errors[] = new Error('username', '用户名是4-15个字符的中英文下划线_组成且第一个字符只能为中英文');
	
		} elseif (!$password) {
			$errors[] = new Error('6', '密码不能为空。');
		} elseif (strlen($password)<6) {
			$errors[] = new Error('7', '密码长度不能小于6个字符。');
		} elseif (strlen($password)>30) {
			$errors[] = new Error('8', '密码长度不能超过30个字符。');
		} elseif (!preg_match('/^[A-Za-z0-9!@#\\$%\\^&\\*_]+$/',$password)) {
			$errors[] = new Error('9', '密码只能是数字、字母或!@#$%^&*_等字符的组合。');
		} elseif ($password != trim($repeat_password)) {
			$errors[] = new Error('10', '两次输入密码不一致。');
		} elseif (!preg_match('/^[0-9a-z_][_.0-9a-z-]{0,32}@([0-9a-z][0-9a-z-]{0,32}\.){1,4}[a-z]{2,4}$/i',$email)) {
			$errors[] = new Error('email', '邮件格式有误');
		} else {
			//check whether user exists or not
			$idobj = new \mapper\IdentityObject();
			$idobj->field('name')->eq($username);
			$finder = \mapper\PersistenceFactory :: getFinder('domain\\Tag');
			$user = $finder->findOne($idobj);
			if ($user) {
				$errors[] = new Error('1', '该用户名已经被使用。');
			}
			$user = null;

			//check whether email being used or not
			$idobj = new \mapper\IdentityObject();
			$idobj->field('email')->eq($email);
			$finder = \mapper\PersistenceFactory :: getFinder('domain\\Tag');
			$user = $finder->findOne($idobj);
			if ($user) {
				$errors[] = new Error('12', '该邮箱已被注册。');
			}
		}
		return $errors;
	}

	public static function filter (array $arr){
		$errors = array();
	
		foreach ($arr as $key =>$value){
			$value = addslashes(trim(stripslashes($value)));
			if ($key == 'totalTime' || $key == 'stime' || $key == 'etime' ) $errors  = self :: filter_timestamp($value);
			if ($key == 'comment') $errors[] = self :: filter_comment_str($value);
			if ($key == 'username') $errors[] = self :: filter_username_str($value);
			if ($key == 'email') $errors[] = self :: filter_email($value);
			if ($key == 'tagName' || $key == 'newName' ) $errors[] =  self :: filter_tagname_str($value);
		}
		//去掉数组中为空的值；
		$errors = array_filter($errors);
		return $errors ;
	
	}

	private  static function filter_comment_str($str){
		//\pP匹配全部全角半角标点
	
		$pattarn = '/^(?![_])[\w\x{4e00}-\x{9fa5}\pP\s]{1,30}$/u';
		$rt = preg_match($pattarn,$str);
		
		if( !empty( $str ) && !$rt ) return new Error ('comment_str ','备注只能包含中英文数字和标点符号且不能超过30个字');
		
	}

	private static function filter_tagname_str($str){
		$pattarn = '/^(?![_0-9])[\w\x{4e00}-\x{9fa5}]{1,15}$/u';

		$rt = preg_match($pattarn,$str);
		if(!is_null($str) && !$rt ) return new Error('tagName','标签名不合法。标签名是1-15个字符的中英文下划线_组成且第一个字符只能为中英文字符');
		
	}

	private static function filter_username_str($str){
		$pattarn = '/^(?![_0-9])[\w\x{4e00}-\x{9fa5}]{4,15}$/u';

		$rt = preg_match($pattarn,$str);

		if (!$rt) return new Error('username','用户名不合法。用户名是4-15个字符的中英文下划线_组成且第一个字符只能为中英文字符');
		
	}

	private static  function filter_email($str){
		if (! filter_var ($str,FILTER_VALIDATE_EMAIL))
			return new Error('email','不是有效的email格式');
	}


	private static  function filter_timestamp($str){
		$pattarn = '/^[0-9]{0,11}$/';
		$rt  = preg_match($pattarn,$str);
		if(! $rt ) return new Error('timestamp','不是有效的timestamp 数字');
	}


	
}
?>