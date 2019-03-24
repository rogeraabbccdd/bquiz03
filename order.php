<form action="api.php?do=fastdel" method="post">
快速刪除 
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
			<input type="button" value="刪除" onclick="window.location='api.php?do=delord&id=<?=$row["id"]?>'">
			<hr>
		<?php
	}
	
?>