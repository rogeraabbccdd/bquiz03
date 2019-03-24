---
description: 編輯劇情簡介頁 movie.php
---

# 劇情簡介頁
編輯劇情簡介頁 `movie.php`

## 資料庫查詢

在頁首向資料庫要電影資料
```php
$row = All("select * from movie where id = ".$_GET["id"])[0];
```

## 顯示資料
接下來在 `<div class="tab rb" style="width:87%;">` 裡各欄位直接印出資料  

```php
<div class="tab rb" style="width:87%;">
    <div style="background:#FFF; width:100%; color:#333; text-align:left">
        <video src="img/<?=$row["trailer"]?>" width="300px" height="250px" controls="" style="float:right;"></video>
        <font style="font-size:24px"> <img src="img/<?=$row["poster"]?>" width="200px" height="250px" style="margin:10px; float:left">
        <p style="margin:3px">影片名稱 ：<?=$row["name"]?>
            <input type="button" value="線上訂票" onclick="window.location='book.php?id=<?=$_GET["id"]?>'" style="margin-left:50px; padding:2px 4px" class="b2_btu">
        </p>
        <p style="margin:3px">影片分級 ： <img src="img/<?=$row["level"]?>.png" style="display:inline-block;"><?=$level[ $row["level"] ] ?></p>
        <p style="margin:3px">影片片長 ： <?=$row["length"]?>分</p>
        <p style="margin:3px">上映日期 : <?=date("Y/m/d", $row["ondate"])?></p>
        <p style="margin:3px">發行商 ： <?=$row["publish"]?></p>
        <p style="margin:3px">導演 ：<?=$row["director"]?> </p>
        <br>
        <br>
        <p style="margin:10px 3px 3px 3px; word-break:break-all"> 劇情簡介：<br><?=$row["text"]?>
        </p>
        </font>
        <table width="100%" border="0">
            <tbody>
            <tr>
                 <td align="center"><input type="button" value="院線片清單" onclick="window.location='index.php'"></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
```