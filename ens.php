<?php 
$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_menbre;charset=utf8','root','');
if(isset($_POST['valid']))
{
		$mail = htmlspecialchars($_POST['mail']);
		$first = htmlspecialchars($_POST['first']);
		$last = htmlspecialchars($_POST['last']);
		$pseudo = htmlspecialchars($_POST['pseudo']);
		$session = htmlspecialchars($_POST['session']);
		$mdp = htmlspecialchars($_POST['mdp']);
		$matiere = htmlspecialchars($_POST['matiere']);
		$mdp2 = htmlspecialchars($_POST['mdp2']);
		$autre = htmlspecialchars($_POST['autre']);
		
	if(isset($_POST['mail'],$_POST['pseudo'],$_POST['first'],$_POST['last'],$_POST['matiere'],$_POST['mdp'],$_POST['mdp2'],$_POST['autre']) AND !empty($_POST['mail']) AND !empty($_POST['pseudo']) AND !empty($_POST['first']) AND !empty($_POST['last']) AND !empty($_POST['matiere']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2']))
	{
		if(filter_var($mail,FILTER_VALIDATE_EMAIL))
		{

			$valid_mail = $bdd->prepare("SELECT * FROM enseignant WHERE email = ?");
			$valid_mail->execute(array($mail));
			$verify = $valid_mail->rowCount();
			if($verify == 0){ 
				if($mdp == $mdp2){ 
					$l = strlen($pseudo);
					$m = strlen($mdp);
					if($l >= 4)
					{
						if($m >= 6)
						{
							$hash = password_hash($mdp,PASSWORD_BCRYPT,['cost'=>11]);
							$req = $bdd->prepare("SELECT * FROM enseignant WHERE pseudo = ?");
							$req->execute(array($pseudo));
							$exist = $req->rowCount();
							if($exist == 0)
							{	
								$insert = $bdd->prepare("INSERT INTO enseignant(pseudo,first,last,email,filiere,autre,password,session,date_en) VALUES(?,?,?,?,?,?,?,?,NOW())");
								$insert->execute(array($pseudo,$first,$last,$mail,$matiere,$autre,$hash,$session));
								echo "<p align=\"center\" class=\"alert alert-success\"><b><font color='green'>INSCRIPTION REUSSIE</font></b></p>";
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
		}
			else{
				$erreur = "vos mots de passe ne correspondent pas";
		}
	}
	else{
		$erreur  = "oups cette addresse mail existe deja";
	}

	}
		else{
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
	<title>User_learn</title>
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
		<p align="left"><b>--MAIL--</b> 	
			<input type="email" name="mail" placeholder="mail.." class="form-control">
		</p>

		<p align="left"><b>--PSEUDO--</b> 	
			<input type="text" name="pseudo" placeholder="Identifiant" class="form-control">
		</p>

		<p align="left"><b>--NOM--</b> 	
			<input type="text" name="first" placeholder="Identifiant" class="form-control">
		</p>

		<p align="left"><b>--PRENOM--</b> 	
			<input type="text" name="last" placeholder="Identifiant" class="form-control">
		</p>
		
		<p align="left"><b>--FILIERE D'ENSEIGNEMENT--</b> <select class="form-control" required="required" name="matiere">
			<option>Infographie <span style="color: #777"> (BAC min.)</span></option>
			<option>Webmaster<span style="color: #777"> (BAC SCI min.)</span></option>
			<option>montage audiovisuel<span style="color: red"> (BAC min.)</span></option>
			<option>realisation TV<span style="color: #777"> (PROB min.)</span></option>
			<option>Secretariat <span style="color: #777">(PROB min.)</span></option>
			<option>Beaute<span style="color: #777"> (BEPC min.)</span></option>
			<option>gestion<span style="color: #777"> (BAC min.)</span></option>
			<option>reseaux<span style="color: #777"> (BAC SCI min.)</span></option>
		</select></p>


		<p align="left">--SESSION-- <select class="form-control" required="required" name="session">
			<option>SEPTEMBRE</span></option>
			<option>JANVIER</option>
			<option>AVRIL</option>
			<option>JUIN</option>
			<option>DECEMBRE</option>
		</select></p>	

		<p align="left"><b> --MOT DE PASSE--</b><span style="color: #989;">(6 caracteres min.)</span>
			<input type="password" name="mdp" placeholder="Mot de passe" class="form-control">
		</p>

		<p align="left"><b> --CONFIRMATION DE MOT DE PASSE--</b><span style="color: #989;">(6 caracteres min.)</span>
			<input type="password" name="mdp2" placeholder="confirmation mot de passe" class="form-control">
		</p>

		<p align="left"><b>--AUTRE INFORMATION--</b><textarea placeholder="autre information" class="form-control" name="autre"></textarea></p><br>
		<button name="valid" type="submit" class="btn btn-danger form-control"><b>CONNEXION </b></button><br>
		<p><input type="checkbox" required="required"> acceptez-vous les accords et termes de conditions d'utilisations</p>
	</form><br>
	<table>
	<tr>
<td>etes-vous enseignant ?<a href="ens.php"> oui</a><a href="connexion.php">non</a></td>
</tr>
<tr>
<td>etes-vous apprenant ?<a href="connexion.php"> oui</a><a href=""> non</a></td>
</tr>
</table>
</div>
</body>
</html>