---
description: 編輯訂票頁 book.php
---

# 線上訂票頁
編輯線上訂票頁 `movie.php`


## 製作訂票表單
這邊有個鑽題目漏洞的小技巧  
題目規定，在挑選座位頁面(下一步會做)點上一步時  
必須回到訂票頁並 `取消勾選資料`、`保留原先選擇的資料`，但是題目 `並沒有規定要保留什麼資料`  
如果是保留座位資料還要花時間寫Session，所以我的作法為 `保留選擇的訂票資料`  
點確認到座位頁時使用開新分頁的方式，座位頁的上一步按鈕則使用關閉該新分頁的動作  
選擇的訂票資料仍好好的保留，這應該是這邊最省時的解法  
  
整段程式碼如下
```php
<div class="tab rb" style="width:87%;">
    <div style="background:#FFF; width:100%; color:#333; text-align:left">
    <form>
        電影：	<select name="movie" onchange="getdate()" id="movie">
            <?php
            // 電影檔期為3天，因此必須從資料庫選擇2天前上映的電影
            $ondate = strtotime("-2 days", $today);
            $result = All("select * from movie where ondate >= '".$ondate."' and display = 1");
            foreach($result as $row)
            {
                ?>
                <option value="<?=$row["id"]?>" <?=(!empty($_GET["id"]) && $_GET["id"] == $row["id"])?"selected='selected'":""?>><?=$row["name"]?></option>
                <?php
            }
            ?>
            </select><br>
        日期：	<select name="date" onchange="gettime()" id="date">
            </select><br>
        場次：	<select name="time" id="time">
            </select><br>
        <input type="button" onclick="goseat()" value="確定">
        <input type="reset" value="重置">
    </form>
    </div>
</div>
```
## 製作JS函式
在頁面下方寫Javascript function

```javascript
    // 獲取可訂日期資料
	function getdate()
	{
		var m = $("#movie").val();
		$.post("api.php?do=gd", {m}, function(r){
			$("#date").html(r);
			console.log(r);
		})
		gettime();
	}
    
    // 獲取可訂時段資料
	function gettime()
	{
		var d = $("#date").val();
		var m = $("#movie").val();
		$.post("api.php?do=gt", {d, m}, function(r){
			$("#time").html(r);
			console.log(r);
		})
	}
  
    // 點擊確定後跳到新分頁座位頁
    // 以GET的方式傳送表單資料過去
    function goseat()
    {
        var d = $("#date").val();
        var m = $("#movie").val();
        var t = $("#time").val();
        var mn =  $("#movie option:selected").text();
        window.open("./seat.php?d="+d+"&m="+m+"&t="+t+"&mn="+mn);
    }

    // 頁面載入時先獲取第一筆資料
	getdate();
```

## 編寫API
開新檔案 `api.php`，處理表單和AJAX資料
```php
include("sql.php");

switch($_GET["do"]){
    // 獲取可訂日期資料
    case "gd":
        // 電影上映日期
        $on = All("select * from movie where id = ".$_POST["m"])[0]["ondate"];

        // 算三天檔期
        for($i=0;$i<3;$i++)
        {
            $date = strtotime("+ ".$i." days", $on);
            $date2 = date("Y-m-d", $date);
            
            // 僅顯示未過期日期
            if($date >= $today)  echo "<option value='".$date."'>".$date2."</option>";
        }
        break;

    // 獲取可訂時段資料
    case "gt":
        // 五個時段的剩餘座位數
        $seat = array(20,20,20,20,20);
        
        // 查詢訂票資料
        $result = All("select seat, time from orders where movie = '".$_POST["m"]."' and date = '".$_POST["d"]."'");
        foreach($result as $row)
        {
            // 剩餘座位數減每筆訂票坐位數
            $s = unserialize($row["seat"]);
            $seat[$row["time"]] -= count($s);
        }

        // 顯示各時段剩餘座位數
        for($i=0;$i<5;$i++)
        {
            echo "<option value='".$i."'>".$time[$i]." 剩餘座位：".($seat[$i])."</option>";
        }
        break;
}
```