<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0063)?do=viewmore&id=4 -->
<p>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
	include "sql.php";
	
	$seat = serialize($_POST["seat"]);
	$num = date("Ymd", $_SESSION["d"]).str_pad(mysqli_insert_id($link), 4, "0", STR_PAD_LEFT);
	mysqli_query($link, "insert into orders values(null, ".$_SESSION["m"].", ".$_SESSION["d"].", ".$_SESSION["t"].", '".$seat."', '".$num."')");
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
		感謝您的訂購，您的訂單編號是<?=$num?>
		<br>
		日期:<?=date("Y-m-d", $_SESSION["d"])?>
		<br>
		時間:<?=$time[$_SESSION["t"]]?>
		<br>
		座位:<?php foreach($_POST["seat"] as $s){ echo $s.","; }?>
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