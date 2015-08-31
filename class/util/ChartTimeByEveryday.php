<?php
/*
 * @2013年1月8日 
 * @Mike Huang 
 * class ChartOneTagEveryday 是获取每一天单个标签的花费的时间量，核心
 * 方法 self :: get 是返回以日期为键，时间量为值的一个数组；
 *
 * 如果传入的是所有标签，则是返回所有标签的日总量分布；
 *
 * 如果传入的是单个标签，则是返回单个标签的日总量分布；
 *
 */
class ChartTimeByEveryday {
	//数据库选出来的一组时间；
	private $date;

	//从开始到结束，不间断的一个数组；
	protected $every_day = array();

	//选定的标签的一组时间
	protected $totalTime = array();


	function __construct($date,$totalTime){
		$this->date = $date;
		$this->totalTime = $totalTime;
	}


	//每天该标签花的总时间 ,一个数组，日期为键，总时间为值。
	public function get(){
		$arr = array();
		if(!is_array($this->every_day)){
			return $arr[$this->every_day] = $this->totalTime;
		}
		//如果没有初始化$this->every_day 属性
		if(count($this->every_day) == 0) self :: getEveryday() ;

		//循环每一天；
		for($i=0; $i<count($this->every_day); $i++){

			//将该天的量初始化
			$arr[$this->every_day[$i]] = 0;

			//循环记录中的日期
			for($p=0; $p<count($this->date); $p++){

				//如果记录中存在日期 与循环中的日期相等
				if($this->date[$p] == $this->every_day[$i]) {

					//将值加到当天的值中；
					$arr[$this->every_day[$i]] += $this->totalTime[$p];
				}
			}
		}

		return $arr ;
	}

	
	//获得从开始日期，到结束日期的中间的每一个日期,不间断
	private function getEveryday(){
		if (!is_array($this->date)) return $this->date; 
		//计算开始的日期
		rsort($this->date);
		$begin_date = end($this->date);

		//计算结束的日期
		sort($this->date);
		$over_date = end($this->date);

		array_push($this->every_day,$begin_date);	

		//计算从开始到结束的每一个日期
		//这里的日期格是要注意一下，应该被strtotime()函数支持,数据库中取出的DATE　格式为2013-01-08
		while($begin_date<$over_date){
			$begin_date=date('Y-m-d',strtotime($begin_date.'+1 days'))	;
			array_push($this->every_day,$begin_date);	
		}

		return $this->every_day;

	}



/*
 *        private function BeginAndOver(){
 *                //对stime 数组反排序；
 *                rsort($this->stime);
 *
 *                //对etime 数组排序；
 *                sort($this->etime);
 *
 *                //取最后一个元素,得到最小值和最大值；
 *                $begin_timestamp = end($this->stime);
 *                $over_timestamp = end($this->etime);
 *
 *                $arr[0] = date('Y/m/d',$begin_timestamp);
 *                $arr[1] = date('Y/m/d',$over_timestamp);
 *
 *                return $arr;
 *        }
 *
 *        private function BeginToOver($array){
 *                //获取开始和结束的两个日期
 *
 *                $date1 = $array[0];
 *                $date2 = $array[1];
 *
 *                $arr[$date1] = 0;
 *
 *                while($date1<$date2){
 *                        $date1=date('Y/m/d',strtotime($date1.'+1 days')) ;
 *                        $arr[$date1] = 0 ;
 *                }
 *
 *                return $arr;
 *        }
 */





}

?>
