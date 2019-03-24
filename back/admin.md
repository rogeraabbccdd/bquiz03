---
description: 編輯後台頁 admin.php
---

# 管理系統
編輯後台頁 `admin.php`

## 編輯內容區
找到 `<div id="mm">`，編輯裡面的內容  

```php
<div id="mm">
    <?php 
        // 如果有管理員session，顯示後臺導覽列
        // 版型已經打好了，以redo來判斷顯示內容
        if(!empty($_SESSION["a"]))
        {
        ?>
        <div class="ct a rb" style="position:relative; width:101.5%; left:-1%; padding:3px; top:-9px;"> 
            <a href="?do=admin&redo=tit">網站標題管理</a>| 
            <a href="?do=admin&redo=go">動態文字管理</a>| 
            <a href="?do=admin&redo=rr">預告片海報管理</a>| 
            <a href="?do=admin&redo=vv">院線片管理</a>| 
            <a href="?do=admin&redo=order">電影訂票管理</a>
        </div>
        <div class="rb tab">
            <?php
            // 沒有redo的話
            if(empty($_GET["redo"]))    echo '<h2 class="ct">請選擇所需功能</h2>';
            // 有redo的話，引用以redo當檔名的頁面
            // 後台前三項不用做，不過我這裡沒有多寫判斷
            // 不用做代表不會評，所以評量時不要點到就好 (點到也不會扣分就是了)
            else	include	$_GET["redo"].".php";
            ?>
        </div>
        <?php
        }
        // 沒有管理員session，顯示登入表單
        else
        {
        ?>
            <div align="center">
            <form action="" method="post">
                帳號：<input type="text" name="acc"><br><br>
                密碼：<input type="password" name="pw"><br><br>
                <input type="submit">&emsp;<input type="reset">
            </form>
            </div>
        <?php
        }
    ?>
</div>
```

## 處理登入表單
直接在頁首加入處理登入的程式碼
```php
if(!empty($_POST["acc"]) && $_POST["acc"] == "admin" && !empty($_POST["pw"]) && $_POST["pw"] == "1234")
{
    // session值隨便給，有就好
    $_SESSION["a"] = "1";
}
```