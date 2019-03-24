---
description: SQL資料庫"測試"完成後，開始"測試"PHP，寫好共用function以及資料庫連接、session等程式碼
---

# 編寫共用程式碼

## 建立檔案sql.php

建立檔案sql.php，放入共用程式碼

## 寫入必要程式碼

```php
// 開啟資料庫連接
$pdo = new PDO("mysql:host=localhost;dbname=dbxx;charset=utf8", "root", "");
// session
session_start();
```

## 寫入function

由於考試有四個小時的時間限制，將一些常用語法寫成 function 來縮短字數，節省打字時間  
第一題後台資料處理大同小異，因此也可以寫成function，避免複製貼上修時漏改  
```php
// 節省 fetchAll 字數
// 只寫fetchAll就夠了，因為fetchAll有含query，所以更新和刪除資料也能用
function All($sql)
{
	global $pdo;
	return $pdo->query($sql)->fetchAll();
}

// 節省 header跳頁 字數
// 其他題版型自訂的Javascript跳頁函式名稱也叫lo
function lo($l)
{
	return header("location:".$l);
}

// 第一題的SQL很有規律，因此寫成function
// 前台顯示加 where display = 1
// 後台則不用(顯示所有資料)
function sql($tb, $dis)
{
	$r = "select * from ".$tb;
	if($dis) 	$r .= " where display = 1";
	
	return $r;
}
```

## 寫入變數
第三題有些變數可以預先寫好在共用檔中，方便之後引用，例如時間和電影分級  
```php
// 今天日期
$today = strtotime("today");
// 目前時間
$now = strtotime("now");
// 分級
$level = array("", "普遍級", "保護級", "輔導級", "限制級");
// 時段
$time=["14:00~16:00","16:00~18:00","18:00~20:00","20:00~22:00","22:00~24:00"];
```
