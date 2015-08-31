<?php
namespace mapper;
class DomainObjectAssembler {
	protected static $PDO;

	function __construct(PersistenceFactory $factory){
		$this->factory = $factory ;
		self::$PDO = \registry\PDORigister::instance();
	}

	function getStatement ( $str ){
			if ( ! isset ( $this->statements[$str] ) ){
				$this->statements[$str] = self :: $PDO->prepare ( $str );
			}

			return $this->statements[$str];
	}


	function findOne ( IdentityObject $idobj ){
		$collection = $this->find ( $idobj ) ;

		return $collection->next();
	}

	function find ( IdentityObject $idobj ){
		$selfact = $this->factory->getSelectionFactory();
		list ( $selection , $values ) = $selfact->newSelection ( $idobj );
		$stmt = $this->getStatement ( $selection );
		$stmt->execute ( $values );
		$raw = $stmt->fetchAll();
		return $this->factory->getCollection( $raw );
	}

	function insert ( \domain\DomainObject $obj ) {
		$upfact = $this->factory->getUpdateFactory ();
		
		list ( $update ,$values ) = $upfact ->newUpdate ( $obj );

		$stmt = $this->getStatement ( $update );

		$rt =  $stmt->execute( $values );

		if ( $obj->getId() < 0 ){
			$obj->setId ( self :: $PDO->lastInsertId() );
		}

		return $rt;
	}

	function delete (\domain\DomainObject $obj){
		
		$defactory = $this->factory->getDeleteFactory();

		list ($delete, $values) = $defactory -> newDelete( $obj );

		$stmt = $this->getStatement( $delete );

		return  $stmt->execute( $values );

	}

}



?>
