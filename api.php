<?php
	include "sql.php";
	
	if(!empty($_GET["do"]))
	{
		if($_GET["do"] == "npost")
		{
			$seq = mysqli_fetch_array(mysqli_query($link, "select * from post order by seq desc limit 1"))["seq"];
			$seq += 1;
			mysqli_query($link, "insert into post values(null, '', '".$_POST["text"]."', 1, '".$seq."', 1);");

			if(!empty($_FILES["file"]))
			{
				$id = mysqli_insert_id($link);
				$name = strtotime("now");
				$ext = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
				mysqli_query($link, "update post set file = '".$name.".".$ext."' where id = '".$id."'");
				copy($_FILES["file"]["tmp_name"], "./post/".$name.".".$ext);
			}
		}
		elseif($_GET["do"] == "psequp")
		{
			$seq = mysqli_fetch_array(mysqli_query($link, "select * from post where id = '".$_POST["id"]."' limit 1"))["seq"];
			
			$s = $seq-1;
			// 上一個往下
			mysqli_query($link, "update post set seq = seq +1 where seq = ".$s);
			mysqli_error($link);
			
			// 往上
			mysqli_query($link, "update post set seq = seq -1 where id = ".$_POST["id"]);
			mysqli_error($link);
		}
		elseif($_GET["do"] == "pseqdown")
		{
			$seq = mysqli_fetch_array(mysqli_query($link, "select * from post where id = '".$_POST["id"]."' limit 1"))["seq"];
			
			$s = $seq+1;
			// 下一個往上
			mysqli_query($link, "update post set seq = seq -1 where seq = ".$s);
			mysqli_error($link);
			
			// 往下
			mysqli_query($link, "update post set seq = seq +1 where id = ".$_POST["id"]);
			mysqli_error($link);
		}
		elseif($_GET["do"] == "post")
		{
			for($i=0;$i<count($_POST["id"]); $i++)
			{
				mysqli_query($link, "update post set text = '".$_POST["text"][$i]."', ani = '".$_POST["ani"][$i]."' where id = '".$_POST["id"][$i]."'");
			}
			
			mysqli_query($link, "update post set display = 0");
			
			foreach($_POST["dis"] as $d)
			{
				mysqli_query($link, "update post set display = 1 where id = '".$d."'");
			}
			
			foreach($_POST["del"] as $dd)
			{
				mysqli_query($link, "update post set display = 1 where id = '".$dd."'");
			}
			
			header("location:admin.php?redo=rr");
		}
		elseif($_GET["do"] == "vsequp")
		{
			$seq = mysqli_fetch_array(mysqli_query($link, "select * from movie where id = '".$_POST["id"]."' limit 1"))["seq"];
			
			$s = $seq-1;
			// 上一個往下
			mysqli_query($link, "update movie set seq = seq +1 where seq = ".$s);
			mysqli_error($link);
			
			// 往上
			mysqli_query($link, "update movie set seq = seq -1 where id = ".$_POST["id"]);
			mysqli_error($link);
		}
		elseif($_GET["do"] == "vseqdown")
		{
			$seq = mysqli_fetch_array(mysqli_query($link, "select * from movie where id = '".$_POST["id"]."' limit 1"))["seq"];
			
			$s = $seq+1;
			// 下一個往上
			mysqli_query($link, "update movie set seq = seq -1 where seq = ".$s);
			mysqli_error($link);
			
			// 往下
			mysqli_query($link, "update movie set seq = seq +1 where id = ".$_POST["id"]);
			mysqli_error($link);
		}
		elseif($_GET["do"] == "movie")
		{
			mysqli_query($link, "update movie set display = 0");
			
			foreach($_POST["dis"] as $d)
			{
				mysqli_query($link, "update movie set display = 1 where id = '".$d."'");
			}
			
			foreach($_POST["del"] as $dd)
			{
				mysqli_query($link, "update movie set display = 1 where id = '".$dd."'");
			}
			
			header("location:admin.php?redo=vv");
		}
		elseif($_GET["do"] == "emovie")
		{
			$date = strtotime($_POST["day"]."-".$_POST["month"]."-".$_POST["year"]);
			mysqli_query($link, "update movie set ondate = '".$date."' where id = '".$_GET["id"]."'");
			
			foreach($_POST as $n => $v)
			{
				if($n != "month" && $n != "day" && $n != "year")
				{
					mysqli_query($link, "update movie set ".$n." = '".$v."' where id = '".$_GET["id"]."'");
				}
			}
			
			foreach($_FILES as $n => $v)
			{
				print_r($v);
				$name = strtotime("now");
				$ext = pathinfo($v["name"], PATHINFO_EXTENSION);
				copy($v["tmp_name"], "movie/".$name.".".$ext);
				mysqli_query($link, "update movie set ".$n." = '".$name.".".$ext."' where id = '".$_GET["id"]."'");
				echo mysqli_error($link);
			}
			
			header("location:admin.php?redo=vv");
		}
		elseif($_GET["do"] == "nmovie")
		{
			mysqli_query($link, "insert into movie (id, display) values (null, 1)");
			$id = mysqli_insert_id($link);
			$date = strtotime($_POST["day"]."-".$_POST["month"]."-".$_POST["year"]);
			mysqli_query($link, "update movie set ondate = '".$date."' where id = '".$id."'");
			
			foreach($_POST as $n => $v)
			{
				if($n != "month" && $n != "day" && $n != "year")
				{
					mysqli_query($link, "update movie set ".$n." = '".$v."' where id = '".$id."'");
				}
			}
			
			foreach($_FILES as $n => $v)
			{
				$name = strtotime("now");
				$ext = pathinfo($v["name"], PATHINFO_EXTENSION);
				copy($v["tmp_name"], "movie/".$name.".".$ext);
				mysqli_query($link, "update movie set ".$n." = '".$name.".".$ext."' where id = '".$id."'");
			}
			
			header("location:admin.php?redo=vv");
		}
		elseif($_GET["do"] == "gd")
		{
			$result = mysqli_query($link, "select * from movie where id = ".$_POST["m"]);
			$on = mysqli_fetch_array($result)["ondate"];
			
			for($i=0;$i<3;$i++)
			{
				$date = strtotime("+ ".$i." days", $on);
				$date2 = date("Y-m-d", $date);
				
				if($i == 0)	echo "<option value='".$date."' selected='selected'>".$date2."</option>";
				else echo "<option value='".$date."'>".$date2."</option>";
			}
		}
		elseif($_GET["do"] == "gt")
		{
			$result = mysqli_query($link, "select seat from orders where movie = '".$_POST["m"]."' and date = '".$_POST["d"]."'");
			$seat = array();
			while($row = mysqli_fetch_array($result))
			{
				$s = unserialize($row["seat"]);
				$seat = array_merge($seat, $s);
			}
			$left = 20-count($seat);
			for($i=0;$i<5;$i++)
			{
				echo "<option value='".$i."'>".$time[$i]." 剩餘座位：".$left."</option>";
			}
		}
		elseif($_GET["do"] == "delord")
		{
			mysqli_query($link, "delete from order where id = '".$_GET["id"]."'");
		}
		elseif($_GET["do"] == "fastdel")
		{
			if($_POST["mode"] == 1)
			{
				$date = strtotime($_POST["date"]);
				mysqli_query($link, "delete from orders where date = '".$date."'");
			}
			elseif($_POST["mode"] == 2)
			{
				mysqli_query($link, "delete from orders where movie = '".$_POST["movie"]."'");
			}
			header("location:admin.php?redo=order");
		}
	}
?>