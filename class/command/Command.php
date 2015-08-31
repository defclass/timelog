<?php
namespace command;
abstract class Command{
	final function __construct(){}

	function execute(\registry\RequestRegistry $request){
		$this->doExecute( $request );
	}

	abstract function doExecute(\registry\RequestRegistry $request);
}
?>
