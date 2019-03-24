<?php
	include("sql.php");

	switch($_GET["do"]){
		case "gd":
			$on = All("select * from movie where id = ".$_POST["m"])[0]["ondate"];

			for($i=0;$i<3;$i++)
			{
				$date = strtotime("+ ".$i." days", $on);
				$date2 = date("Y-m-d", $date);
				echo "<option value='".$date."'>".$date2."</option>";
			}
			break;

		case "gt":
			$seat = array(20,20,20,20,20);  
			$result = All("select seat, time from orders where movie = '".$_POST["m"]."' and date = '".$_POST["d"]."'");
			foreach($result as $row)
			{
				$s = unserialize($row["seat"]);
				$seat[$row["time"]] -= count($s);
			}
			for($i=0;$i<5;$i++)
			{
				echo "<option value='".$i."'>".$time[$i]." 剩餘座位：".($seat[$i])."</option>";
			}
			break;

		case "post":
			All("update ani set ani = '".$_POST["ani"]."'");
			for($i=0;$i<count($_POST["id"]); $i++){
				All("update post set text = '".$_POST["text"][$i]."', seq = '".$_POST["seq"][$i]."' where id = '".$_POST["id"][$i]."'");
			}
			All("update post set display = 0");
			foreach($_POST["dis"] as $d){
				All("update post set display = 1 where id = '".$d."'");
			}
			foreach($_POST["del"] as $d){
				All("delete from post where id = '".$d."'");
			}
			lo("admin.php?redo=rr");
			break;

		case "npost":			
			$seq = All("select seq from post order by seq desc limit 1")[0][0] +1;
			All("insert into post values (null, '', '".$_POST["text"]."', 1, '".$seq."')");
			$id = $pdo->lastInsertId();
			Upload($_FILES, "post", $id);
			lo("admin.php?redo=rr");
			break;

		case "movie":
			for($i=0;$i<count($_POST["id"]); $i++){
				All("update movie set seq = '".$_POST["seq"][$i]."' where id = '".$_POST["id"][$i]."'");
			}
			All("update movie set display = 0");
			foreach($_POST["dis"] as $d){
				All("update movie set display = 1 where id = '".$d."'");
			}
			foreach($_POST["del"] as $d){
				All("delete from movie where id = '".$d."'");
			}
			lo("admin.php?redo=vv");
			break;

		case "nmovie":
			$_POST["display"] = 1;
			$_POST["seq"] = All("select seq from post order by seq desc limit 1")[0][0] +1;
			$_POST["ondate"] = strtotime($_POST["day"]."-".$_POST["month"]."-".$_POST["year"]);
			All("insert into movie (id) values (null);");	
			$id = $pdo->lastInsertId();
			foreach($_POST as $k => $v){
				if($k == "day" || $k == "year" || $k == "month") continue;
				All("update movie set ".$k." = '".$v."' where id = '".$id."'");
			}
			Upload($_FILES, "movie", $id);
			lo("admin.php?redo=vv");
			break;

		case "emovie":
			$_POST["ondate"] = strtotime($_POST["day"]."-".$_POST["month"]."-".$_POST["year"]);
			foreach($_POST as $k => $v){
				if($k == "day" || $k == "year" || $k == "month") continue;
				All("update movie set ".$k." = '".$v."' where id = '".$_GET["id"]."'");
			}
			Upload($_FILES, "movie", $_GET["id"]);
			lo("admin.php?redo=vv");
			break;

		case "delord":
			All("delete from orders where id = '".$_GET["id"]."'");
			lo("admin.php?redo=order");
			break;

		case "fastdel":
			if($_POST["mode"] == 1)
			{
				$date = strtotime($_POST["date"]);
				All("delete from orders where date = '".$date."'");
			}
			elseif($_POST["mode"] == 2)
			{
				All("delete from orders where movie = '".$_POST["movie"]."'");
			}
			lo("admin.php?redo=order");
			break;
	}
?>