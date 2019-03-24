<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0047)? -->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>影城</title>
<link rel="stylesheet" href="css/css.css">
<link href="home_files/s2.css" rel="stylesheet" type="text/css">
<script src="scripts/jquery-1.9.1.min.js"></script>
</head>
<?php
	include("sql.php");
?>
<body>
<div id="main">
  <div id="top" class="ct" style=" background:#999 center; background-size:cover; " title="替代文字">
    <h1>ABC影城</h1>
  </div>
  <div id="top2"> <a href="index.php">首頁</a> <a href="book.php">線上訂票</a> <a href="#">會員系統</a> <a href="admin.php">管理系統</a> </div>
  <div id="text"> <span class="ct">最新活動</span>
    <marquee direction="right">
    ABC影城票價全面八折優惠1個月
    </marquee>
  </div>
  <div id="mm">
    <div class="half" style="vertical-align:top;">
      <h1>預告片介紹</h1>
      <div class="rb tab" style="width:95%;">
        <div id="abgne-block-20111227">
			<div style="height:300px" class="text-center">
				<img src="" height="250px" id="showpost" class="show">
				<br>
				<span id="showtext"  class="show"></span>
			</div>
			<div style="width:400px; height:100px;" class="dbor text-center">
				<?php 
				 $ani = All("select * from ani")[0][0];
				 $result = All("select * from post where display = 1 order by seq");
				 $tpo = count($result);
				 if($tpo > 4) echo "<img src='img/l.jpg' onclick='pp(1)'>";
				 
				 $i = 0;
				 foreach($result as $row)
				 {
					 ?>
					 <img src='img/<?=$row["file"]?>' class='im' id='ssaa<?=$i?>' width='80' height='103' style="display:inline" onclick="ani(<?=$i?>)">
					 <span style="display:none" id='text<?=$i?>'><?=$row["text"]?></span>
					 <?php
					 $i++;
				 }
				 
				 if($tpo > 4) echo "<img src='img/r.jpg' onclick='pp(2)'>";
				 ?>
					<script>				
					var nowpage=0,num=<?=$tpo?>;
					function pp(x)
					{
						var s,t;
						if(x==1&&nowpage-1>=0)
						{nowpage--;}
						if(x==2&&(nowpage+1)<=num-4)
						{nowpage++;}
						$(".im").hide()
						for(s=0;s<=3;s++)
						{
							t=s*1+nowpage*1;
							$("#ssaa"+t).show()
						}
					}
					pp(1)
				</script>
			</div>
        </div>
      </div>
    </div>
    <div class="half">
      <h1>院線片清單</h1>
      <div class="rb tab" style="width:95%;">
        <table>
          <tbody>
		 	 <?php
				$p=1;
				if(!empty($_GET["p"]))	$p=$_GET["p"];
				$total = count(All("select * from movie where display = 1 and ondate >= ".$today." order by seq"));
				$tp = ceil($total/4);
				
				$s=$p*4-4;
				$i=1;
				$result = All("select * from movie where display = 1 and ondate >= ".$today." order by seq limit ".$s.", 4");
				foreach($result as $row)
				{
					if($i%2==1)	echo"<tr>";
					?>
						<td>
						片名:<?=$row["name"]?><br>
						<div style="float:left">
							<img src="img/<?=$row["poster"]?>" height="50px">
						</div>
						<div>
							分級:<img src="img/<?=$row["level"]?>.png"><br>
							上映日期:<?=date("Y-m-d", $row["ondate"])?><br>
						</div>
						<input type="button" onclick="window.location='movie.php?id=<?=$row["id"]?>'" value="劇情簡介">
						<input type="button" onclick="window.location='book.php?id=<?=$row["id"]?>'" value="線上訂票">
						</td>
					<?php
					if($i%2==0)	echo"</tr>";
					$i++;
				}
			?>
          </tbody>
        </table>
        <div class="ct"> </div>
      </div>
    </div>
  </div>
  <div id="bo"> ©Copyright 2010~2014 ABC影城 版權所有 </div>
</div>
</body>
<script>
	var tpo = <?=$tpo?>;
	var po = 0;
	var anim = <?=$ani?>;
		
	setInterval(auto, 2000);
	function auto()
	{
		var p = po++;
		if(po > tpo) po=0;
		ani(po);
	}
	
	function ani(post)
	{
		if(anim == 1)		$(".show").fadeOut(function(){change(post);});
		else if(anim == 2)	$(".show").slideToggle(function(){change(post);});
		else if(anim == 3)	$(".show").slideUp(function(){change(post);});
		
		if(anim == 1)		$(".show").fadeIn();
		else if(anim == 2)	$(".show").slideToggle();
		else if(anim == 3)	$(".show").slideDown();
	}

	function change(post)
	{
		$("#showpost").attr("src", $("#ssaa"+post).attr("src") );
		$("#showtext").text( $("#text"+post).text() );
		
		po = post;
	}
</script>
</html>