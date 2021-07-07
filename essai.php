<?php 
$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_menbre','root','');
if(isset($_POST['valid'])){
	if(isset($_POST['pseudo'],$_FILES['fic']) AND !empty($_POST['pseudo']) AND !empty($_FILES['fic']))
	{
		$pseudo = htmlspecialchars($_POST['pseudo']);
		$fic = htmlspecialchars($_FILES['fic']['name']);
		$file_tmp_name = $_FILES['fic']['tmp_name'];
		$fic_verify =  move_uploaded_file($file_tmp_name,"./essai/$fic");
		$req = $bdd->prepare("SELECT * FROM essai WHERE pseudo = ?");
		$req->execute(array($pseudo));
		$exist = $req->rowCount();
		if($exist == 0){
			$insert = $bdd->prepare("INSERT INTO essai(pseudo,fic,date_pu) VALUES(?,?,NOW())");
			$insert->execute(array($pseudo,$fic));
			echo "insertion reussie";
		}
		else{
			$erreur = "ce pseudo existe deja";
		}
	}
	else{
		$erreur = "tous les champs doivent etre rempli";
	}
}



 ?>




<!DOCTYPE html>
<html>
<head>
	<title>essai</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body style="background: tomato;"><br><br><br>

<div class="container">
	<?php
	if (isset($erreur)) {
	 	echo "<p class=\"alert alert-danger\">".$erreur."</p>";
	 } 
	
	?>
</div>

<div class="container">
	<form class="container alert alert-warning" method="post" action="" enctype="multipart/form-data">
		<label>Pseudo:</label> <input type="name" name="pseudo" placeholder="pseudo" class="form-control"><br>
		<label>fichier:</label> <input type="file" name="fic" placeholder="fichier" class="form-control" accept="image/*,.pdf,.doc"><br>
		<button type="submit" name="valid" class="btn btn-info form-control">Envoyer</button>
	</form>
</div>
</body>
</html>