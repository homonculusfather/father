<?php 
session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_menbre;charset=utf8','root','');

if(isset($_GET['id']) AND $_SESSION['user_admin'] == 1 ){

if(isset($_GET['confirm']) AND !empty($_GET['confirm']))
{
	$confirm = (int) $_GET['confirm'];
	$req = $bdd->prepare("UPDATE menbre SET confirm = 1 WHERE id = ?");
	$req->execute(array($confirm));
	echo "<b>confirmation reussie</b>";

}

if(isset($_GET['supprime']) AND !empty($_GET['supprime']))
{
	$supprime = (int) $_GET['supprime'];
	$req = $bdd->prepare("DELETE FROM menbre WHERE id = ?");
	$req->execute(array($supprime));
	echo "<b>Suppression reussie</b>";	

}









$menbres = $bdd->query("SELECT * FROM menbre  ORDER BY id DESC LIMIT 10");
 ?>





<!DOCTYPE html>
<html>
<head>
	<title>administration</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body style="background: #eee;"><hr><hr>
<div class="container alert alert-info">
	<h6 align="center" class="alert-sm alert-info">ADMINISTRATION <a class="alert alert-info" style="margin-left: 900px; color: red; border-color: red;" href="deconnexion.php">deconnexion</a></h6>
</div>

<div class="container" align="right">
	<a href="liste.php" class="btn btn-info">liste de tous les eleves</a>
	<a href="gestion.php" class="btn btn-info">gestion</a>
	<a href="montage.php" class="btn btn-info">montage</a>
	<a href="reaTV.php" class="btn btn-info">realisation TV</a>
	<a href="reseau.php" class="btn btn-info">reseaux</a>
	<a href="WebM.php" class="btn btn-info">Web master</a>
	<a href="InfoG.php" class="btn btn-info">Infographie</a>
</div><br><br><br><br>

<div class=" container alert alert-warning">
	<p align="center" style="text-transform: uppercase; background: #ddd;">liste des 10 derniers eleves inscrits</p>
	<ul>
		<?php while ($m = $menbres->fetch()) { ?>
		<li class="form-control"><?php echo $m['pseudo']; ?> -<?php if($m['confirm']== 0){  ?> <a  style="width: 10%; margin-left: 900px;" class="form-control btn btn-primary" href="administration.php?confirm=<?= $m['id'] ?>">Confirm</a><?php } ?> -<hr> <a  style="width: 10%; margin-left: 900px;" class=" btn btn-danger" href="administration.php?supprime=<?= $m['id'] ?>">&times</a></li><hr><hr>
		<?php } ?>
	</ul>
</div>

</body>
</html>
<?php }
else{
	header('Location:connexion.php');
}

 ?>