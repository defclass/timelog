<?php
namespace controller;
class UserSet  extends Page{
	
	function __construct(){}
	
	function process(\registry\RequestRegistry $req){}	

	function draw(){
		$this->tpl->draw('userset');
	}
}


?>