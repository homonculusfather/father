<?php  
session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_menbre','root','');
if(isset($_SESSION['id']) AND !empty($_SESSION['id']) AND $_SESSION['confirm']==1){
	echo $_SESSION['filiere'];

	if(isset($_GET['note']) AND !empty($_GET['note'])){
		$note = (int) $_GET['note'];
		$req = $bdd->prepare("SELECT matricule FROM menbre WHERE id = ?");
		$req->execute(array($note));
		$n = $req->fetch();
		echo "<p align=\"center\" class=\"container btn-warning\">matricule de l'etudiant: ".$n['matricule']."<p>";
		echo "note";
		if (isset($_POST['valid'])) {
			if (isset($_POST['note1'],$_POST['note2']) AND !empty($_POST['note1']) AND !empty($_POST['note2'])) {
				$note1 = htmlspecialchars($_POST['note1']);
				$note2 = htmlspecialchars($_POST['note2']);
				$notefinal = (($note2*3) + $note1) / 4;
				$edit = $bdd->prepare("UPDATE menbre SET note1 = ? WHERE id = ?");
				$edit->execute(array($note1,$note));

				$edit = $bdd->prepare("UPDATE menbre SET note2 = ? WHERE id = ?");
				$edit->execute(array($note2,$note));

				$edit = $bdd->prepare("UPDATE menbre SET notefinal = ? WHERE id = ?");
				$edit->execute(array($notefinal,$note));

				echo "<script>alert('note ajoutee');</script>";
			}
			else{
				echo "<script>alert('tous les champs doivent etre rempli');</script>";
			}
		}

?>
<form method="post" action="" class="container alert-info form-group">
	<p align="center">note1<input type="number"  name="note1" class="form-control"></p>
	<p align="center">note2<input type="number"  name="note2" class="form-control"></p>
	<button type="submit" name="valid" class="form-control btn btn-success">ajouter</button>
</form>
<?php 
	}

	if(isset($_GET['absence']) AND !empty($_GET['absence'])){
		$absence = (int) $_GET['absence'];
		$req = $bdd->prepare("SELECT matricule FROM menbre WHERE id = ?");
		$req->execute(array($absence));
		$n = $req->fetch();
		echo "<p align=\"center\" class=\"container btn-warning\">matricule de l'etudiant: ".$n['matricule']."<p>";
		echo "absence";
			if (isset($_POST['vali'])) {
			if (isset($_POST['abs']) AND !empty($_POST['abs'])) {
				$abs = htmlspecialchars($_POST['abs']);
				$edi = $bdd->prepare("UPDATE menbre SET absence = ? WHERE id = ?");
				$edi->execute(array($abs,$absence));

				echo "<script>alert('absence ajoutee');</script>";
			}
			else{
				echo "<script>alert('tous les champs doivent etre rempli');</script>";
			}
		}



?>
	<form method="post" action="" class="container alert-info form-group">
	<p align="center">--ABSENCE--<input type="number"  name="abs" class="form-control"></p>
	<button type="submit" name="vali" class="form-control btn btn-success">ajouter</button>
</form>

<?php
	}


	if(isset($_GET['sanction']) AND !empty($_GET['sanction'])){
		$sanction = (int) $_GET['sanction'];
		$req = $bdd->prepare("SELECT matricule FROM menbre WHERE id = ?");
		$req->execute(array($sanction));
		$n = $req->fetch();
		echo "<p align=\"center\" class=\"container btn-warning\">matricule de l'etudiant: ".$n['matricule']."<p>";
		echo "sanction";
		if (isset($_POST['val'])) {
			if (isset($_POST['san']) AND !empty($_POST['san'])) {
				$san = htmlspecialchars($_POST['san']);
				$edi = $bdd->prepare("UPDATE menbre SET sanction = ? WHERE id = ?");
				$edi->execute(array($san,$sanction));

				echo "<script>alert('sanction ajoutee');</script>";
			}
			else{
				echo "<script>alert('tous les champs doivent etre rempli');</script>";
			}
		}
?>

	<form method="post" action="" class="container alert-info form-group">
	<p align="center">--SANCTION--<select  name="san" class="form-control">
		<option>exclusion 2 heurs</option>
		<option>exclusion 4 heures</option>
		<option>exclusion 24 jours</option>
		<option>exclusion 3 jours</option>
		<option>exclusion 7 jours</option>
		<option>exclusion 28 jours</option>
		<option>exclusion definitive</option>
	</select></p>
	<button type="submit" name="val" class="form-control btn btn-success">ajouter</button>
</form>

<?php		
	}






$etudiants = $bdd->prepare("SELECT * FROM menbre WHERE session = ? AND specialite = ?");
$etudiants->execute(array($_SESSION['session'], $_SESSION['filiere']));

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<title>espace enseignant</title>
</head>
<body style="background: #eee;"><br><br><br>
	
<table class="table" border="3">
	<p align="center"><b>LISTE DES ETUDIANTS</b></p>
	<tr class="alert-info">
		<th>id</th>
		<th>matricule</th>
		<th>nom</th>
		<th>prenom</th>
		<th>note1</th>
		<th>note2</th>
		<th>note final</th>
		<th>sanction</th>
		<th>absence</th>
		<th>decision</th>
		<th>action</th>
	</tr>
	<?php while($m = $etudiants->fetch()) {  ?>
	<tr >
		<td><?= $m['id']?></td>
		<td><?= $m['matricule']?></td>
		<td><?= $m['first']?></td>
		<td><?= $m['last']?></td>
		<td><?= $m['note1']?></td>
		<td><?= $m['note2']?></td>
		<td><?= $m['notefinal']?></td>
		<td><?= $m['sanction']?></td>
		<td><?= $m['absence']?></td>
		<td><?= $m['decision']?></td>
		<td><p style="margin:5px;"> <a class="btn-sm btn-primary"  href="enseignant.php?note=<?= $m['id']?>">ajouter note</a><br><br>
		 <a class="btn-sm btn-danger" href="enseignant.php?absence=<?= $m['id']?>">ajouter absence</a> <br><br>
		<a class="btn-sm btn-warning" href="enseignant.php?sanction=<?= $m['id']?>">sanction</a></p></td>

	</tr>
	<?php } ?>
</table><br>

<div align="right" class="container">
		<a class="btn-sm btn-info" href="enseignant.php?id=<?$_SESSION['id']?>">actualiser</a>
		<a href="" class="btn-sm btn-success">nouveau module</a>
		<a href="redaction.php?id=<?= $_SESSION['id']?>" class="btn-sm btn-primary">publier un article</a>
		
		<a href="deconnexion.php" class="btn-sm btn-danger">deconnexion</a>
	</div><br>

</body>
</html>
<?php }
else{
	header('Location:util.php');
}

 ?>
