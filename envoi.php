<?php 
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=espace_menbre;charset=utf8','root','');

if(isset($_SESSION['id']) AND !empty($_SESSION['id'])) { 
if(isset($_POST['envoi']))
{
	if(isset($_POST['destinataire'],$_POST['message']) AND !empty($_POST['destinataire']) AND !empty($_POST['message']))
	{
		$destinataire = htmlspecialchars($_POST['destinataire']);
		$message = htmlspecialchars($_POST['message']);		
		
		$id_destinataire = $bdd->prepare("SELECT id FROM menbre WHERE pseudo = ?");
		$id_destinataire->execute(array($destinataire));
		$d_exist = $id_destinataire->rowCount();
		if($d_exist == 1)
		{
			$id_destinataire = $id_destinataire->fetch();
		//var_dump($id_destinataire);
		$id_destinataire = $id_destinataire['id'];
		//var_dump($id_destinataire); 
		$ins = $bdd->prepare('INSERT INTO messagerie(id_expediteur,id_destinataire,message) VALUES (?,?,?)');
		$ins->execute(array($_SESSION['id'],$id_destinataire,$message));

		$reussie = "votre message a bien ete envoye le ".date('d M Y');
		}
		else{
			$erreur = "cet utilisateur n'existe pas";
		}
		
	}
	else{
	$erreur = "veuillez completer tous les champs ";
}


}

$destinataires = $bdd->query("SELECT * FROM menbre ORDER BY pseudo");


 ?>







<!DOCTYPE html>
<html>
<head>
	<title>Envoi</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body style="background: #eee;"><br><br><br>
<div class="container">
	<?php 
	if(isset($reussie))
	{
		echo "<div class=\"alert\"> <p class=\"alert alert-success\">".$reussie."</p></div>";
	}
	 ?>
<form method="post" action="" class="form-control" >
	<select name="destinataire" class="form-control">
		<?php while($d = $destinataires->fetch()) {  ?>
		<option><?= $d['pseudo']; ?></option>
		<?php } ?>  
	</select><br>
	<textarea required="required" placeholder="Votre message" class="form-control" name="message"></textarea><br>
	<button type="submt" class="form-control btn btn-info" name="envoi">Envoyer</button>
	<?php 
	if(isset($erreur))
	{
		echo "<div class=\"alert\"> <p class=\"alert alert-danger\">".$erreur."</p></div>";
	}
	 ?>
</form>
<a href="reception.php" class="alert ">Boite de reception</a>
</div>
</body>
</html>
<?php }else{
	header('Location: connexion.php');
} ?>