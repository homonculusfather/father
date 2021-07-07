<?php 
$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_menbre','root','');
if (isset($_POST['valid'])) {
	if(!empty($_POST['pseudo']) AND isset($_POST['pseudo'])){
		$pseudo = htmlspecialchars($_POST['pseudo']);
		$req = $bdd->prepare("SELECT * FROM essai WHERE pseudo = ?");
		$req->execute(array($pseudo));
		$exist = $req->rowCount();
		if ($exist == 1) {
			$user = $req->fetch();
		}
		else{
			$erreur = "identifiant incorrects";
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
 <body style="background: tomato;"><br><br>
 	<div class="container">
 		<?php 
 		if(isset($erreur)){
 			echo "<p class=\"alert alert-info\">".$erreur."</p>";
 		}

 		 ?>
 	</div>
 <div class="container">
 	<form class="alert alert-warning" action="" method="post">
 		<p align="center">pseudo:<input type="name" name="pseudo" class="form-control"></p>
 		<button type="submit" name="valid" class="form-control alert alert-info">connexion</button>
 	</form>
 </div>
<?php if($exist == 1) { ?>
<p class="alert alert-info"><?php echo $user['pseudo']; ?></p>
<a  href="essai/<?php echo $user['fic'];?>"><?php echo $user['fic']; ?></a>
<p class="alert alert-info"><?php echo $user['date_pu']; ?></p>
<?php } ?>
 </body>
 </html>