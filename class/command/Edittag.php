<?php
namespace command;
class Edittag extends Command{
	function doExecute(\registry\RequestRegistry $req){
		$name = $req->get('tagName');	
		$user_id = $req->get('user_id');

		$factory=\mapper\PersistenceFactory::getFactory('mapper\\Tag');
		$assembler = $factory->Finder();
		$idobj = $factory->getIdentityObject();

		$idobj->field('name')->eq($name)->field('user_id')->eq($user_id);

		$collection = $assembler->find($idobj);
		$tag_obj = $collection->next(); 
		

		if($req->get('delete') == 'delete' ){

			$tag_obj->markDeleted();
			$tag_id = $tag_obj->getId();
			$query = \registry\PDORigister :: instance();
			$stmt = $query->prepare("delete from reconder where user_id = ? and tag_id = ?");
			$stmt->execute(array($user_id,$tag_id));

		
		}elseif($req->get('visible') == 'change') {

			if ($tag_obj->getVisible() == 0 ) $tag_obj->setVisible(1);

			else $tag_obj->setVisible(0);

			$arr['visible'] = $tag_obj->getVisible();
		
		}elseif(!is_null($req->get('newName'))){
			$newName = $req->get('newName');
			$tag_obj->setName($newName);
			$arr['Name'] = $newName  ;
		}
		
		$rt = \domain\ObjectWatcher:: performOperations();
			
		if (empty($rt)) $arr['success'] = 1 ;
		else  $arr['success'] = 0 ;
	

		echo json_encode($arr);
	}
}
?>
