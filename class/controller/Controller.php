<?php
namespace controller;

class Controller{
	private function __construct(){}


	static function run(){
		$instance = new Controller ;
		$instance->init();
		$instance->handleRequest();
	}

	function init(){
		session_start();
		/*
		 *$applicationHelper = ApplicationHelper :: instance();
		 *$applicationHelper->init();
		 */
	}


	function handleRequest(){
		$request = \registry\RequestRegistry :: instance();
		$request->setProperty();
		$errors = $request->filter();
		
                //检查输入是否合法
		if ( ! empty($errors) ){
			foreach($errors as $errors_obj){
			       $msg = "";
				$msg .=$errors_obj->getMessage();
			}
				$arr['success'] = 0;
				$arr['msg'] = $msg; 

			echo json_encode($arr);
		}else{
			$cmd_r = new \command\CommandResolver();
			//$cmd_r->getCommand( $request) 返回一个CMD的处理对象
			$cmd = $cmd_r->getCommand($request);
			$cmd->execute($request);
		}
	}	

}
?>
