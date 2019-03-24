<form action="api.php?do=post" method="post">
<div class="text-center" style="overflow-y:scroll; height:250px">
<h3 class="text-center">輪播效果</h3>
<select name="ani">
	<option value="1">淡入淡出</option>
	<option value="2">滑入滑出</option>
	<option value="3">縮放大小</option>
</select>
<h3 class="text-center">預告片清單</h3>
    <?php
        $result = All("select * from post order by seq");
        foreach($result as $row)
        {
            ?>
                <input type="hidden" value="<?=$row["id"]?>" name="id[]"><br>
                預告片海報: <img src="img/<?=$row["file"]?>" height="100px"><br>
                預告片片名: <input type="text" value="<?=$row["text"]?>" name="text[]"><br>
                預告片排序: <input type="number" value="<?=$row["seq"]?>" name="seq[]"><br>
                <input type="checkbox" value="<?=$row["id"]?>" name="dis[]" <?=($row["display"] == 1)?"checked":""?>>顯示
                <input type="checkbox" value="<?=$row["id"]?>" name="del[]">刪除<br>
                <hr>
            <?php
        }
	?>
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