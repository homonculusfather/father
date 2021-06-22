<?php 
session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_menbre;charset=utf8','root','');
if (isset($_SESSION['id'])) 
  {
 
$requser = $bdd->prepare("SELECT * FROM menbre WHERE id = ?");
$requser->execute(array($_SESSION['id']));
$user = $requser->fetch();

if(isset($_POST['newpseudo']) AND !empty($_POST['newpseudo']) AND $_POST['newpseudo'] != $user['pseudo'])
{
  $newpseudo = htmlspecialchars($_POST['newpseudo']);
  $insertpseudo = $bdd->prepare("SELECT * FROM menbre WHERE id = ?");
  $insertpseudo->execute(array($_SESSION['id']));

  $pseudo = $bdd->prepare("SELECT * FROM menbre WHERE pseudo = ?");
  $pseudo->execute(array($newpseudo));
  $pseudoexist = $pseudo->rowCount();

  if($pseudoexist == 0){ 
  $editpseudo = $bdd->prepare("UPDATE menbre SET pseudo = ? WHERE id = ?");
  $editpseudo->execute(array($newpseudo,$_SESSION['id']));
  $user = $editpseudo->fetch();
  header('Location:profil.php?id='.$_SESSION['id']);
}else{
  $erreur = "oups ce pseudo existe deja";
}
}

if(isset($_FILES['newphoto']['name']) AND !empty($_FILES['newphoto']['name']) AND $_FILES['newphoto']['name'] != $user['photo'])
{
  $newphoto = htmlspecialchars($_FILES['newphoto']['name']);
  $file_tmp_name = $_FILES['newphoto']['tmp_name'];
  $photo_verify =  move_uploaded_file($file_tmp_name,"./photo/$newphoto");
  
  if($photo_verify == 1){ 
  $insertphoto = $bdd->prepare("SELECT * FROM menbre WHERE id = ?");
  $insertphoto->execute(array($_SESSION['id']));

  $editphoto = $bdd->prepare("UPDATE menbre SET photo = ? WHERE id = ?");
  $editphoto->execute(array($newphoto,$_SESSION['id']));
  $user = $editphoto->fetch();
  header('Location:profil.php?id='.$_SESSION['id']);
}else{
  $erreur = "oups une erreur s'est produite o_O ";
}
}


if(isset($_POST['newmail']) AND !empty($_POST['newmail']) AND $_POST['newmail'] != $user['email'])
{
  $newmail = htmlspecialchars($_POST['newmail']);
  $insertmail = $bdd->prepare("SELECT * FROM menbre WHERE id = ?");
  $insertmail->execute(array($_SESSION['id']));
  $mail = $bdd->prepare("SELECT * FROM menbre WHERE email = ?");
  $mail->execute(array($newmail));
  $mailexist = $mail->rowCount();

  if($mailexist == 0){ 
  $editmail = $bdd->prepare("UPDATE menbre SET email = ? WHERE id = ?");
  $editmail->execute(array($newmail,$_SESSION['id']));
  $user = $editmail->fetch();
  header('Location:profil.php?id='.$_SESSION['id']);
}else{
  $erreur = "cet addresse email existe deja";
}
}


if(isset($_POST['newage']) AND !empty($_POST['newage']) AND $_POST['newage'] != $user['age'])
{
  $newage = htmlspecialchars($_POST['newage']);
  $insertage = $bdd->prepare("SELECT * FROM menbre WHERE id = ?");
  $insertage->execute(array($_SESSION['id']));
  
  
  $editage = $bdd->prepare("UPDATE menbre SET age = ? WHERE id = ?");
  $editage->execute(array($newage,$_SESSION['id']));
  $user = $editage->fetch();
  header('Location:profil.php?id='.$_SESSION['id']);
}


if(isset($_POST['newdate']) AND !empty($_POST['newdate']) AND $_POST['newdate'] != $user['date'])
{
  $newdate = htmlspecialchars($_POST['newdate']);
  $insertdate = $bdd->prepare("SELECT * FROM menbre WHERE id = ?");
  $insertdate->execute(array($_SESSION['id']));
  
  
  $editdate = $bdd->prepare("UPDATE menbre SET naissance = ? WHERE id = ?");
  $editdate->execute(array($newdate,$_SESSION['id']));
  $user = $editdate->fetch();
  header('Location:profil.php?id='.$_SESSION['id']);
}



if(isset($_POST['newfirst']) AND !empty($_POST['newfirst']) AND $_POST['newfirst'] != $user['first'])
{
  $newfirst = htmlspecialchars($_POST['newfirst']);
  $insertfirst = $bdd->prepare("SELECT * FROM menbre WHERE id = ?");
  $insertfirst->execute(array($_SESSION['id']));
  
  
  $editfirst = $bdd->prepare("UPDATE menbre SET first = ? WHERE id = ?");
  $editfirst->execute(array($newfirst,$_SESSION['id']));
  $user = $editfirst->fetch();
  header('Location:profil.php?id='.$_SESSION['id']);
}

if(isset($_POST['newlast']) AND !empty($_POST['newlast']) AND $_POST['newlast'] != $user['last'])
{
  $newlast = htmlspecialchars($_POST['newlast']);
  $insertlast = $bdd->prepare("SELECT * FROM menbre WHERE id = ?");
  $insertlast->execute(array($_SESSION['id']));
  
  
  $editlast = $bdd->prepare("UPDATE menbre SET last = ? WHERE id = ?");
  $editlast->execute(array($newlast,$_SESSION['id']));
  $user = $editlast->fetch();
  header('Location:profil.php?id='.$_SESSION['id']);
}



if(isset($_POST['newsexe']) AND !empty($_POST['newsexe']) AND $_POST['newsexe'] != $user['sexe'])
{
  $newsexe = htmlspecialchars($_POST['newsexe']);
  $insertsexe = $bdd->prepare("SELECT * FROM menbre WHERE id = ?");
  $insertsexe->execute(array($_SESSION['id']));
  
  
  $editsexe = $bdd->prepare("UPDATE menbre SET sexe = ? WHERE id = ?");
  $editsexe->execute(array($newsexe,$_SESSION['id']));
  $user = $editsexe->fetch();
  header('Location:profil.php?id='.$_SESSION['id']);
}


  if(isset($_POST['newmdp']) AND !empty($_POST['newmdp']) AND $_POST['newmdp'] != $user['password'])
{
 
  $insertsexe = $bdd->prepare("SELECT * FROM menbre WHERE id = ?");
  $insertsexe->execute(array($_SESSION['id']));
  
  
  $newmdp = htmlspecialchars($_POST['newmdp']);
$newmdp2 = htmlspecialchars($_POST['newmdp2']);

if($newmdp == $newmdp2)
{
  $newmdp = sha1($newmdp);
  $editmdp = $bdd->prepare("UPDATE menbre SET password = ? WHERE id = ?");
  $editmdp->execute(array($newmdp,$_SESSION['id']));
  $user = $editmdp->fetch();
  header('Location:profil.php?id='.$_SESSION['id']);
  }
else{
  $erreur = "Vos mots de passe ne correspondent pas";
}

}




 ?>


<!DOCTYPE html>
<html>
<head>
  
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <title>Profil</title>
  <meta charset="utf-8">
  <style type="text/css">
    label{
      color: #000;
    }
  </style>
</head>
<body style="color:#eee;">
  <form action="" method="post">
      <button style=" text-align: left;" type="submit" class="btn-sm btn-info" name="envoi">Retour</button>
    </form><br>
  <header class="header">
  <u><h2 class="alert alert-info" style="font-family: berlin sans fb;">Editer MOn PRofil <br></h2></u>
  <p align="center" class="alert alert-warning" >et. <?php echo "<font color=\"#000\">".$user['pseudo']."</font>"; ?></p>
<div class="alert" align="center">
    <?php 
    if(isset($_POST['envoi']))
    {
      header('Location:profil.php?id='.$_SESSION['id']);   
    }
    ?>
  </header>
  <div class="alert-xs">
    <?php if(isset($erreur))
    {
      echo "<p class=\" alert alert-danger\"><font color=\"red\">".$erreur."</font></p>";
    }


     ?> </div><br><br>
  <form class="form-group" method="post" action="" enctype="multipart/form-data">
    <label>pseudo: </label><input style="width: 50%;" type="name" name="newpseudo" placeholder="Pseudo.." class="form-control"><br>

    <label>Photo de profil: </label><input style="width: 50%;" type="file" name="newphoto"  class="form-control"><br>

    <label>mail: </label><input style="width: 50%;" type="email" name="newmail" placeholder="Mail.." class="form-control"><br>

      <label>age: </label><input style="width: 50%;" type="number" name="newage" placeholder="age.." class="form-control"><br>

        <label>date de naissance: </label><input style="width: 50%;" type="date" name="newdate" placeholder="date de naissance.." class="form-control"><br>

            <label>nom: </label><input style="width: 50%;" type="name" name="newfirst" placeholder="nom.." class="form-control"><br>

              <label>prenom: </label><input style="width: 50%;" type="name" name="newlast" placeholder="prenom.." class="form-control"><br>

                <label>sexe: </label><select style="width: 50%;" class="form-control"> <option>M</option><option>F</option></select><br>

          <label >mot de passe: </label><input style="width: 50%;" type="password" name="newmdp" placeholder="mot de passe.." class="form-control"><br>

          <label>mot de passe: </label><input style="width: 50%;" type="password" name="newmdp2" placeholder="Confirmation mot de passe.." class="form-control"><br>

          <button style="width: 50%;" type="submit" name="valid" class="form-control alert alert-info"><u>Modifier</u></button>
  </form>
</div>
<h6 style="font-family: berlin sans fb; color: white; font-size: 15px;" class="info"><span><i><u> Si vous souhaitez modifier un champs ..  modifier le champs ensuite valider</u></i></span></h6>
</body>
</html>

<?php }
else{
  header('Location:connexion.php');
}
 ?>
