<input type="button" onclick="location.href='admin.php?redo=nmovie'" value="新增電影">
<hr>
<form action="api.php?do=movie" method="post">
<div class="text-center" style="overflow-y:scroll; height:400px">
	<table width="100%">
	<?php
		$result = mysqli_query($link, "select * from movie order by seq");
		while($row = mysqli_fetch_array($result))
		{
			?>
			<tr>
				<td><img src="movie/<?=$row["poster"]?>" height="100px"></td>
				<td>分級<img src="level/<?=$row["level"]?>.png"></td>
				<td>
					片名：<?=$row["name"]?> &emsp; 片長：<?=$row["length"]?> &emsp; 上映時間：<?=date("Y-m-d", $row["ondate"])?>
					<br>
						<input type="checkbox" value="<?=$row["id"]?>" name="dis[]" <?=($row["display"] == 1)?"checked":""?>>顯示
						<input type="checkbox" value="<?=$row["id"]?>" name="del[]">刪除
						<input type="button" value="往上" onclick="seq('<?=$row["id"]?>', 'up')">
						<input type="button" value="往下" onclick="seq('<?=$row["id"]?>', 'down')">
						<input type="button" value="編輯" onclick="location.href='admin.php?redo=emovie&id=<?=$row["id"]?>'">
					<br>
					<?=$row["text"]?>
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

<script>
	function seq(id, pos)
	{
		$.post("api.php?do=vseq"+pos,{id}, function(r){
			console.log(r);
			location.href="admin.php?redo=vv";
		})
	}
</script>