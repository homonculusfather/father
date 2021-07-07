
<!DOCTYPE html>
<html>
<head>
	<title>User_admin</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>




<?php 
session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_menbre;charset=utf8','root','');
if(isset($_POST['valid']))
{
	if(isset($_POST['nom'],$_POST['pass']) AND !empty($_POST['nom']) AND !empty($_POST['pass']))
	{
		$nom = htmlspecialchars($_POST['nom']);
		$pass = htmlspecialchars($_POST['pass']);
		$req = $bdd->prepare("SELECT * FROM site_users WHERE user_name = ?");
		$req->execute(array($nom));
		$exist = $req->rowCount();
		$user = $req->fetch();
		
		if(password_verify($pass,$user['user_password'])==1){ 
		$_SESSION['id'] = $user['id'];
		$_SESSION['user_name'] = $user['user_name'];
		$_SESSION['user_admin'] = $user['user_admin'];



	}else{
		echo "Identifiants Incorrectes";
	}
	}
	else{
		echo "tous les champs doivent etre rempli";
	}
}

 ?>








<body style="background: #eee;">
	<div class="container"><br>
		<?php if(isset($pass) AND password_verify($pass,$user['user_password'])==1){  ?>
		<a class="form-control btn-sm btn-success" href="administration.php?id=<?= $_SESSION['id']?>"><b>Rejoignez la legion </a>
		<?php } ?>
	</div><br><br><br>
	<div class="container ">
	<?php 
if(isset($erreur))
{
	echo "<p align='center' class=\" alert alert-danger\"><font color='red'><b>".$erreur."</b></font></p>";
}


	?></div><br>
	<div align="center" class="container alert-lg alert-info">
		<h1><b> ADMIN</b></h1>
	</div><br>
<div class="container" align="center">
	<form style="width: 700px;" class="alert alert-info form-group" method="post" action="">
		<p align="left"><b>--pseudo--</b> 	
			<input type="text" name="nom" placeholder="Identifiant" class="form-control">
		</p>

		<p align="left"><b> --Mot de passe--</b><span style="color: #989;">(6 caracteres min.)</span>
			<input type="password" name="pass" placeholder="Mot de passe" class="form-control">
		</p>
		<button name="valid" type="submit" class="btn btn-danger form-control"><b>connexion </b></button>
	</form>
	<!--a href="matricule.php">matricule</a-->
</div>
</body>
</html>