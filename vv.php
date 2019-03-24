<input type="button" onclick="location.href='admin.php?redo=nmovie'" value="新增電影">
<hr>
<form action="api.php?do=movie" method="post">
<div style="overflow-y:scroll; height:400px">
	<?php
		$result = All("select * from movie order by seq");
		foreach($result as $row)
		{
			?>
                <input type="hidden" value="<?=$row["id"]?>" name="id[]"><br>
				<img src="img/<?=$row["poster"]?>" height="100px">
				分級<img src="img/<?=$row["level"]?>.png">
				片名：<?=$row["name"]?> &emsp; 片長：<?=$row["length"]?> &emsp; 上映時間：<?=date("Y-m-d", $row["ondate"])?>
					<br>
						<input type="checkbox" value="<?=$row["id"]?>" name="dis[]" <?=($row["display"] == 1)?"checked":""?>>顯示 
						<input type="checkbox" value="<?=$row["id"]?>" name="del[]">刪除 
						顯示順序: <input type="number" value="<?=$row["seq"]?>" name="seq[]">
						<input type="button" value="編輯" onclick="location.href='admin.php?redo=emovie&id=<?=$row["id"]?>'">
					<br>
				簡介:<?=$row["text"]?>
			 <hr>
			<?php
		}
	?>
</div>
<div>
	<input type="submit">
	<input type="reset">
</div>
</form>