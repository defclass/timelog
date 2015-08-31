<?php
namespace command;
class Addtag extends Command{
	function doExecute(\registry\RequestRegistry $req){
	
		$name = $req->get("tagName");
		$user_id = $req->get('user_id');
		$idobj = new \mapper\IdentityObject();
		$idobj->field('user_id')->eq($user_id)->field('name')->eq($name);
		$finder = \mapper\PersistenceFactory :: getFinder ('domain\\Tag');
		$rt = $finder->findOne($idobj);
		if ($rt){
			$arr['seccess'] = 0 ;
			$arr['msg'] = '该标签已存在';
		
		}else{
		
			//新的对象
			$tag_obj = new \domain\Tag(null,$user_id,null,$name,null);
			$r = \domain\ObjectWatcher :: performOperations();
			if(empty($r)){
				$arr['success'] = 1;
				$arr['tagName'] = $name;
			}else{   
				$arr['success'] = 0;
				#arr['msg'] = ' 插入失败 ';
				echo json_encode($arr);
			}
		} /* end of else */


		echo json_encode($arr);

	}

}

?>