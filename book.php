<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0063)?do=viewmore&id=4 -->
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
	include "sql.php";
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
        <h1>線上訂票</h1>
		<form action="seat.php" method="post">
			電影：	<select name="movie" onchange="getdate()" id="movie">
					<?php
						$today = strtotime("now");
						$ondate = strtotime("-2 days", $today);
						$result = mysqli_query($link, "select * from movie where ondate >= '".$ondate."' and ondate <= '".$today."' and display = 1");
						$i=1;
						while($row = mysqli_fetch_array($result))
						{
							?>
							<option value="<?=$row["id"]?>" <?=($i)?"selected='selected'":""?>><?=$row["name"]?></option>
							<?php
							$i=0;
						}
					?>
					</select><br>
			日期：	<select name="date" onchange="gettime()" id="date">
					</select><br>
			場次：	<select name="time" id="time">
					</select><br>
			<input type="submit">
			<input type="reset">
		</form>
      </div>
    </div>
  </div>
  <div id="bo"> ©Copyright 2010~2014 ABC影城 版權所有 </div>
</div>
<script>
	function getdate()
	{
		var m = $("#movie").val();
		$.post("api.php?do=gd", {m}, function(r){
			$("#date").html(r);
			console.log(r);
		})
		gettime();
	}
	
	function gettime()
	{
		var d = $("#date").val();
		var m = $("#movie").val();
		$.post("api.php?do=gt", {d, m}, function(r){
			$("#time").html(r);
			console.log(r);
		})
	}
	
	getdate();
</script>
</body>
</html>