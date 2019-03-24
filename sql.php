<?php
	$pdo = new PDO("mysql:host=localhost;dbname=dbxx3;charset=utf8", "root", "");
	session_start();
	function All($sql)
	{
		global $pdo;
		return $pdo->query($sql)->fetchAll();
	}

	function lo($l)
	{
		return header("location:".$l);
	}

	function sql($tb, $dis)
	{
		$r = "select * from ".$tb;
		if($dis) 	$r .= " where display = 1";
		
		return $r;
	}

	$level = array("", "普遍級", "保護級", "輔導級", "限制級");
	$today = strtotime("today");
	$now = strtotime("now");
	$time=["14:00~16:00","16:00~18:00","18:00~20:00","20:00~22:00","22:00~24:00"];

	function Upload($file, $table, $id){
		global $now;
		foreach($_FILES as $name => $file){
			$ext = pathinfo($file["name"], PATHINFO_EXTENSION);
			$fn = $now.".".$ext;
			copy($file["tmp_name"], "img/".$fn);
			All("update ".$table." set ". $name." = '".$fn."' where id = '".$id."'");
		}
	}
?>