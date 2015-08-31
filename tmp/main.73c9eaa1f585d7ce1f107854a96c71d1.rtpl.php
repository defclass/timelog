<?php if(!class_exists('raintpl')){exit;}?><div class= 'main_container'>
  <div class='count_reconder cols'> <!-- start count_reconder -->
    <div class="count" >
      <div class= 'count_buttom'>
	<span class="count_tag">准备就绪</span>
	<span class="count_total">00:00</span>
	<span class="count_ready">心静如水</span>
      </div>

      <form>
	<textarea type="text" class="count_comment" name="comment" placeholder="备注"></textarea> </br>
      </form>

    </div>


    <div class="reconder_zone" >
      <?php $counter1=-1; if( isset($reconders) && is_array($reconders) && sizeof($reconders) ) foreach( $reconders as $key1 => $value1 ){ $counter1++; ?>
      <div class="a_reconder">
	<p class='tag_total'>
	  <span class="reconder_tag" >标签：<em class= 'tagName_em'><?php echo $value1["tagName"];?></em></span>
	  <span class="reconder_total">时间合计：<em><?php echo $value1["totalTime"];?></em></span>
	</p>
	
	<p class='start_end'>
	  <span class= "reconder_start_time"  >开始：<em><?php echo $value1["stime"];?></em></span>
	  <span class= "reconder_end_time" >结束：<?php echo $value1["etime"];?></span>
	</p>

	<p class= 'reconder_com_p'>
	  <span class="reconder_comment"><?php echo $value1["comment"];?></span>
	</p>

      </div>
      <?php } ?>

    </div>
  </div> <!-- end of count_reconder -->

  <div  class="select_tag_zone cols">

    <p class="select_tag_zone_tile">
      <form class="add_tag_form">
	<input type="text" class="add_tagName" name ="tagName">
	<button value="确定" class="select_tag_zone_enter">添加标签</button>
      </form>
    </p>
    <div class = "tag_list_zone">
      <p class= 'click_tag_info' >点击下列标签开始计时</P>
      <?php $counter1=-1; if( isset($tagList) && is_array($tagList) && sizeof($tagList) ) foreach( $tagList as $key1 => $value1 ){ $counter1++; ?>
      <?php if( $value1["visible"] == 1  ){ ?> <span class="tagList_tagname "><?php echo $value1["tagList"];?></span><?php } ?>
      <?php } ?>
    </div>
  </div>

</div>

<!--计数器的js-->
<script src="tpl/./js/count.js"></script>
