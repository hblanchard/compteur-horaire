<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Lancer une nouvelle session</title>
	<link rel="stylesheet" href="style.css">
</head>

<body>
	<section>
		<h1>POINTAGE 2.0</h1>
		
		<form action="stop.php" method="post">
			<input type="hidden" name="timeStart" value="1">
			<button>Commencer</button>
		</form>
		
		<?php
			if ($_POST['timeStop']==1){
				$cnx = new PDO('mysql:host=localhost;dbname=compteur-horaire','root', 'root');

				$s = $cnx->prepare("UPDATE compteur SET timeStop=? WHERE id=?");

				$s->execute(array(mktime(), $_POST['id']));

				$_POST['timeStop']=0;

				$s = $cnx->prepare("SELECT * FROM compteur WHERE id=?");
				$s->execute(array($_POST['id']));

				$r = $s->fetch();

				$start = $r['timeStart'];
				$stop = $r['timeStop'];
				$result = $stop - $start;
				?>
		
					<p>Dernière session de travail</p>
		
				<?php
				echo date('H:i:s', $result);
				$s = $cnx->prepare("UPDATE compteur SET totalTime=? WHERE id=?");
				$s->execute(array($result, $_POST['id']));
			}?>
	</section>
</body>
</html>