<?php
namespace mapper;

abstract class Collection implements \Iterator{
	protected $dofact;
	protected $total = 0 ;
	protected $raw = array();

	
	private $pointer = 0;



	function __construct (array $raw =null , DomainObjectFactory $dofact = null){
		if ( ! is_null($raw ) && !is_null ( $dofact)){
			$this->raw = $raw;
			$this->total = count($raw);
		
		}

		$this->dofact = $dofact;
	}


	function add (\domain\DomainObject $object){
		$class = $this->targetClass();
		if( ! ($object instanceof $class)){
			throw new Exception ("This is a {$class} collection");
		}

		$this->notifyAccess();
		$this->addToMap( $object );
	}


	abstract function targetClass();

	protected function notifyAccess(){
		//暂时留空
	}

	private function getRow( $num ){
		$this->notifyAccess();
		if ( $num >= $this->total ||$num < 0){
			return null;
		}

		if ( isset ($this->raw[$num])){
			$array = $this->raw[$num];
			$old = $this->getFromMap($array['id']);
			if ( $old ) { return $old ; }
			$new = $this->dofact->createObject ($this->raw[$num] );
			$this->addToMap($new);
			$new->markClean();
			return $new;
		}

	}


	public function rewind(){
		$this->pointer = 0 ;
	}

	public function current(){
		return $this->getRow($this->pointer);
	}

	public function key(){
		return $this->pointer;
	}

	public function next(){
		$row_obj = $this->getRow($this->pointer );
		if ($row_obj) {$this->pointer++;}
		return $row_obj;
	}


	public function valid(){
		return (!is_null ($this->current()));
	}

	public function getTotal(){
		return $this->total ;
	}


	private function getFromMap($id){
		return \domain\ObjectWatcher::exists( $this->targetClass(),$id);
	}
	
	private function addToMap( $obj ){
		return \domain\ObjectWatcher::add( $obj );
	}



}


?>
