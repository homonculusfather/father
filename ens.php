<?php 
$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_menbre;charset=utf8','root','');
if(isset($_POST['valid']))
{
		$nom = htmlspecialchars($_POST['nom']);
		$pass = htmlspecialchars($_POST['pass']);
		$mail = htmlspecialchars($_POST['mail']);
	if(isset($_POST['nom'],$_POST['pass']) AND !empty($_POST['nom']) AND !empty($_POST['pass']))
	{
		if(filter_var($mail,FILTER_VALIDATE_EMAIL))
		{

			$l = strlen($nom);
			$m = strlen($pass);
			if($l >= 4)
			{
				if($m >= 6)
				{
					$hash = password_hash($pass,PASSWORD_BCRYPT,['cost'=>11]);
					$req = $bdd->prepare("SELECT * FROM site_users WHERE user_name = ?");
					$req->execute(array($nom));
					$exist = $req->rowCount();
					if($exist == 0)
					{	
						$insert = $bdd->prepare("INSERT INTO enseignant(email,pseudo,password) VALUES(?,?,?)");
						$insert->execute(array($nom,$hash));
						echo "<p class=\"alert alert-success\"><b><font color='green'>INSCRIPTION REUSSIE</font></b></p>";
					}	
					else{
						$erreur = "oups ce pseudo existe deja";
					}
				}
				else{
					$erreur = "mot de passe est trop court";
				}
			}
			else{
				$erreur = "Le nom d'utilisateur est trop court";
			}
		}else{
			$erreur = "veuillez inserer une addresse email valide";
		}
		}
	else{
		$erreur = "Tous les champs doivent etre rempli";
	}
}



 ?>



<!DOCTYPE html>
<html>
<head>
	<title>User_admin</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body style="background: #eee;">
	<div class="container ">
	<?php 
if(isset($erreur))
{
	echo "<p align='center' class=\" alert alert-danger\"><font color='red'><b>".$erreur."</b></font></p>";
}


	?></div><br><br><br><br>
	<div class="container alert-lg alert-danger" style="width: 40%;">
		<h1 align="center" style="letter-spacing: 4px; font-size: 25px;"><b>INSCRIPTION ENSEIGNANT</b></h1>
	</div>
<div class="container">
	<form class="alert alert-info form-group" style="margin:10px; display: block;" method="post" action="">
		<p align="left"><b>--mail--</b> 	
			<input type="email" name="mail" placeholder="mail.." class="form-control">
		</p>

		<p align="left"><b>--pseudo--</b> 	
			<input type="text" name="nom" placeholder="Identifiant" class="form-control">
		</p>

		<p align="left"><b> --Mot de passe--</b><span style="color: #989;">(6 caracteres min.)</span>
			<input type="password" name="pass" placeholder="Mot de passe" class="form-control">
		</p>
		<button name="valid" type="submit" class="btn btn-danger form-control"><b>connexion </b></button>
	</form><br>
	<ul>
<li>etes-vous enseignant ?<a href="ens.php"> oui</a><a href="connexion.php">  non</a></li>
<li>etes-vous apprenant ?<a href="connexion.php"> oui</a><a href=""> non</a></li>
</ul>
</div>
</body>
</html>