<?php
	header("Access-Control-Allow-Origin: *");//這個必寫，否則報錯
	$mysqli=new mysqli('localhost','root','SD89bK8vC5Pi','User_ESP32_001');//根據自己的資料庫填寫

    
    
    $sql = "SELECT id, Stride_Cadence FROM D202106151550 order by Reading_time desc limit 40";
	$res=$mysqli->query($sql);

	$arr=array();
	while ($row=$res->fetch_assoc()) {
		$arr[]=$row;
	}

    $reversedArray = array_reverse($arr);

	$res->free();
	//關閉連線
	$mysqli->close();
	
	echo(json_encode($reversedArray));//這裡用echo而不是return

?>
