<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>校园新鲜事</title>
</head>
<body>
     <h2>新闻标题滚动</h2>
<div id="demo" style="overflow:hidden;height:230px;width:165px;">
                 <table id="demo1" width="165"> 
                    <?php
                         $i = 0;
                         while($i<10){?>
                         <?php
				     $count=0;
				     while ($count<10) 
				     { 
				       $count++;
		     ?>
                    <tr>
                     <td><?php echo $title;?></td>
                    </tr>
          <?php }?>
         <?php $i++; }?>
</table> 
<div id="demo2">
</div>
</div> 
<script> 
var speed=100
var demo=document.getElementById("demo"); 
var demo2=document.getElementById("demo2"); 
var demo1=document.getElementById("demo1"); 
demo2.innerHTML=demo1.innerHTML 
function Marquee(){ 
if(demo2.offsetTop-demo.scrollTop<=0) 
  demo.scrollTop-=demo1.offsetHeight 
else{ 
  demo.scrollTop++ 
} 
} 
var MyMar=setInterval(Marquee,speed) 
demo.onmouseover=function() {clearInterval(MyMar)} 
demo.onmouseout=function() {MyMar=setInterval(Marquee,speed)} 
</script> 
</body>
</html>