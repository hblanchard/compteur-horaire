<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Stop</title>
	<link rel="stylesheet" href="style.css">
</head>

<body>
	<section>
		<?php

		if ($_POST['timeStart']==1){
			$cnx = new PDO('mysql:host=localhost;dbname=compteur-horaire','root', 'root');

			$s = $cnx->prepare("INSERT INTO compteur SET date=?, timeStart=?");

			$s->execute(array(date('Y-m-d'), mktime()));
			$s = $cnx->prepare("SELECT max(id) FROM compteur");
			$s->execute();
			$r = $s->fetch();

			$_POST['timeStart']=0;
		}?>

		<h1>POINTAGE 2.0</h1>

		<form action="index.php" method="post">
			<input type="hidden" name="id" value="<?php echo $r[0];?>">
			<input type="hidden" name="timeStop" value="1">
			<button style="stop">Fin de journée</button>
		</form>
	</section>
</body>
</html>