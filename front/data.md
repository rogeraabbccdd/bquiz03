---
description: 將各頁都會用到的標題資料、校園映像等資料寫進共用檔sql.php。
---

# 編輯共用資料

## 導覽列

編輯各頁的導覽列連結
找到 `<div id="top2"> ` ，修改各連結網址

```html
<div id="top2"> 
	<a href="index.php">首頁</a>
	<a href="book.php">線上訂票</a> 
	<a href="#">會員系統</a> 
	<a href="admin.php">管理系統</a> 
</div>
```

## 引用資料庫連接檔
在各頁面加入程式碼，引用資料庫連接檔
```php
include("sql.php");
```