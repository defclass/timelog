//封装关于计数行为的数据
var count = {};
/*
 *********************************************************************
 * 这里是使用计数器需要提前赋值的一些内容
 * count.a_reconder  返回一条记录的class名,一个容器 
 * count.total       这是计数器要显示 已经计数的结果需要显示在哪个容器
 * count.countTag    这是计数器需要显示标签名的容器
 * count.comment     这是放计数器备注的容器 
 *********************************************************************
 */
count.a_reconder = null ;
count.total  = null ;
count.countTag   = null ;
count.comment = null;
count.clickobj = null;





//在嵌套函数中
//this 指调用函数 的对象 千万小心 var self=this;
count.totalTime = null ; 
count.stime =  null ; 
count.etime =  null ; 
count.tagName =  null ; 
count.comment =  null ; 
count.now  =  null ; 

//countid 是在计时器的标识，用于关闭计时器；
count.countid =  null ; 

//计时开始的操作

count.StartCount = function(){
	count.stime = Date.parse(new Date())/1000;

	//recond the clicked tag 
	count.tagName = $(count.clickobj).text();

	//display the clicked tag
	$(count.countTag).text(count.tagName);

    //点击出现，“停止”按纽
    $('.count_ready').addClass('count_stop').removeClass('count_ready').text('停止');
    

	// start count time, invoke every second; 
	count.countid = setInterval(count.SelfCount, 1000);

}//end of StartCount


/********************************************************************
 * 计时结束执行的操作
 * 要赋值的地方有：
 * count.a_reconder  这是要插入记录的class名，这是计数完成给出的结果。
 * count.total       这是计数器要显示 已经计数的结果
 ********************************************************************* */
count.StopCount = function(){


	//记录结束时间；
	count.etime = Date.parse(new Date()) / 1000;

	//记录comment;
	count.comment = $(".count_comment").val();


	//统计合计时间；
	count.totalTime = count.etime - count.stime;


	//ajax
	$.post("ajax.php?action=Action",
		{"tagName":count.tagName,"stime":count.stime,"etime":count.etime,"totalTime":count.totalTime,"comment": count.comment},
		//回调函数
	       function(json){
		   if(json.success ==  1){
		       if(json.reconders == '1'){count.exe(json.arr1)}
		       
		       else if(json.reconders == '2' ){count.exe(json.arr1);count.exe(json.arr2)}



		       
		       
		       
		       //清除数据
		       count.clear();
		   }
		   else	   $.sticky(json.msg);
	       

		   // function DisplayAReconder(arr){
			// count.totalTime = arr.totalTime; 
			// 	count.stime = arr.stime;
			// 	count.etime = arr.etime;
			// 	count.tagName = arr.tagName;
			// 	count.comment= arr.comment;

			// 	//显示新的一条记录
			// 	$(count.a_reconder+":nth-child(1)").clone().insertBefore($(count.a_reconder+":nth-child(1)"));
			// 	$(count.a_reconder+" span:eq(0)").text(count.tagName);
			// 	$(count.a_reconder+" span:eq(1)").text("时间合计：" + count.totalTime);
			// 	$(count.a_reconder+" span:eq(2)").text("开始：" + count.stime);
			// 	$(count.a_reconder+" span:eq(3)").text("结束：" + count.etime);
			// 	$(count.a_reconder+" span:eq(4)").text(count.comment);
			// } 
		},
		"json");


} ; //end of stop_count 


//一次计时结束时各数据清零；
count.clear  =  function(){
    //关闭计时器
    clearInterval(count.countid);		  	
		       
    //网页置零
    $(count.total).text("00:00");

    //“停止”按纽 变成 “准备”
    $('.count_stop').removeClass('count_stop').addClass('count_ready').text('心静如水');
		       
    //标签名变成准备就绪
    $(count.countTag).text('准备就绪');

    //评论文字清除
    $('.count_comment').val('');


	count.totalTime	= null;
	count.stime 	= null;
	count.etime	= null;
	count.tagName	= null;
	count.countid	= null;
	count.comment	= null;
	count.c		= null;
} ; 

//工具函数，自增
count.SelfCount = function() {
	count.c = Date.parse(new Date())/1000;
        count.c = count.c -count.stime;
	count.totalTime = count.numDiff2Time(count.c);

	$(".count_total").text(count.totalTime);

} ; 

//action 执行成功要显示在网页上的一个函数 ，因为嵌套在里面总是不成功所以放下来
count.exe = function(arr){
    //显示一条记录
    count.totalTime = arr.totalTime; 
    count.stime = arr.stime;
    count.etime = arr.etime;
    count.tagName = arr.tagName;
    count.comment= arr.comment;

    var target1 = '.a_reconder:first';

    $(target1).clone().insertBefore(target1);
    $(target1+' .reconder_tag em ').html(count.tagName);
    $(target1+' .reconder_total em').html(count.totalTime);
    $(target1+' .reconder_start_time em').html(count.stime);
    $(target1+' .reconder_end_time').text("结束：" + count.etime);
    $(target1+' .reconder_comment').text(count.comment); 
}


//一个工具函数，将数字转化为时间
count.numDiff2Time  = function(count){
	var year = 0;
	var month = 0;
	var day = 0;
	var hour = 0;
	var minu = 0;
	var second = 0;

	var year_0 = 3600 * 24 * 30 * 12;
	var month_0 = 3600 * 24 * 30;
	var day_0 = 3600 * 24;
	var hour_0 = 3600;
	var minu_0 = 60;


	if (count >= year_0) {
		year = Math.floor(count / (3600 * 24 * 30 * 12));
		count = count % (3600 * 24 * 30 * 12);
	}


	if (count >= month) {
		month = Math.floor(count / (3600 * 24 * 30));
		count = count % (3600 * 24 * 30);
	}


	if (count >= day_0) {
		day = Math.floor(count / (3600 * 24));
		count = count % (3600 * 24);
	}


	if (count >= hour_0) {
		hour = Math.floor(count / 3600);
		count = count % 3600;
	}


	if (count >= minu_0) {
		minu = Math.floor(count / 60);
		count = count % 60;
	}

	second = count;


	hour = (hour < 10) ? '0' + hour: hour;
	minu = (minu < 10) ? '0' + minu: minu;
	second = (second < 10) ? '0' + second: second;


	if (year !== 0) return year + "-" + month + "-" + day + " " + hour + ":" + minu + ":" + second;

	if (month !== 0) return month + "-" + day + " " + hour + ":" + minu + ":" + second;

	if (day !== 0) return day + " " + hour + ":" + minu + ":" + second;

	if (hour !== 0 && hour !== "00") return hour + ":" + minu + ":" + second;

	if (minu !== 0) return minu + ":" + second;

	if (second !== 0) return minu + ":" + second;
} ;//end of numDiff2Time

//封装关于计数行为的数据  结束


//------------------------------------------以下是主体
//点击开始计时,先初始化计算器
count.a_reconder = ".a_reconder" ;
count.total  = ".count_total" ;
count.countTag   =  ".count_tag" ;
count.comment = "count_comment";

//点击开始计时；
$(".tagList_tagname").live('click',function(e){
		e.preventDefault();
		if(count.countid) count.StopCount();
		count.clickobj = this;
		count.StartCount();
});//点击标签计时 ，结束。
//点击结束；
$(".count_stop").live('click',function(e){
		e.preventDefault();
		count.StopCount();

});
