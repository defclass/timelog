<?php
namespace domain;

abstract class DomainObject{
	private $id = -1;

	function __construct( $id = null ){
		if (is_null($id)){ 
		
			$this->markNew(); 
		}else{		
			$this->id = $id;
		}
	}

	function getId(){
		return $this->id ;
	}

	function setId($id){
		$this->id = $id;
	
	}
	
	static function getFinder($type){
		return \mapper\PersistenceFactory :: getFinder($type);
	}

	function Finder(){
		return self::getFinder(get_class($this));
	}

	
	function markNew(){
		ObjectWatcher :: addNew($this);
	}

	function markDeleted(){
		ObjectWatcher :: addDelete($this);
	}

	function markClean(){
		ObjectWatcher :: addClean($this);
	}
	
	function markDirty(){
		ObjectWatcher :: addDirty($this);
	}


}
?>
