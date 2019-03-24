---
description: 編輯電影訂票管理 order.php
---

# 電影訂票管理
編輯電影訂票管理 `order.php`

## 製作表單
製作電影訂票管理表單
```php
<form action="api.php?do=fastdel" method="post">
快速刪除 
    <!-- 題目只有說能刪除指定日期，沒說要做選單，所以直接輸入文字 -->
	<input type="radio" name="mode" value="1">依日期
	<input type="text" name="date">
	<input type="radio" name="mode" value="2">依電影
	<select name="movie">
		<?php
			$result = All("select * from movie");
			foreach($result as $row)
			{
				echo '<option value="'.$row["id"].'">'.$row["name"].'</option>';
			}
		?>
	</select>
	<input type="submit" value="刪除">
</form>
<hr>
<?php
    // 不使用表格，省去打tr td等等標籤的時間
    // 直接用hr和br分隔比較快
	$result = All("select orders.*, movie.name as mn from orders, movie where movie.id = orders.movie order by date, id desc");
	foreach($result as $row)
	{
		$seat = unserialize($row["seat"]);
		?>
            訂單編號:<?=$row["num"]?><br>
			電影名稱:<?=$row["mn"]?><br>
			日期:<?=date("Y-m-d", $row["date"])?><br>
			時間:<?=$time[$row["time"]]?><br>
			數量:<?=count($seat)?><br>
            位置:<?php foreach($seat as $s)	echo $s.",";?><br>
            <!-- 刪除直接做按鈕連到api.php再回來，不需要花時間做ajax效果 -->
			<input type="button" value="刪除" onclick="window.location='api.php?do=delord&id=<?=$row["id"]?>'">
			<hr>
		<?php
	}
?>
```

## 處理表單
在 `api.php` 加入處理表單的程式碼
```php
// 單筆刪除
case "delord":
    All("delete from orders where id = '".$_GET["id"]."'");
    lo("admin.php?redo=order");
    break;

// 快速刪除
case "fastdel":
    // 依日期
    if($_POST["mode"] == 1)
    {
        $date = strtotime($_POST["date"]);
        All("delete from orders where date = '".$date."'");
    }
    // 依電影
    elseif($_POST["mode"] == 2)
    {
        All("delete from orders where movie = '".$_POST["movie"]."'");
    }
    lo("admin.php?redo=order");
    break;
```