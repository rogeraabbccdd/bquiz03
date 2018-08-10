<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0047)? -->
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
	include "sql.php";
	$fp = "post/".mysqli_fetch_array(mysqli_query($link, "select * from post order by seq limit 1"))["file"];
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>影城</title>
<link rel="stylesheet" href="css/css.css">
<link href="css/s2.css" rel="stylesheet" type="text/css">
<script src="scripts/jquery-1.9.1.min.js"></script>
</head>

<body>
<div id="main">
  <div id="top" class="ct" style=" background:#999 center; background-size:cover; " title="替代文字">
    <h1 style="margin:0px">ABC影城</h1>
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
          <ul class="lists">
			<li><img src="<?=$fp?>" id="p" height="200px"></li>
          </ul>
		  <div class="la"></div>
          <ul class="controls">
			<?php
				$result = mysqli_query($link, "select * from post where display = 1 order by seq");
				$i=0;
				while($row = mysqli_fetch_array($result))
				{
					?>
					<li><img src="post/<?=$row["file"]?>" height="50px" id="pp<?=$i?>" onclick="show(<?=$i?>, <?=$row["ani"]?>)"></li>
					<?php
					$i++;
				}
			?>
          </ul>
		  <div class="ra" style="position:absolute;top:-60px;right:10px;"></div>
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
				$total = mysqli_num_rows(mysqli_query($link, "select * from movie where display = 1"));
				$tp = ceil($total/4);
				
				$s=$p*4-4;
				$i=1;
				$result = mysqli_query($link, "select * from movie where display = 1 order by seq limit ".$s.", 4");
				while($row = mysqli_fetch_array($result))
				{
					if($i==1||$i==3)	echo"<tr>";
					?>
						<td>
						片名:<?=$row["name"]?><br>
						<div style="float:left">
							<img src="movie/<?=$row["poster"]?>" height="50px">
						</div>
						<div>
							分級:<img src="level/<?=$row["level"]?>.png"><br>
							上映日期:<?=date("Y-m-d", $row["ondate"])?><br>
						</div>
						<input type="button" onclick="window.location='intro.php?id=<?=$row["id"]?>'" value="劇情簡介">
						<input type="button" onclick="window.location='book.php?id=<?=$row["id"]?>'" value="線上訂票">
						</td>
					<?php
					if($i==2||$i==4)	echo"</tr>";
					$i++;
				}
			?>
          </tbody>
        </table>
        <div class="ct"> 
			<?php
				if($total > 4)
				{
					for($i=1;$i<=$tp;$i++)
					{
						?>
						<a href="index.php?p=<?=$i?>"><?=$i?></a>
						<?php
					}
				}
			?>
		</div>
      </div>
    </div>
  </div>
  <div id="bo"> ©Copyright 2010~2014 ABC影城 版權所有 </div>
</div>
<script>
	var tpo = <?=$i?>;
	var po = 0;
	
	setInterval(auto, 2000);
	function auto()
	{
		$("#p").attr("src", $("#pp"+po).attr("src"));
		po++;
		if(po>tpo)	po=0;
	}
	
	function show(pos, ani)
	{
		var a = $("#p").attr("src", $("#pp"+po).attr("src"));
		anim(p, ani);
		po = pos;
	}
	function anim(p, type)
	{
		if(type == 1)
		{
			$(p).fadeOut();
			$(p).hide();
			$(p).fadeIn();
		}
		else if(type == 2)
		{
			$(p).animate();
			
			$(p).fadeIn();
		}
		else if(type == 3)
		{
			$(p).slideUp();
			$(p).hide();
			$(p).slideDown();
		}
	}
	
</script>
</body>
</html>