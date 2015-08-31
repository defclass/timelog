<?php
/*
 * @2013年1月8日 
 * @Mike Huang 
 *
 *
 * 
 */
namespace util;
class ChartTimeTotal {

	//数据库查询的资源标识符
	private $rows ;

	//以标签名为键，时间用量为值的一组数组;
	public $tag = array();

	//所有标签所有用量之总和
	public $totalTime = 0;

	//日期列；
	public $date = array();

	//各标签所花时间所占百分比，基于个人记录;
	protected $PercentageOfReconders ;
	
	//各标签所花时间百分比，基于全天计算	
	protected $PercentageOfAllDay;

	function __construct(array $rows){
		$this->rows = $rows;
	}


	//计算各标签所花时间所占百分比，基于个人记录;
	public function getPercentageOfReconders(){
		//如果$this->tag 为空
		if (count($this->tag) == 0 ) $this->getDatas();

		

		//计算百分比,基于个人记录
		foreach($this->tag as $k => $v){
			$this->PercentageOfReconders[$k] = round($v / $this->totalTime* 100,2) ;
		}

		return $this->PercentageOfReconders ;
	}


	//计算各标签所花时间所占百分比，基于全天记录;
	public function getPercentageOfAllDay(){
		if (count($this->tag) == 0 ) $this->getDatas();

		//计算这一段时间一共有多少秒；
		$all_days = $this->getDays() * 24 *3600;
	
		foreach($this->tag as $k => $v){
			$this->PercentageOfAllDay[$k] = round( $v/$all_days * 100 , 2).' %' ;
		}

		return $this->PercentageOfAllDay ;
	}




	public function getDatas(){
		//如果查询少了字段，则抛出异常；
		//if (!($rows['name'] && $rows['totalTime'] && $rows['date'])) throw new Exception('查询中应包含 name,totalTime, date 三个字段');


		foreach($this->rows as $row){
			$name = $row['name'];
			$totalTime = $row['totalTime'];
			$date = $row['date'];

			//如果不在$this->tag[$name] ，则将它初始化为 0 ；
			if(! array_key_exists($name,$this->tag)) $this->tag[$name] = 0 ;

			//将相同名的标签 累加$this->tag[$name] 
			$this->tag[$name] += $totalTime;

			//将所有时间累加 ；
			$this->totalTime += $totalTime;

			//取出date 这个列；
			array_push($this->date, $date);
		}

	
	}

	public function getDays(){
		if(count($this->date) == 0 ) $this->getDatas();
		//计算开始的日期
		rsort($this->date);
		$begin_date = end($this->date);

		//计算结束的日期
		sort($this->date);
		$over_date = end($this->date);
		$i = 0 ;
		while($begin_date<$over_date){
			$begin_date=date('Y-m-d',strtotime($begin_date.'+1 days'))	;
			$i++;
		}

		return $i;
	}

	




}

?>
