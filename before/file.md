---
description: 在考前安裝XAMPP時利用時間整理各題素材
---

# 整理檔案

## 重新命名檔案
將素材 `版型檔案` 資料夾裡所有檔案複製出來，將個副檔名為 `htm` 的檔案更名  
這題少給了訂票的版型，不過沒關係，複製其中一頁把內容區清空就好了，我選的是影片介紹頁  

- `03P01.htm` 更名為 `index.php`
- `03P02.htm` 更名為 `movie.php`
- `03P03.htm` 更名為 `admin.php`
- 複製 `movie.php`，更名為 `book.php` (訂票頁)、`seat.php` (座位選擇頁)、`out.php` (訂票成功頁)
- 複製完後把 `<div class="tab rb" style="width:87%;">` 裡面的  
  `<div class="tab rb" style="width:87%;">`內容清空


## 整理圖片檔
建立 `img` 資料夾，把圖片和影片都放進去  
重新命名分級圖檔，照分級順序命名為 `1.png` 到 `4.png`  
這樣直接以資料庫分級欄位值加個附檔名就能用了  
圖片和影片都放同一個資料夾就不用判斷是圖片還是影片資料夾  

## 影片轉檔
由於 Chrome 不支援`.avi`檔的播放，所以建議將影片轉檔，不然就是使用IE進行評量  
本人考照的地方有提供 `Adobe Media Encoder` 可以將影片轉成Chrome支援的MP4檔






