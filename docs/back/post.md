---
description: 編輯預告片海報管理 rr.php
---

# 預告片海報管理
編輯預告片海報管理 `rr.php`

## 製作表單
製作海報管理表單
```php
<form action="api.php?do=post" method="post">
<!-- 設定div高度，超出時出現卷軸，避免跑版，超出題目規定的1024*768 -->
<div style="overflow-y:scroll; height:250px">
<h3>輪播效果</h3>
<select name="ani">
	<option value="1">淡入淡出</option>
	<option value="2">滑入滑出</option>
	<option value="3">縮放大小</option>
</select>
<h3>預告片清單</h3>
    <?php
        // 不使用表格，省去打tr td等等標籤的時間
        // 直接用hr和br分隔比較快
        // 排序直接用數字輸入欄位，不用往上往下按鈕，節省時間
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
<div>
<input type="submit">
<input type="reset">
</div>
</form>
<hr>
<h3>新增預告片海報</h3>
<div style="overflow-y:scroll; height:40%">
	<form action="api.php?do=npost" method="post" enctype="multipart/form-data">
		預告片海報<input type="file" name="file"> 預告片片名<input type="text" name="text">
		<input type="submit">
	</form>
</div>
```

## 處理表單資料
在 `sql.php` 加入新function
```php
// 檔案上傳
// $file 為 $_FILES
// $table 為 資料表
// $id 為 要上傳檔案的資料id
function Upload($file, $table, $id){
    // 以現在的時間戳記當檔名
    global $now;
    foreach($_FILES as $name => $file){
        // 抓取副檔名
        $ext = pathinfo($file["name"], PATHINFO_EXTENSION);
        // 和現在時間組合成完整檔名
        $fn = $now.".".$ext;
        // 移動到img資料夾
        copy($file["tmp_name"], "img/".$fn);
        // 資料庫更新
        All("update ".$table." set ". $name." = '".$fn."' where id = '".$id."'");
    }
}
```

在 `api.php` 新增表單處理程式碼
```php
// 修改海報
case "post":
    // 更新動畫樣式
    All("update ani set ani = '".$_POST["ani"]."'");
    // 更新各筆的文字、顯示順序
    for($i=0;$i<count($_POST["id"]); $i++){
        All("update post set text = '".$_POST["text"][$i]."', seq = '".$_POST["seq"][$i]."' where id = '".$_POST["id"][$i]."'");
    }
    // 先把所有海報設為不顯示
    All("update post set display = 0");
    // 有傳資料來的海報再設為顯示
    foreach($_POST["dis"] as $d){
        All("update post set display = 1 where id = '".$d."'");
    }
    // 刪除海報
    foreach($_POST["del"] as $d){
        All("delete from post where id = '".$d."'");
    }
    // 導回管理頁
    lo("admin.php?redo=rr");
    break;

//新增海報
case "npost":
    // 獲取資料庫最後一筆排序數後+1
    $seq = All("select seq from post order by seq desc limit 1")[0][0] +1;
    // 新增資料
    All("insert into post values (null, '".$fn."', '".$_POST["text"]."', 1, '".$seq."')");
    // 獲取剛剛新增的id
    $id = $pdo->lastInsertId();
    // 上傳檔案
	Upload($_FILES, "post", $id);
    // 導回管理頁
    lo("admin.php?redo=rr");
    break;
```