---
description: 編輯院線片管理
---

# 院線片管理
編輯院線片管理功能

## 製作表單
製作海報管理表單，有管理頁、新增和編輯要做，新增可以和編輯用同一種表單格式  
這邊有一個小技巧，編輯表單不用花時間去帶入原本的值，直接用空白表單  
因為 `修改成空白` 也算是成功修改  

### 管理頁
在 `vv.php` 編輯管理表單
```php
<!-- 新增按鈕，連到新增頁，admin.php?redo=nmovie -->
<input type="button" onclick="location.href='admin.php?redo=nmovie'" value="新增電影">
<hr>
<form action="api.php?do=movie" method="post">
<!-- 設定div高度，超出時出現卷軸，避免跑版，超出題目規定的1024*768 -->
<div style="overflow-y:scroll; height:400px">
    <?php
        // 不使用表格，省去打tr td等等標籤的時間
        // 直接用hr和br分隔比較快
        // 排序直接用數字輸入欄位，不用往上往下按鈕，節省時間
		$result = All("select * from movie order by seq");
		foreach($result as $row)
		{
			?>
				<img src="img/<?=$row["poster"]?>" height="100px">
				分級<img src="img/<?=$row["level"]?>.png">
				片名：<?=$row["name"]?> &emsp; 片長：<?=$row["length"]?> &emsp; 上映時間：<?=date("Y-m-d", $row["ondate"])?>
					<br>
						<input type="checkbox" value="<?=$row["id"]?>" name="dis[]" <?=($row["display"] == 1)?"checked":""?>>顯示 
						<input type="checkbox" value="<?=$row["id"]?>" name="del[]">刪除 
                        顯示順序: <input type="number" value="<?=$row["seq"]?>" name="seq[]">
                        <!-- 連到編輯頁，admin.php?redo=emovie -->
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
```

### 新增頁
開新檔 `nmovie.php`，在裡面建立表單  
```html
<form action="api.php?do=nmovie" enctype="multipart/form-data" method="post">
	片名:<input type="text" value="" name="name"><br>
	分級:	<select name="level">
                <option value="1">普遍級</option>
                <option value="2">保護級</option>
                <option value="3">輔導級</option>
                <option value="4">限制級</option>
            </select><br>
    片長:<input type="text" value="" name="length"><br>
    <!-- 題目只有說要有年的欄位，沒有規定值，用今年就好 -->
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
```

### 編輯頁
開新檔 `emovie.php`，複製新增的表單，貼過來修改  
只需要改form的action就好  
```php
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
```

## 處理表單資料
在 `api.php` 加入處理表單的程式碼
其實新增和編輯程式碼差不多，也能寫成function  
只是我覺得兩個地方而已，複製貼上改改就好  
```php
// 管理頁
case "movie":
    for($i=0;$i<count($_POST["id"]); $i++){
        All("update movie set seq = '".$_POST["seq"][$i]."' where id = '".$_POST["id"][$i]."'");
    }
    All("update movie set display = 0");
    foreach($_POST["dis"] as $d){
        All("update movie set display = 1 where id = '".$d."'");
    }
    foreach($_POST["del"] as $d){
        All("delete from movie where id = '".$d."'");
    }
    lo("admin.php?redo=vv");
    break;

// 新增
case "nmovie":
    // 由於是直接新增一筆只有id的資料，然後用foreach迴圈跑post去塞其他欄位資料
    // 所以排序數字和上映日期需處理後放進post陣列裡
    // 是否顯示為顯示
    $_POST["display"] = 1;
    // 查詢最後一個排序數字+1當新資料的排序
    $_POST["seq"] = All("select seq from post order by seq desc limit 1")[0][0] +1;
    // 將年月日串成上映日期
    $_POST["ondate"] = strtotime($_POST["day"]."-".$_POST["month"]."-".$_POST["year"]);
    // 新增一筆只有id的資料
    All("insert into movie (id) values (null);");
    // 獲取剛剛新增的id
    $id = $pdo->lastInsertId();
    // 用foreach迴圈跑post去塞其他欄位資料
    foreach($_POST as $k => $v){
        // 由於All這個function有含fetchAll，如果sql錯誤就會掛掉
        // 資料庫沒有年月日的欄位，所以要略過這三個
        if($k == "day" || $k == "year" || $k == "month") continue;
        All("update movie set ".$k." = '".$v."' where id = '".$id."'");
    }
    // 上傳檔案
    Upload($_FILES, "movie", $id);
    lo("admin.php?redo=vv");
    break;

// 編輯
case "emovie":
    $_POST["ondate"] = strtotime($_POST["day"]."-".$_POST["month"]."-".$_POST["year"]);
    foreach($_POST as $k => $v){
        if($k == "day" || $k == "year" || $k == "month") continue;
        All("update movie set ".$k." = '".$v."' where id = '".$_GET["id"]."'");
    }
    Upload($_FILES, "movie", $_GET["id"]);
    lo("admin.php?redo=vv");
    break;
```
