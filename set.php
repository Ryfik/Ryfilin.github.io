<?php
include "name.php";
if(isset($_POST['send']))
	{
		$e = $_POST['some_text'];
		$file=fopen("nickname.txt", "r");
		$name = htmlentities(file_get_contents('nickname.txt'));
		//$name = iconv('UTF-8', 'WINDOWS-1251', $name);
		fclose($file);
		$all_text = "<div style='color:blue'><strong>$name: </strong>$e<br></div>";
		$file=fopen("text.txt", "a");
		fwrite ($file, $all_text);
		$text = file_get_contents('text.txt');
		echo $text;
		fclose($file);
	}
?>