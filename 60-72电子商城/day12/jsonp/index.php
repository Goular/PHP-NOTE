<?php
	//同源专用
	$data = array(
		'id'=>12,
		'name'=>'goular'
	);
	$str = json_encode($data);
	
	//跨域写法
	echo "abc($str);";