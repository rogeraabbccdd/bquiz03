---
description: 編輯電影票訂單頁 out.php
---

# 電影票訂單頁
編輯電影票訂單頁 `out.php`

## 處理訂單資料
在頁首輸入處理訂單資料的程式碼
```php
// 將座位陣列序列化以存入資料庫
$seat = serialize($_POST["seat"]);
// 訂單編號為訂購日期8碼+資料ID補0至4位數
$num = date("Ymd", $_GET["d"]).str_pad($pdo->lastInsertId(), 4, "0", STR_PAD_LEFT);
// 寫入資料庫
All("insert into orders values(null, ".$_GET["m"].", ".$_GET["d"].", ".$_GET["t"].", '".$seat."', '".$num."')");
```

## 顯示訂單內容
在內容區顯示訂單內容
```php
<div class="tab rb" style="width:87%;">
    <div style="background:#FFF; width:100%; color:#333; text-align:left">
    感謝您的訂購，您的訂單編號是<?=$num?>
    <br>
    日期:<?=date("Y-m-d", $_GET["d"])?>
    <br>
    時間:<?=$time[$_GET["t"]]?>
    <br>
    座位:<?php foreach($_POST["seat"] as $s) echo $s.","; ?>
    </div>
</div>
```
