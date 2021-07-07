<?php 
session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_menbre;charset=utf8','root','');
if(isset($_POST['form_connexion']))
{
  if(!empty($_POST['mailconnect']) AND !empty($_POST['mdpconnect']))
  {
    $mailconnect = htmlspecialchars($_POST['mailconnect']);
    $mdpconnect = sha1($_POST['mdpconnect']);
    $requser = $bdd->prepare("SELECT * FROM menbre WHERE email = ? AND password = ?");
    $requser->execute(array($mailconnect,$mdpconnect));
    $userexist = $requser->rowCount();
    if( $userexist == 1)
    {
      $userinfo = $requser->fetch();
      $_SESSION['confirm'] = $userinfo['confirm'];
      if($userinfo['confirm'] == 1)
        {
      $_SESSION['cle'] = $userinfo['cle'];
      $_SESSION['id'] = $userinfo['id'];
      $_SESSION['first'] = $userinfo['first'];
      $_SESSION['last'] = $userinfo['last'];
      $_SESSION['niveau'] = $userinfo['niveau'];
      $_SESSION['photo'] = $userinfo['photo'];
      $_SESSION['email'] = $userinfo['email'];
      $_SESSION['pseudo'] = $userinfo['pseudo'];
      $_SESSION['specialite'] = $userinfo['specialite'];
      $_SESSION['age'] = $userinfo['age'];
      $_SESSION['naissance'] = $userinfo['naissance'];
      $_SESSION['lieu'] = $userinfo['lieu'];
      $_SESSION['date'] = $userinfo['date'];
      $_SESSION['note'] = $userinfo['note'];
      $_SESSION['matricule'] = $userinfo['matricule'];
      $_SESSION['paiement'] = $userinfo['paiement'];
      $_SESSION['absence'] = $userinfo['absence'];
      $_SESSION['admin'] = $userinfo['admin'];
      $_SESSION['session'] = $userinfo['session'];
      $_SESSION['confirm'] = $userinfo['confirm'];
      header('Location:profil.php?id='.$_SESSION['id']);
      }else{
        $erreur = "votre compte n'as pas encore ete confirme verifier vos mails";

      }
    }
    else{
      $erreur = "Identifiants Incorrectes :( <a href=\"menbre.php\"> inscription</a>";
    }
  }
  else{
    $erreur = "tous les champs doivent etres rempli";
      header('Location:connexion.php');    
  }
}


 ?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <title>Connexion</title>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  
</head>
<body style="/*background: linear-gradient(rgba(0,0,0,0.19),rgba(0,0,0,0.9))*/ background: #eee;" ><br> <br><br>
<div  style="text-transform: uppercase; font-size: 15px;" align="center" class="container text-uppercase">
  <h1 class="alert alert-link" >Connexion &copy</h1><br>

  <form class="alert alert-info" style="width: 900px;" action="" method="post">

  
    <p > Mail: <input type="email" name="mailconnect" class="form-control " style="width: 800px;" required="required"  placeholder=" Addresse mail.." required="required"></p>
  

    <p> Mot de Passe: <span style="color: #987; ">(6 caracteres min..)</span><input style="width: 800px"; type="password" name="mdpconnect" class="form-control " required="required" placeholder=" Mot de Passe.." required="required"></p>

<br>
    <button type="submit" name="form_connexion" class="form-control-feedback btn-lg btn-primary" style="width: 800px;">Connexion</button>
    </form>
    
</div>
<br>

<div class="alert">
<?php 

if(isset($erreur))
{
  echo "<hr><u><h6 class=\"error alert alert-danger\"  align=\"center\"><font color='red'>".$erreur."</font></h6></u>";
}

?><br><br>
</div>

<div class="alert">
<?php 

echo "<center><font color='black'>je ne suis pas inscris<a href=\"menbre.php\">   je m'inscris</a></font></center>";
 ?>
 </div>
</body>
</html>