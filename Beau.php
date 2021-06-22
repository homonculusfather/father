<?php 

$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_menbre;charset=utf8','root','');
$req = $bdd->query("SELECT * FROM menbre WHERE specialite = 'beaute' ORDER BY id DESC LIMIT 30");
$c = $req->rowCount();
 ?>



<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<title>beau</title>

</head>
<body style="background: #eee;"><br><br>
	<h1 class="container alert alert-warning">SPECIALITE: BEAUTE</h1>
	<div class="container alert alert-info">
		<?php if($c == 0)
		{
			echo "<p> Aucun resultat</p>";
		}

		 ?>
	<ul>
<?php while($m = $req->fetch()) {  ?>
<li style="text-transform: uppercase;"><?php echo $m['first']; ?></li><li><?php echo $m['last']; ?></li><li><?php echo $m['sexe']; ?></li><li><?php echo $m['email']; ?></li><li><?php echo $m['age']." ans"; ?></li> <li><img class="img-thumbnail" style="width: 400px;" src="photo/<?php echo $m['photo']; ?>"> </li><hr>
<?php } ?>
</ul>
</div>
</body>
</html>