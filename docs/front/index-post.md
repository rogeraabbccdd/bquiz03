---
description: 編輯首頁index.php
---

# 首頁 - 預告片海報
編輯首頁 `index.php` 左邊的預告片海報區  

:::tip TIP
預告片介紹算是這題蠻複雜的地方，版型只有提供按鈕區的 `ul` 和 `li`，動畫效果需要自己寫    
不過輪播的效果可以直接抓第一題校園映像的JS來套，節省時間
:::

## 建置輪播區
找到 `<div id="abgne-block-20111227">` ，把內容清空，這個div就是要塞海報輪播的    
如果要套第一題校園映像當輪播的話，不需要版型的 `ul` 和 `li`，所以刪掉沒關係  
清空內容後在裡面加入展示區版面  
不需要帶圖片和文字，讓他自動輪播就好  

```html
<!-- 海報展示區 -->
<div style="height:300px" class="text-center">
	<!-- 海報 -->
	<img src="" height="250px" id="showpost" class="show">
	<br>
	<!-- 名片 -->
	<span id="showtext"  class="show"></span>
</div>
``` 

## 建置按鈕區

在上面的海報展示區後接著做出按鈕區  
這邊直接套第一題的校園映像來用  
先去第一題的素材複製箭頭圖 `01E01.jpg` 或 `01E01.jpg`
使用Windows內建的相片檢視器，將圖片旋轉成左右箭頭  
完成後，重命名為 `l.jpg` 和 `r.jpg` ，放到 `img` 資料夾中

```php
<!-- 按鈕區div -->
<div style="width:400px; height:100px;" class="dbor text-center">
	<?php 
		// 獲取設定的動畫樣式
		$ani = All("select * from ani")[0][0];
		// 取得所有顯示的海報，照後台設定的排列順序排
		$result = All("select * from post where display = 1 order by seq");
		// 海報總數
		$tpo = count($result);

		// 左箭頭
		if($tpo > 4) echo "<img src='img/l.jpg' onclick='pp(1)'>";
		
		// 帶入一個變數去跑，當作是海報ID
		$i = 0;
		foreach($result as $row)
		{
			?>
			<!-- 設定圖片class為im，display為inline，onclick執行動畫js -->
			<img src='img/<?=$row["file"]?>' class='im' id='ssaa<?=$i?>' width='80' height='103' style="display:inline" onclick="ani(<?=$i?>)">
			<!-- 海報名片，設為不顯示，展示時要從這裡抓資料 -->
			<span style="display:none" id='text<?=$i?>'><?=$row["text"]?></span>
			<?php
			$i++;
		}
		
		// 右箭頭
		if($tpo > 4) echo "<img src='img/r.jpg' onclick='pp(2)'>";
		?>
		<script>
		// 直接複製第一題首頁的js來修改
		// 在num帶入總數
		var nowpage=0,num=<?=$po?>;
		function pp(x)
		{
			var s,t;
			if(x==1&&nowpage-1>=0)
			{nowpage--;}
			/* 
				x=2為下一頁翻頁
				舉例:
				如果圖片數量num為10，目前第一張圖nowpage為8
				8+1<=10-3，9<=7不成立，所以不會翻到下一頁
				必須要修改這行，否則圖片會少
			*/
			if(x==2&&(nowpage+1)<=num-4)
			{nowpage++;}
			$(".im").hide()
			for(s=0;s<=3;s++)
			{
				t=s*1+nowpage*1;
				$("#ssaa"+t).show()
			}
		}
		pp(1)
	</script>
</div>
```

## 製作動畫

在頁尾加入 `script` 標籤，製作輪播動畫效果
```javascript
// 總海報數
var tpo = <?=$tpo?>;
// 目前展示海報
var po = 0;
// 動畫樣式
var anim = <?=$ani?>;
// 自動播放
setInterval(auto, 2000);

function auto()
{
	var p = po++;
	if(po > tpo) po=0;
	ani(po);
}

/*
	轉場動畫

	動畫樣式分別是:
	1 為 fadeOut，為題目規定的淡入
	2 為 slideToggle，為題目規定的縮放
	3 為 slideUp，為題目規定的滑出
*/
function ani(post)
{
	// 先出場動畫
	// 在函式裡面加入換圖換字的function，在出場後才執行換圖
	// 不然實際網頁看起來會變成 換圖->出場動畫->進場動畫
	if(anim == 1)		$(".show").fadeOut(function(){change(post);});
	else if(anim == 2)	$(".show").slideToggle(function(){change(post);});
	else if(anim == 3)	$(".show").slideUp(function(){change(post);});
	
	// 再進場動畫
	if(anim == 1)		$(".show").fadeIn();
	else if(anim == 2)	$(".show").slideToggle();
	else if(anim == 3)	$(".show").slideDown();
}

// 將海報展示區的圖和字換成下一個海報的
function change(post)
{
	// 將下一個海報的圖帶入展示區
	$("#showpost").attr("src", $("#ssaa"+post).attr("src") );
	// 將下一個海報的名字帶入展示區
	$("#showtext").text( $("#text"+post).text() );
	// 變更目前播放的海報
	po = post;
}
```