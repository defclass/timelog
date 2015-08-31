$(function() {//transmit a anonymous function  to function jQuery, so thar if the document onload,the anonymous can be invoked.
		var m = new Main();

	$("#right_bar p").hover(//display the addtag
		function(){
		$("#right_bar p span:nth-child(2)").css("display","inline");},
		function(){
		$("#right_bar p span:nth-child(2)").css("display","none");}
		);//end of  hover #right_bar
	
	//click the addtag
	$("#right_bar p span:nth-child(2)").click(function(){$(".addtag").slideDown()});
		
	
	//addtag
	$("#right_bar p .addtag input[value = '取消']").click(function(){$(".addtag").slideUp();});
	$("#enter").click(function(e){
		e.preventDefault();
		$(".addtag").slideUp();
		
		$.ajaxSetup({
				timeout: 2000,
				cache: false
			});

		
		$.ajax({
			url: "ajax.php",
			type: "POST",
			data:{"action":"addtag","tagName": $("input[name=tagName]").val()},
			dataType: "json",
			success: function(json){
						var div=" <span class='br10 '>"+json.tagName+"</span>";
						$("#right_bar_tag").prepend(div); 
						}
			});
			
		
	});// end of addtag
		
		 
 
		//click tag ，display #action UI
		$("#right_bar_tag span").click(function(e) {
			//click tag , below is the body.
			//if have loop
			e.preventDefault();
			if (m.t) stop_display();		

			//display #action
			//display_aciton();

			//#action display
			$("#action").slideDown();

			

			//recond the time
			m.stime = Date.parse(new Date()) / 1000;

			//recond the tagName m.tagName
			m.tagName = $(this).text();

			//display the clicked tag
			$("#action p span:first-child").text(m.tagName);

			// start count time, invoke every second; 
			//loop，count，number transfer time format，time insert to html
			m.t = setInterval(m.count, 1000);


		}); //click even done

		//click buttom to hide #action 
		$("#action p span:nth-child(3)").click(stop_display); 



		function stop_display() {
			//stop the loop
			stop_count();

			//recond the etime,and calculate the totalTime
			m.etime = Date.parse(new Date()) / 1000;

			m.totalTime=m.etime-m.stime;

		
			//ajax
			$.post("ajax.php",
				{"action":"action","tagName":m.tagName,"stime":m.stime,"etime":m.etime,"totalTime":m.totalTime},
				
				function(json){
						m.totalTime = json.totalTime; 
						m.stime = json.stime;
						m.etime = json.etime;
						m.tagName = json.tagName;
						display();},
				"json")
			
			clear();

			function stop_count() {//stop the loop ;
				clearInterval(m.t);
				$("#action p span:nth-child(2)").text("00:00");
			}
			function display() {// display html;
				$(".reconder:nth-child(1)").clone().insertBefore($(".reconder:nth-child(1)"));
				$(".reconder span:eq(0)").text(m.tagName);
				$(".reconder span:eq(1)").text("时间合计：" + m.totalTime);
				$(".reconder span:eq(2)").text("开始：" + m.stime);
				$(".reconder span:eq(3)").text("结束：" + m.etime);
				$("#action").slideUp();
			}
			function clear() {//clear some data;
				m.c = null;
				m.totalTime = null;
				m.tagName = null;
				m.stime = null;
				m.etime = null;
				m.t = null;
			}

		}
		function display_aciton(){ //display #action recond the time
			//#action display
			$("#action").slideDown();

			//recond the time
			m.stime = Date.parse(new Date()) / 1000;

			//recond the tagName m.tagName
			m.tagName = $(this).text();

			//display the clicked tag
			$("#action p span:first-child").text(m.tagName);

			// start count time, invoke every second; 
			//loop，count，number transfer time format，time insert to html
			m.t = setInterval(m.count, 1000);

		}
//end of main

//start of edittag
	//调整visible
	$("#edittag p span:nth-child(2)").live('click',function(){

			var  thistag=$(this);
			$.post("ajax.php",{"action":"edittag","choose":"0","tagName":$(this).prev().text()},function(json){
				
					if (json.success) { 
						if (json.bool) thistag.text("显示");
					   	if (!json.bool) thistag.text("不显示"); 
						}
				},
				'json');
			
			})//end of visible

	//调整重命名
	$("#edittag p span:nth-child(2)").live('click',function(){
			
			
			
	});
	
	



//end of edittag
		


});//end of anonymous function

