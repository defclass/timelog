<?php
namespace command;
class GetChart extends Command{
	function doExecute(\registry\RequestRegistry $req){
		$time = $req->get('time');
		$user_id = $req->get('user_id');
	
		//获取TagCollection
		$tag_factory = \mapper\PersistenceFactory::getFactory('mapper\\Tag');
		$tag_assembler = $tag_factory->Finder();
		$tag_idobj = new \mapper\IdentityObject();
		$tag_idobj ->field('user_id')->eq($user_id);
		$tag_colle_obj = $tag_assembler->find($tag_idobj);

		//如果只有一个标签就暂时不统计
		if( $tag_colle_obj->getTotal() < 2 ) return json_encode(array()) ;

		//获取ReconderCollection
		$rec_factory = \mapper\PersistenceFactory::getFactory('mapper\\Reconder');
		$rec_assembler = $rec_factory->Finder();
		//标识对象设置
		$rec_idobj = new \mapper\IdentityObject();
		$rec_idobj ->field('user_id')->eq($user_id);

		if ( $time == 'today' ){
			$today = date('Y-m-d',time());
			$rec_idobj->field('date')->eq($today);
		}
                
		$rec_colle_obj = $rec_assembler->find($rec_idobj);
		


		//寻找tag_id 和tag 中id 相等的对象
		$all_tag_array = ARRAY();
		while($tag_colle_obj->valid()){

			//实例化一个对象 
			$tag_obj = $tag_colle_obj->next();

			//初始化该标签的时间
			$all_tag_array[$tag_obj->getname()] = 0;

			$rec_colle_obj->rewind();
			while($rec_colle_obj->valid()){

				//获得集合中的一个对象
				$rec_obj = $rec_colle_obj->next();

				//如果reconder 中的tag_id 和tag 中id 相等的
				if($rec_obj->gettag_id() == $tag_obj->getid()) {
					
					$all_tag_array[$tag_obj->getname()] += $rec_obj->gettotaltime();
					
				}

			}
		}

	
		$all_tag_array = array_filter($all_tag_array,
					      function ( $a ) { return !( $a == 0); } );

		echo json_encode($all_tag_array);

	}
}




?>
