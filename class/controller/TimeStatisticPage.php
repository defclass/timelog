<?php
namespace controller;
class TimeStatisticPage  extends Page{
	
	function __construct(){}
	
	function process(\registry\RequestRegistry $req){}	

	function draw(){
		$this->tpl->draw('timeStatistic');
	}
}


?>