---
description: 編輯訂票座位選擇頁 seat.php
---

# 訂票座位選擇頁
編輯訂票座位選擇頁 `seat.php`

## 座位顯示
一樣找到 `<div class="tab rb" style="width:87%;">`，編輯網頁內容  

```php
<div class="tab rb" style="width:87%;">
    <div style="background:#FFF; width:100%; color:#333; text-align:left">
        <!-- 
            表單資料在下一頁處理就好，我這裡沒打算寫入api.php 
            把選擇的電影、日期和時間用Get的方法傳過去，就不用再轉post的
        -->
       <form action="out.php?m=<?=$_GET["m"]?>&d=<?=$_GET["d"]?>&t=<?=$_GET["t"]?>" method="post">
        <?php
            // 獲取所有訂票資料
            $result = All("select seat from orders where movie = ".$_GET["m"]." and date = ".$_GET["d"]." and time = ".$_GET["t"]);
            // 將每筆訂單的已選的座位合併進空陣列
            $seat = array();
            foreach($result as $row)
            {
                $s = unserialize($row["seat"]);
                $seat = array_merge($seat, $s);
            }
            
            // 總共20個座位
            for($i=1;$i<=20;$i++)
            {
                // 如果已被下訂，顯示有坐人的椅子
                if(in_array($i, $seat))	echo '<img src="img/03D03.png">';
                // 沒有的話顯示空坐位和checkbox
                else
                {
                    echo '<img src="img/03D02.png">
                        <input type="checkbox" name="seat[]" value='.$i.' class="seat">
                    ';
                    
                }
                // 一排五個，如果i/5整除的話換行
                if($i%5 == 0)	echo "<br>";
            }
        ?>
        <!-- 點選上一步時關閉目前分頁 -->
        <input type="button" value="上一步" onclick="window.close()">
        <input type="submit" value="訂購">
        <br>
        <!-- 顯示資料 -->
        電影:<?=$_GET["mn"]?>
        <br>
        時刻:<?=date("Y-m-d", $_GET["d"])."&emsp;".$time[$_GET["t"]]?>
        <br>
        你已勾選<span id="seats">0</span>張票，最多可以購買四張票
        </form>
    </div>
</div>
```

## 製作JS函式
在頁面下方寫最高只能選4個座位的JS函式  
```javascript
var seat = 0;
// 當點擊checkbox改變時
$(".seat").change(function(e){
    // 如果變成選擇時
    if(this.checked)
    {
        // 如果已選4個，取消選擇
        if(seat > 3)	this.checked = false;
        else	seat++;
    }
    // 如果變成未選擇時
    else seat--;
    
    // 改變已選座位顯示數
    $("#seats").html(seat);
})
```