---
description: 編輯首頁index.php
---

# 首頁 - 院線片清單
編輯首頁 `index.php` 左邊的院線片清單區  

## 建置院線片清單

找到院線片清單下的表格，將 `tbody` 裡的東西清掉  
在裡面放入程式碼，顯示資料

```php
<?php
	// 今天日期
	$today = strtotime("today");
	
	// 頁碼
	$p=1;
	if(!empty($_GET["p"]))	$p=$_GET["p"];

	// 總上映且顯示的院線片數
	$total = count(All("select * from movie where display = 1 and ondate >= ".$today." order by seq"));
	
	// 總頁數
	$tp = ceil($total/4);
	
	// 從第幾筆開始查詢，SQL的limit第一個數字從0開始算
	// "LIMIT 0,4" 代表跳過0筆資料取4筆
	// 頁數 |   SQL LIMIT第一個數字
	//  1   |   1*4-4=0
	//  2   |   2*4-4=4
	$s=$p*4-4;

	// 新增一個變數跟著跑資料迴圈
	// 奇數時顯示 <tr>，偶數時顯示 </tr> 來製造一列兩筆的表格
	$i=1;
	$result = All("select * from movie where display = 1 and ondate >= ".$today." order by seq limit ".$s.", 4");
	foreach($result as $row)
	{
		// 如果是奇數，顯示 <tr>
		if($i%2==1)	echo"<tr>";
		?>
			<td>
			片名:<?=$row["name"]?><br>
			<div style="float:left">
				<img src="movie/<?=$row["poster"]?>" height="50px">
			</div>
			<div>
				分級:<img src="img/<?=$row["level"]?>.png"><br>
				上映日期:<?=date("Y-m-d", $row["ondate"])?><br>
			</div>
			<input type="button" onclick="window.location='movie.php?id=<?=$row["id"]?>'" value="劇情簡介">
			<input type="button" onclick="window.location='book.php?id=<?=$row["id"]?>'" value="線上訂票">
			</td>
		<?php
		// 如果是偶數，顯示 </tr>
		if($i%2==0)	echo"</tr>";
		$i++;
	}
?>
```