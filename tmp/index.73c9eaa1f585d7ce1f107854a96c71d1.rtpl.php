<?php if(!class_exists('raintpl')){exit;}?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>

    <!--*  IE 不认识utf8,只能写成utf-8;-->
<script src="http://l.tbcdn.cn/apps/top/x/sdk.js?appkey=21511045"></script>
    <meta charset="UTF-8"  />
    <title>欢迎来到你的时间笔记</title>
    <link rel="stylesheet"  href="tpl/./css/default.css" >
    <link rel="stylesheet" href="tpl/./css/base.css" media="screen" />
    <link rel="stylesheet" href="tpl/./css/page.css" media="screen" />

  </head>
  <body>
    <div class='wrap'>
      <div class= 'header_bar'>
	<img class='index_logo' alt='' src = './tpl/img/logo.png'>
      </div> <!-- end of heaader_bar  -->

      

	<div class='index_container'> <!-- index_container start -->
	<div class='main_info '>  <!-- 主要的文字说明 -->
	   <p class='linian'>时间笔记的开发理念是：通过简单、易执行的方法，提高日常生活的时间利用效率，而勿需学习太复杂的理论和参加各种培训。</p>
	  <h4 class='headline' >一生有多少可用时间？</H4>
	  <p class='main_info_details'>
	    假设一个人有90年的生命，首尾两个10年不计算，那么他（她）的一生有25550天、613200小时。无论信不信，绝大多数人除去睡觉、吃饭、等车买东西、闲聊、处理个人卫生、看病吃药等必需处理的生活杂事后，只有10多年时间是可用的。
	  </P>
	  <h4 class='headline'>做好一件事情需要多长时间？ </h4>
	  <p class='main_info_details' >
	    有一个著名的理论：要成为某个领域的专家，需要10000小时。按这个比例计算，如果每天工作四个小时，一周工作五天，那么成为一个领域的专家至少需要十年，这就是一万小时定律。
	  </p>


	  <h4 class='headline'>简单、有效的提高工作效率</h4>
	  <p class='main_info_details'>
	    时间笔记是一个辅助记录时间的应用，它提供一些工具给用户来分析日常的用时习惯，从而可以优化时间利用。
	  </P>
	 
	 
	</div>
	<!-- 登陆和注册 -->
	<div class = "load_and_register ">
	  <!--登陆表单-->
	  <p class='load_tip'>如果你有账号，请登陆</P>
	  <form class = "load_form" method = "post" >
	    <span class = "load_email_tag">邮箱：</span>
	    <input type="text" class="load_email" name="user_email"> </br>
	    <span class = "load_pass_tag">密码：</span>
	    <input type="password" class= "load_password" name="load_password"> </br>
	    <input type="submit" class="load_submit" value="登陆"> 

	  </form>

	  <!--注册表单-->
	  <p class='register_tip'>或者10秒免费注册一个账号</p>
	  <form class = "register_form" method = "post" >
	    <span class = "rigister_username_tag">用户昵称：</span>
	    <input type="text" class ="register_username" name="register_username"> </br>

	    <span class = "rigister_username_tag">注册邮箱：</span>
	    <input type="text" class="register_email" name="register_email"> </br>

	    <span class = "rigister_password_tag">创建密码：</span>
	    <input type="password" class="register_password" name="rigister_password"> </br>

	    <span class = "rigister_password_tag">确认密码：</span>
	    <input type="password" class="register_repeat_password" name="rigister_register_password"> </br>
	    <input type="submit" class="register_submit" value="注册"> 

	  </form>
	  </div> <!-- end of index_container-->



