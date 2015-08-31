<?php


//定义常量
define('PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR);
define('CLASS_PATH', PATH.'class'.DIRECTORY_SEPARATOR);

require_once('./class/RainTPL.php');

/*
 * 设置自动加载类
 */

function autoload($classname){
  $classname = str_replace("\\","/",$classname);
 
  if(file_exists(CLASS_PATH.$classname.".php")){
		include_once(CLASS_PATH.$classname.".php");

  }                
                
  if(file_exists(PATH.'class'.$classname.".php")){
		include_once(PATH.'class'.$classname.".php");

  }

}

spl_autoload_register('autoload');
/*
 *set_include_path(get_include_path().'D:\\xampp\\htdocs\\myweb\\include\\'.'D:\\xampp\\htdocs\\myweb\\class\\');
 */




?>
