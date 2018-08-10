<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0063)?do=viewmore&id=4 -->
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
	include "sql.php";
	$result = mysqli_query($link, "select * from movie where id = ".$_GET["id"]);
	$row = mysqli_fetch_array($result);
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
        <embed src="movie/<?=$row["trailer"]?>" width="300px" height="250px" controls="" style="float:right;"></embed>
        <font style="font-size:24px"> <img src="movie/<?=$row["poster"]?>" width="200px" height="250px" style="margin:10px; float:left">
        <p style="margin:3px">影片名稱 ： <?=$row["name"]?>
          <input type="button" value="線上訂票" onclick="lof(&#39;?do=ord&amp;id=4&#39;)" style="margin-left:50px; padding:2px 4px" class="b2_btu">
        </p>
        <p style="margin:3px">影片分級 ： <img src="level/<?=$row["level"].".png"?>" style="display:inline-block;">限制級 </p>
        <p style="margin:3px">影片片長 ： <?=$row["length"]?>分</p>
        <p style="margin:3px">上映日期 <?=$row["ondate"]?></p>
        <p style="margin:3px">發行商 ： <?=$row["publish"]?></p>
        <p style="margin:3px">導演 ：<?=$row["director"]?> </p>
        <br>
        <br>
        <p style="margin:10px 3px 3px 3px; word-break:break-all"> 劇情簡介：<?=$row["text"]?><br>
        </p>
        </font>
        <table width="100%" border="0">
          <tbody>
            <tr>
              <td align="center"><input type="button" value="院線片清單" onclick="location.href='index.php'"></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div id="bo"> ©Copyright 2010~2014 ABC影城 版權所有 </div>
</div>
</body>
</html>