<form action="api.php?do=fastdel" method="post">
快速刪除 
	<input type="radio" name="mode" value="1">依日期
	<input type="text" name="date">
	<input type="radio" name="mode" value="2">依電影
	<select name="movie">
		<?php
			$result = mysqli_query($link, "select * from movie");
			while($row = mysqli_fetch_array($result))
			{
				echo '<option value="'.$row["id"].'">'.$row["name"].'</option>';
			}
		?>
	</select>
	<input type="submit" value="刪除">
</form>
<table>
	<tr>
		<td>訂單編號</td>
		<td>電影名稱</td>
		<td>日期</td>
		<td>時間</td>
		<td>數量</td>
		<td>位置</td>
		<td>操作</td>
	</tr>
<?php
	$result = mysqli_query($link, "select orders.*, movie.name as mn from orders, movie where movie.id = orders.movie order by date, id desc");
	while($row = mysqli_fetch_array($result))
	{
		$seat = unserialize($row["seat"]);
		?>
			<tr>
				<td><?=$row["num"]?></td>
				<td><?=$row["mn"]?></td>
				<td><?=date("Y-m-d", $row["date"])?></td>
				<td><?=$time[$row["time"]]?></td>
				<td><?=count($seat)?></td>
				<td><?php foreach($seat as $s)	echo $s.",";?></td>
				<td><input type="button" value="刪除" onclick="window.location='api.php?do=delord&id=<?=$row["id"]?>'"></td>
			</tr>
		<?php
	}
	
?>
</table>