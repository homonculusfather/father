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
if (isset($_POST['matiere'])) {
	$matiere = htmlspecialchars($_POST['matiere']);
	$destinataires = $bdd->prepare("SELECT * FROM menbre WHERE specialite = ? ORDER BY pseudo");
	$destinataires->execute(array($matiere));
}

 ?>




<!DOCTYPE html>
<html>
<head>
	<title>Envoi</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body style="background: #eee;"><br><br><br>
<h1 align="center" style="letter-spacing: 4px;text-transform: uppercase;border:2px solid black;">envoi</h1>
<div class="container">


<?php 

if (!isset($_POST['ok'])) {
	echo "<font color=\"red\">valider d'abord une specialite appuyer sur ok</font>";
}


 ?>
	<?php 
	if(isset($reussie))
	{
		echo "<div class=\"alert\"> <p class=\"alert alert-success\">".$reussie."</p></div>";
	}
	 ?>
	 
	<p align="left"><a class="btn-sm btn-danger" href="profil.php?id=<?=$_SESSION['id']?>">&nbsp;retour</a></p>
	 <p align="right"><a href="reception.php?id=<?$_SESSION['id']?>" class="btn-sm btn-success ">Boite de reception</a></p>
	 
	 <br>
	 <form method="post" action="">
	<label align="left" style="text-transform: uppercase;">--Specialite--<select class="alert alert-success form-control" required="required" name="matiere">
			<option>Infographie <span style="color: #777"> (BAC min.)</span></option>
			<option>Webmaster<span style="color: #777"> (BAC SCI min.)</span></option>
			<option>montage audiovisuel<span style="color: red"> (BAC min.)</span></option>
			<option>realisation TV<span style="color: #777"> (PROB min.)</span></option>
			<option>Secretariat <span style="color: #777">(PROB min.)</span></option>
			<option>Beaute<span style="color: #777"> (BEPC min.)</span></option>
			<option>gestion<span style="color: #777"> (BAC min.)</span></option>
			<option>reseaux<span style="color: #777"> (BAC SCI min.)</span></option>
		</select></label><button name="ok" type="submit" class=" btn-lg btn-primary">ok</button><br><br><hr>
</form>
<p style="text-transform: uppercase;">--liste des etudiants--</p>
<form method="post" action="" class="form-group" >
	<select name="destinataire" class="alert alert-primary form-control">
		<?php while($d = $destinataires->fetch()) {  ?>
		<option><?= $d['pseudo']; ?></option>
		<?php } ?>  
	</select><br>
	<textarea required="required" placeholder="Votre message" class="form-control" name="message"></textarea><br>
	<button type="submit" class="form-control btn-sm btn-info" name="envoi">Envoyer</button>
	<?php 
	if(isset($erreur))
	{
		echo "<div class=\"alert\"> <p class=\"alert alert-danger\">".$erreur."</p></div>";
	}
	 ?>
</form><br>
</div>
</body>
</html>
<?php }else{
	header('Location: connexion.php');
} ?>