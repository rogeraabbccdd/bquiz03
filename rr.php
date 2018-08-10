<h3 class="text-center">預告片清單</h3>
<form action="api.php?do=post" method="post">
<div class="text-center" style="overflow-y:scroll; height:250px">
	<table width="100%">
		<tr>
			<td>預告片海報</td>
			<td>預告片片名</td>
			<td>預告片排序</td>
			<td>操作</td>
		</tr>
		<?php
			$result = mysqli_query($link, "select * from post order by seq");
			while($row = mysqli_fetch_array($result))
			{
				?>
				<tr>
					<input type="hidden" value="<?=$row["id"]?>" name="id[]">
					<td><img src="post/<?=$row["file"]?>" height="100px"></td>
					<td><input type="text" value="<?=$row["text"]?>" name="text[]"></td>
					<td>
						<input type="button" value="往上" onclick="seq('<?=$row["id"]?>', 'up')">
						<input type="button" value="往下" onclick="seq('<?=$row["id"]?>', 'down')">
					</td>
					<td>
						<input type="checkbox" value="<?=$row["id"]?>" name="dis[]" <?=($row["display"] == 1)?"checked":""?>>顯示
						<input type="checkbox" value="<?=$row["id"]?>" name="del[]">刪除
						<select name="ani[]">
							<option value="1" <?=($row["ani"] == 1)?"selected":""?>>淡入淡出</option>
							<option value="2" <?=($row["ani"] == 2)?"selected":""?>>滑入滑出</option>
							<option value="3" <?=($row["ani"] == 3)?"selected":""?>>縮放大小</option>
						</select>
					</td>
				</tr>
				<?php
			}
		?>
	</table>
</div>
<div class="text-center">
<input type="submit">
<input type="reset">
</div>
</form>
<hr>
<h3 class="text-center">新增預告片海報</h3>
<div class="text-center" style="overflow-y:scroll; height:40%">
	<form action="api.php?do=npost" method="post" enctype="multipart/form-data">
		預告片海報<input type="file" name="file"> 預告片片名<input type="text" name="text">
		<input type="submit">
	</form>
</div>
<script>
	function seq(id, pos)
	{
		$.post("api.php?do=pseq"+pos,{id}, function(r){
			console.log(r);
			location.href="admin.php?redo=rr";
		})
	}
</script>