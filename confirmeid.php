<?php 
session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_menbre;charset = utf8','root','');
$menbres = $bdd->query('SELECT * FROM menbres ORDER BY id DESC LIMIT 0,5');

if(isset($_GET['id']))
{
	$getid = $_GET['id'];
	$req = $bdd->prepare("SELECT * FROM menbre WHERE id =?");
	$req->execute(array($getid));
	$user = $req->fetch();
	if(isset($_SESSION['id']) AND $user['id'] == $_SESSION['id'])
	{
		$del = $bdd->prepare("UPDATE menbre SET confirm = 1 WHERE id = ?");
		$del->execute(array($_SESSION['id']));
		echo "<p><b>confirmation reussie</b></p>";
	}
	else{
		echo "non";
		//header('Location:connexion.php');
	}
}


 ?>

