<?php
namespace registry;
class  RequestRegistry extends Registry {
	private static $instance;
	private $values = array();
	private $feddback = array();

	private function __construct(){}

	static function instance(){
		if  ( ! isset( self::$instance)){self :: $instance =new self();}
		return self :: $instance ;
	}

	function get( $key ){
		if ( isset ($this->values[$key])){
			return $this->values[$key];
		}
		return null;
	}
	function set( $key, $val){
		$this->values[$key] = $val;
	}

	function setProperty(){
		$this->values = $_GET;
		$this->values = array_merge($this->values,$_POST);
		
		//user_id
		if (isset($_COOKIE['user_id'])){
			$this->values['user_id'] = $_COOKIE['user_id'];
		}elseif( isset($_SESSION['user_id'] )){ 
			$this->values['user_id'] = $_SESSION['user_id'];
		}
		
	}

	function filter(){
		return \util\Validator::filter($this->values);
	}

	function addFeedback ($msg){
		array_push($this->feedback,$msg);
	}

	function getFeedback(){
		return $this->feedback;
	}

	//implode() 函数把数组元素组合为一个字符串。
	function getFeedbackString( $separator = "\n"){
		return implode($separator, $this->feedback);
	}
}
?>