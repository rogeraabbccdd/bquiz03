<form action="api.php?do=nmovie" enctype="multipart/form-data" method="post">
	片名:<input type="text" value="" name="name"><br>
	分級:	<select name="level">
                <option value="1">普遍級</option>
                <option value="2">保護級</option>
                <option value="3">輔導級</option>
                <option value="4">限制級</option>
            </select><br>
    片長:<input type="text" value="" name="length"><br>
    上映日期:<select name="year">
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
            </select>
            <br>
    發行商:<input type="text" value="" name="publish"><br>
    導演:<input type="text" value="" name="director"><br>
    預告片:<input type="file" value="" name="trailer"><br>
    海報:<input type="file" value="" name="poster"><br>
	劇情簡介<br>
		<textarea name="text"></textarea>
	<input type="submit">
	<input type="reset">
</form>