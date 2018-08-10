<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0063)?do=viewmore&id=4 -->
<p>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
	include "sql.php";
	
	$_SESSION["m"] = $_POST["movie"];
	$_SESSION["mn"] = mysqli_fetch_array(mysqli_query($link, "select * from movie where id = ".$_POST["movie"]))["name"];
	$_SESSION["d"] = $_POST["date"];
	$_SESSION["t"] = $_POST["time"];
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
    <div class="tab rb" style="width:87%;">
      <div style="background:#FFF; width:100%; color:#333; text-align:left">
		<form action="out.php" method="post">
				<?php
					$result = mysqli_query($link, "select seat from orders where movie = ".$_POST["movie"]." and date = ".$_POST["date"]." and time = ".$_POST["time"]);
					$seat = array();
					while($row = mysqli_fetch_array($result))
					{
						$s = unserialize($row["seat"]);
						$seat = array_merge($seat, $s);
					}
					
					for($i=1;$i<=20;$i++)
					{
						if(in_array($i, $seat))	echo '<img src="seat/03D03.png">';
						else
						{
							echo '<img src="seat/03D02.png">
								<input type="checkbox" name="seat[]" value='.$i.' class="seat">
							';
							
						}
						if($i%5 == 0)	echo "<br>";
					}
				?>
		<input type="submit">
		<input type="reset">
		</form>
		電影:<?=$_SESSION["mn"]?>
		<br>
		時刻:<?=date("Y-m-d", $_POST["date"])."&emsp;".$time[$_POST["time"]]?>
		<br>
		你已勾選<span id="seats">0</span>張票，最多可以購買四張票
      </div>
    </div>
  </div>
  <div id="bo"> ©Copyright 2010~2014 ABC影城 版權所有 </div>
</div>
<script>
	var seat = 0;
	$(".seat").change(function(e){
		if(this.checked)
		{
			if(seat > 3)	this.checked = false;
			else	seat++;
		}
		else seat--;
		
		$("#seats").html(seat);
	})
	
</script>
</body>
</html>