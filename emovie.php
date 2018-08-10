<?php
	$result = mysqli_query($link, "select * from movie where id = '".$_GET["id"]."'");
	$row = mysqli_fetch_array($result);
?>
<form action="api.php?do=emovie&id=<?=$_GET["id"]?>" enctype="multipart/form-data" method="post">
	<table>
		<tr>
			<td>影片資料</td>
			<td>
				片名:<input type="text" value="<?=$row["name"]?>" name="name"><br>
				分級:	<select name="level">
						<option value="1">普遍級</option>
						<option value="2">保護級</option>
						<option value="3">輔導級</option>
						<option value="4">限制級</option>
						</select><br>
				片長:<input type="text" value="<?=$row["length"]?>" name="length"><br>
				上映日期:<select name="year">
							<option value="2017">2017</option>
							<option value="2018">2018</option>
							<option value="2019">2019</option>
						</select>
						<select name="month">
							<?php
								for($i=1; $i<=12; $i++)	echo "<option value=".$i.">".$i."</option>";
							?>
						</select>
						<select name="day">
							<?php
								for($i=1; $i<=31; $i++)	echo "<option value=".$i.">".$i."</option>";
							?>
						</select><br>
				發行商:<input type="text" value="<?=$row["publish"]?>" name="publish"><br>
				導演:<input type="text" value="<?=$row["director"]?>" name="director"><br>
				預告片:<input type="file" value="<?=$row["trailer"]?>" name="trailer"><br>
				海報:<input type="file" value="<?=$row["poster"]?>" name="poster"><br>
			</td>
		</tr>
		<tr>
			<td>劇情簡介</td>
			<td>
				<textarea name="text"><?=$row["text"]?></textarea>
			</td>
		</tr>
	</table>
	<input type="submit">
	<input type="reset">
</form>