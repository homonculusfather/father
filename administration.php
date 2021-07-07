		<!DOCTYPE html>
		<html>
		<head>
			<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
			<link rel="stylesheet" type="text/css" href="fonts/font-awesome.min.css">
			<title>ADMINISTRATION</title>
			<meta charset="utf-8">
		</head>
		<body style="background: #eee;">
<?php 
session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_menbre;charset=utf8','root','');

 	if(isset($_SESSION['id']) AND ($_SESSION['user_admin']==1)){ 

 		
 		if (isset($_GET['edit']) AND !empty($_GET['edit'])) {
			$edit = (int) $_GET['edit'];	

			if(isset($_POST['newmatiere']) AND !empty($_POST['newmatiere']))
		{
				  $newmatiere = htmlspecialchars($_POST['newmatiere']);
				  $editmatiere = $bdd->prepare("UPDATE menbre SET specialite = ? WHERE id = ?");
				  $editmatiere->execute(array($newmatiere,$_GET['edit']));
				  echo "<script>alert('edition reussie');</script>";
				  
		}


			if(isset($_POST['newdate']) AND !empty($_POST['newdate']))
		{
				  $newdate = htmlspecialchars($_POST['newdate']);
				  $editdate = $bdd->prepare("UPDATE menbre SET naissance= ? WHERE id = ?");
				  $editdate->execute(array($newdate,$_GET['edit']));
				  echo "<script>alert('edition reussie');</script>";
				  
		}

			if(isset($_POST['newfirst']) AND !empty($_POST['newfirst']))
		{
				  $newfirst = htmlspecialchars($_POST['newfirst']);
				  $editfirst = $bdd->prepare("UPDATE menbre SET first = ? WHERE id = ?");
				  $editfirst->execute(array($newfirst,$_GET['edit']));
				  echo "<script>alert('edition reussie');</script>";
				  
		}

		if(isset($_POST['newsexe']) AND !empty($_POST['newsexe']))
		{
				  $newsexe = htmlspecialchars($_POST['newsexe']);
				  $editsexe = $bdd->prepare("UPDATE menbre SET sexe = ? WHERE id = ?");
				  $editsexe->execute(array($newsexe,$_GET['edit']));
				  echo "<script>alert('edition reussie');</script>";
				  
		}

		if(isset($_POST['newsession']) AND !empty($_POST['newsession']))
		{
				  $newsession = htmlspecialchars($_POST['newsession']);
				  $editsession = $bdd->prepare("UPDATE menbre SET session = ? WHERE id = ?");
				  $editsession->execute(array($newsession,$_GET['edit']));
				  echo "<script>alert('edition reussie');</script>";
				  
		}


?>

	<div align="center">
<form method="post"  action="">
			<?php if (isset($_GET['edit'])) { ?>
			<?php  $requ = $bdd->prepare("SELECT * FROM menbre WHERE id = ? ");
			$requ->execute(array($_GET['edit']));
			$m = $requ->fetch();
			  ?>
				<h6 class="alert-warning">edition de : <?= $m['pseudo']?></h6><label><b>matricule:</b> <?=$m['matricule']?></label>
			<?php  } ?><br><br>
		<p align="center">--Specialite--
			 <select class="form-control" required="required" name="matiere" style="width: 50%;">			
			 	<?php while ($mat = $mati->fetch()) { ?>
			<option><?= $mat['matiere'];?></option>
			<?php } ?>
		</select></p>	

       <label>date de naissance: </label><input style="width: 50%;" type="date" name="newdate" placeholder="date de naissance.." class="form-control"><br>

       <label>nom: </label><input style="width: 50%;" type="name" name="newfirst" placeholder="nom.." class="form-control"><br>

       <label>prenom: </label><input style="width: 50%;" type="name" name="newlast" placeholder="prenom.." class="form-control"><br>

       <label>sexe: </label><select style="width: 50%;" class="form-control" name="newsexe"> <option>M</option><option>F</option></select><br>

		<p>--SESSION--<i class="alert-warning" style="color: red">attention a ce champs?</i> <select style="width: 50%;" class="form-control" required="required" name="newsession">
		<option>SEPTEMBRE</span></option>
		<option>JANVIER</option>
		<option>AVRIL</option>
		<option>JUIN</option>
		<option>DECEMBRE</option>
	</select></p>	
	<button name="valider" style="width: 50%;" type="submit" class="form-control btn-sm btn-info">modifier</button><br><br><hr>
</form>

</div>

<?php 

	}
		if (isset($_GET['confirm']) AND !empty($_GET['confirm'])) {
			$confirm = (int) $_GET['confirm'];
			$req = $bdd->prepare("UPDATE menbre SET confirm = 1 WHERE id = ?");
			$req->execute(array($confirm));
			echo "<p class = \"container alert alert-info\">confirmation reussie</p>";
		}

		if (isset($_GET['supprime']) AND !empty($_GET['supprime'])) {
			$supprime = (int) $_GET['supprime'];
			$req = $bdd->prepare("DELETE FROM menbre WHERE id = ?");
			$req->execute(array($supprime));
			echo "<p class = \"container alert alert-danger\">suppresion reussie</p>";
		}

		if (isset($_GET['info']) AND !empty($_GET['info'])) {
			$info = (int) $_GET['info'];
			$req = $bdd->prepare("SELECT * FROM menbre WHERE id = ?");
			$req->execute(array($info));
			$i = $req->fetch();
			echo "<center><p class = \"container alert alert-info\">profil de <font color=\"red\"><b>".$i['pseudo']."</b></font></p></center>";
			echo "<p class = \"container alert alert-info\">matricule: <font color=\"red\"><b>".$i['matricule']."</b></font></p>";
			echo "<p class = \"container alert alert-info\">filiere: <font color=\"red\"><b>".$i['specialite']."</b></font></p>";
			echo "<p class = \"container alert alert-info\">nom: <font color=\"red\"><b>".$i['first']."</b></font></p>";
			echo "<p class = \"container alert alert-info\">prenom: <font color=\"red\"><b>".$i['last']."</b></font></p>";
			echo "<p class = \"container alert alert-info\">age: <font color=\"red\"><b>".$i['age']."</b></font></p>";
			echo "<p class = \"container alert alert-info\">addresse mail: <font color=\"red\"><b>".$i['email']."</b></font></p>";
			echo "<p class = \"container alert alert-info\">lieu: <font color=\"red\"><b>".$i['lieu']."</b></font></p>";
			echo "<p class = \"container alert alert-info\">diplome: <font color=\"red\"><b>".$i['niveau']."</b></font></p>";
		}


		if(isset($_GET['e'])){
			
			echo $_GET['e'];
			//$mt = $bdd->prepare("SELECT * FROM matiere WHERE id = ?");
			//$mt->execute(array($matid));
		}

		$mati  =$bdd->query("SELECT * FROM matiere");
		$menbre = $bdd->query("SELECT * FROM menbre ORDER BY id DESC LIMIT 10");
		$n = 0;
		 ?>

		<header>
			
			<div align="center" class="container"><h1 style="color: #eee093; background: rgba(255,0,0);">PANNEL  ADMINISTRATION</h1></div><br>
			<a class="btn-sm btn-warning" href="administration.php?id=<?=$_SESSION['id']?>">&nbsp;Retour</a>
			<a href="deconnexion.php" class="btn-sm btn-info" style="margin-left: 1200px;">deconnexion</a><br><br>
		</header>
			
					<div class="container">						
		<br>
						<form action="" method="post">
				<div class="row">
					<?php while($mat = $mati->fetch()) {  ?>
					<?php 
					$n+=1;
					 ?>
					<div class="col-xs-6 col-sm-3 col-md-3">
						<div class="align-center txt-shadow">
							<div class="icon">
								<a href="speci.php?e=<?=$mat['id']?>" style="margin:5px;padding-left:90px;"  class="btn btn-primary fa fa-book fa-5x"><?=$n?></a>
							</div>
							<p style="font-size: 19px; text-transform: uppercase; "><b><?= $mat['matiere']?></b></p>
						</div>
					</div>
					<?php } ?>

					<div class="col-xs-6 col-sm-3 col-md-3">
						<div class="align-center txt-shadow">
							<div class="icon">
								<a href="liste.php" style=" background: black; padding-right:90px;padding-left:90px;"  class="btn btn-primary fa fa-table fa-5x"></a>
							</div>
							<p style="font-size: 19px; text-transform: uppercase;"><b> LISTE TOTAL</b></p>
						</div>
					</div>

						<div class="col-xs-6 col-sm-3 col-md-3">
						<div class="align-center txt-shadow">
							<div class="icon">
								<a href="session.php"  style=" background: black; padding-right:90px;padding-left:90px;"  class="btn btn-primary fa fa-list fa-5x"></a>
							</div>
							<p style="font-size: 19px; text-transform: uppercase;"><b>LISTE PAR SESSION</b>	</p>
						</div>
					</div>

					<div class="col-xs-6 col-sm-3 col-md-3">
						<div class="align-center txt-shadow">
							<div class="icon">
								<a href="matiere.php?id=<?=$_SESSION['id']?>" style=" padding-right:90px;padding-left:90px; background: black;"  class="btn btn-primary fa fa-heart fa-5x"></a>
							</div>
							<p style="font-size: 19px; text-transform: uppercase;"><b>AJOUTER UNE MATIERE</b></p>
						</div>
					</div>
				</div>
				</form>
			</div>
		</section>


		<div class="container">
			<br>
			<fieldset>
			<h6>LISTE DES 10 DERNIERS ELEVES INSCRITS</h6>
			<div class="row">
				
					<?php while($m = $menbre->fetch()) { ?>
					<table class="table" border="1">
						
						
					<tr><td>id</td><td>pseudo</td><td>matricule</td><td>action</td></tr>
					<tr><td><b><?= $m['id'] ?></b></td>
					<td><b><?= $m['pseudo'] ?></b></td>
					<td><b> <?= $m['matricule']?>- </b></td>
					<td><a class="btn-sm btn-info" href="administration.php?info=<?= $m['id'] ?>">info</a></td>
					<td><a href="administration.php?edit=<?=$m['id']?>" class="btn-sm btn-primary">editer</a></td>
					<td><a class="btn-sm btn-danger" href="administration.php?supprime=<?= $m['id'] ?>">&times</a></td>
					<td><?php if($m['confirm'] == 0) {  ?> <a class="btn-sm btn-primary" href="administration.php?confirm=<?= $m['id'] ?>">confirme</a> <?php } ?></td>
				</tr>
					
					
				</table>
					<?php } ?>
					
			</div>
		</div>
		</fieldset>
		</body>
		</html>

<?php }
else{
	header('Location:util.php');
}

?>