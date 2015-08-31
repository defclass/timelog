<?php
namespace command;
class CommandResolver {
	private static $base_cmd;
	private static $default_cmd;

	function __construct(){
		/*
		 *if ( ! self::$base_cmd){
		 *        self::$base_cmd = new \ReflectionClass( "Command" );
		 */
			/*
			 *self::$default_cmd = new DefaultCommad();
			 */
		
	}

	function getCommand(\registry\RequestRegistry $request){
		$cmd = $request->get('action');
		$sep = DIRECTORY_SEPARATOR;

		$filepath = CLASS_PATH."command{$sep}{$cmd}.php";

		//classname 指的是action 的属性
		$classname = "{$cmd}";

		if (file_exists( "$filepath")){
			$cmd_class = new \ReflectionClass('\\command\\'."{$classname}");
			return $cmd_class->newInstance();
		}
		else throw  new \exception('file path no exist');
	}


}







?>