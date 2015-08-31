<?php
namespace domain;

class ObjectWatcher {
	private $all = array();
	private static $instance;
	private $dirty = array();
	private $new = array();
	private $delete = array();

	private function __construct(){}

	static function instance(){
		if ( ! self :: $instance ){
			self :: $instance = new ObjectWatcher();
		}

		return self :: $instance ;
		
	}

	function globalKey ( DomainObject $obj) {
		$key = get_class( $obj ). ".".$obj->getId();
		return $key;
	}

	static function add ( DomainObject $obj ){
		$inst = self :: instance();
		$inst->all[$inst->globalKey( $obj )] = $obj ;
	}

	static function exists (  $classname , $id ){
		$inst = self :: instance();
		$key = "$classname.$id";
		if ( isset ( $inst ->all[$key]) ){
			return $inst->all[$key];
		}
		return null ;;
	}

	static function addDelete( DomainObject $obj ){
		$inst = self :: instance ();

		$inst->delete[$inst->globalKey( $obj )] = $obj;
	}


	static function addDirty ( DomainObject  $obj ) {

		$inst = self :: instance ();
		if ( ! in_array( $obj , $inst->new , true ) ){

			$inst->dirty[$inst->globalKey( $obj )]  = $obj ;
		}
	}

	static function addNew ( DomainObject $obj ) {
		$inst = self :: instance();
		$inst->new[] = $obj;
	}
	
	static function addClean ( DomainObject $obj ) {
		$inst = self :: instance();
		unset( $inst->delete[$inst->globalKey( $obj )]);
		unset( $inst->dirty[$inst->globalKey( $obj ) ]);
		$inst->new = array_filter ($inst->new,
					   function( $a ) use ($obj) { return !($a === $obj );}
			);
		
	}
	
	static	function performOperations(){
	
		$inst = self :: instance();


		foreach( $inst->dirty as $key => $obj ){
			$rt = $obj->finder()->insert( $obj );
			if( !$rt ) $fail[$key] = $obj ; 
		}
		foreach( $inst->new as $key => $obj ) {
			$rt = $obj->finder()->insert( $obj);
			if( !$rt ) $fail[$key] = $obj ; 
		}
		foreach( $inst->delete as $key => $obj){
			$rt = $obj->finder()->delete ($obj);
			if( !$rt ) $fail[$key] = $obj ; 
		}
		$inst->dirty = array();
		$inst->new   = array();
		$inst->delete = array();
		
		return $fail;	
			
		
	}



	
}



?>
