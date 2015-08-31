<?php
namespace controller;
abstract class page {
	protected $tpl;

	function  __construct(){}
	
	function display(\registry\RequestRegistry $req){
		$this->prepareTPL();
		$this->process($req);
		$this->tpl->draw('header');
		$this->draw();
		$this->tpl->draw('footer');

	}



	function prepareTPL(){
		require_once(CLASS_PATH."RainTPL.php");
		\raintpl::configure("base_url", null );
		\raintpl::configure("tpl_dir", "tpl/" );
		\raintpl::configure("cache_dir", "tmp/" );
		//initialize a Rain TPL object
		$this->tpl = new \RainTPL;

	}
	

	abstract function process(\registry\RequestRegistry $req);
	abstract function draw();
}	
?>