<?php
session_start();
//выделяем уникальный идентификатор сессии
$id = session_id();

if ($id!="") {
 //текущее время
 $CurrentTime = time();
 //через какое время сессии удаляются
 $LastTime = time() - 600;
 //файл, в котором храним идентификаторы и время
 $base = "session.txt";

 $file = file($base);
 $k = 0;
 for ($i = 0; $i < sizeof($file); $i++) {
  $line = explode("|", $file[$i]);
   if ($line[1] > $LastTime) {
   $ResFile[$k] = $file[$i];
   $k++;
  }
 }

 for ($i = 0; $i<sizeof($ResFile); $i++) {
  $line = explode("|", $ResFile[$i]);
  if ($line[0]==$id) {
      $line[1] = trim($CurrentTime)."\n";
      $is_sid_in_file = 1;
  }
  $line = implode("|", $line); $ResFile[$i] = $line;
 }

 $fp = fopen($base, "w");
 for ($i = 0; $i<sizeof($ResFile); $i++) { fputs($fp, $ResFile[$i]); }
 fclose($fp);

 if (!$is_sid_in_file) {
  $fp = fopen($base, "a-");
  $line = $id."|".$CurrentTime."\n";
  fputs($fp, $line);
  fclose($fp);
 }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
<title>Форум</title>
<link rel="stylesheet" href="man.css">
<meta charset="utf-8_general_ci">
</head>
<body>

	<section class="clearfix">
	<div>
		<div class="message">Сюда будут приходить сообщения:<br>
			<div class="sms">
			<?php
				include "set.php";
			?>
			</div>
		</div>

		<div class="list">Здесь будут показаны пользователи:<br>
			<?php
				include "name.php";
				echo "Сейчас на сайте: <b>".sizeof(file($base))."</b>";
				echo "<br>";
				if($_SERVER['SERVER_ADDR']==$ip)
					{echo "<strong style='color:green'>$name</strong>";}
			?>
		<br></div>
		
		<div class="sendpanel">
		<form action="" method="POST">
			<input type="text" name="some_text" id="user">
			<input type="submit" name="send">
		</form>
		</div>
	</div>
	</section>
	
</body>
</html>