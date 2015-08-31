<?php
namespace domain;

class User extends DomainObject {
	private $email;
	private $username;
	private $password;
	private $banned;
	private $reg_time;

	function __construct($id = null , $email = null, $username =null,  $password =null,$reg_time = null, $banned = null){
		parent:: __construct($id);	

		$this->email = $email;
		$this->username = $username;
		$this->reg_time = $reg_time;
		$this->password = $password;
		$this->banned= $banned;

	}	     

	//getter setter
	function setEmail($email){
		$this->email = $email;
		$this->markDirty();
	}

	function getEmail(){
		return $this->email;
	}

	function setUsername($username){
		$this->username = $username;
		$this->markDirty();
	}

	function getUsername(){
		return $this->username;
	}


	function setBanned($banned){
		$this->banned= $banned;
		$this->markDirty();
	}

	function getBanned(){
		return $this->banned;
	}

	function setReg_time($reg_time){
		$this->$reg_time= $reg_time;
		$this->markDirty();
	}

	function getReg_time(){
		return $this->reg_time;
	}


	function setPassword($password){
		$this->password = $password;
		$this->markDirty();
	}

	function getPassword(){
		return $this->password;
	}
}


?>
