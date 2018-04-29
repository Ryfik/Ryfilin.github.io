<?php
	if(isset($_POST['youre_name']))
	{
		$name = $_POST ['nick'];
		$all_text = "$name";
		$file=fopen("nickname.txt", "r+");
		fwrite ($file, $all_text);
		fclose($file);
	}
	$ip = $_SERVER['SERVER_ADDR'];
?>