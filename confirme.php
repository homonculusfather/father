<?php 
$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_menbre','root','');
	if(isset($_GET['pseudo'], $_GET['key']) AND !empty($_GET['pseudo']) AND !empty($_GET['key'])){ 
		$pseudo = htmlspecialchars(urldecode($_GET['pseudo']));
		$key = htmlspecialchars($_GET['key'];)

$requser = $bdd->prepare("SELECT* FROM menbre WHERE pseudo=? AND cle = ?");
$requser->execute(array($pseudo,$key));
$userexist = $requser->rowCount();
if($userexist == 1){ 
	$user = $requser->fetch();
	if($user['confirme'] == 0){ 
		$update = $bdd->prepare("UPDATE menbre SET confirm = 1 WHERE pseudo = ? AND cle = ?");
		$update->execute(array($pseudo,$key));
		echo "votre compte a bien ete confirme";
		}else{
			echo "Votre compte a deja ete confirme";
		}
	}else{
		echo "l'utilisateur n'existe pas";
	}
}

 ?>