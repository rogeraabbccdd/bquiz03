<?php
	$link = mysqli_connect("localhost", "root", "", "dbxx3");
	mysqli_query($link, "set names utf8");
	session_start();
	$time=["14:00~16:00","16:00~18:00","18:00~20:00","20:00~22:00","22:00~24:00"];
?>