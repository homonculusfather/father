<?php 
session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_menbre;charset=utf8','root','');
if (isset($_SESSION['id'])) 
  {
    $mati = $bdd->query("SELECT * FROM matiere");
$requser = $bdd->prepare("SELECT * FROM menbre WHERE id = ?");
$requser->execute(array($_SESSION['id']));
$user = $requser->fetch();
$_SESSION['id'] = $user['id'];



if(isset($_FILES['newphoto']['name']) AND !empty($_FILES['newphoto']['name']) AND $_FILES['newphoto']['name'] != $user['photo'])
{
  $newphoto = htmlspecialchars($_FILES['newphoto']['name']);
  $file_tmp_name = $_FILES['newphoto']['tmp_name'];
  echo "modification en cours..veuillez patienter";
  $photo_verify =  move_uploaded_file($file_tmp_name,"./photo/$newphoto");

  if($photo_verify == 1){ 
  $insertphoto = $bdd->prepare("SELECT * FROM menbre WHERE id = ?");
  $insertphoto->execute(array($_SESSION['id']));

  $editphoto = $bdd->prepare("UPDATE menbre SET photo = ? WHERE id = ?");
  $editphoto->execute(array($newphoto,$_SESSION['id']));
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


if(isset($_POST['newsession']) AND !empty($_POST['newsession']) AND $_POST['newsession'] != $user['session'])
{
  $newsession = htmlspecialchars($_POST['newsession']);
  $insertsession = $bdd->prepare("SELECT * FROM menbre WHERE id = ?");
  $insertsession->execute(array($_SESSION['id']));
  
  
  $editsession = $bdd->prepare("UPDATE menbre SET session = ? WHERE id = ?");
  $editsession->execute(array($newsession,$_SESSION['id']));
  $user = $editsession->fetch();
  header('Location:profil.php?id='.$_SESSION['id']);
}


if(isset($_POST['newmatiere']) AND !empty($_POST['newmatiere']) AND $_POST['newmatiere'] != $user['specialite'])
{
  $newmatiere = htmlspecialchars($_POST['newmatiere']);
  $insertmatiere = $bdd->prepare("SELECT * FROM menbre WHERE id = ?");
  $insertmatiere->execute(array($_SESSION['id']));
  
  
  $editmatiere = $bdd->prepare("UPDATE menbre SET specialite = ? WHERE id = ?");
  $editmatiere->execute(array($newmatiere,$_SESSION['id']));
  $user = $editmatiere->fetch();
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
      letter-spacing: 3px;
      text-transform: uppercase;
    }
  </style>
</head>
<body style="background: #eee;">



  <header class="header">
  <h2 class=" container alert-sm alert-info" style="border: 2px solid rgba(0,0,0);">EDITER MON PROFIL &copy<br></h2>
  <br><b><p align="center" class="container alert-sm alert-info" style="letter-spacing: 4px;text-transform: uppercase; font-size: 20px;" >et. <?php echo "<font color=\"#000\">".$user['pseudo']."</font>"; ?></p></b>
  </header>

  <div class=" container alert-sm">
     <a class="btn-sm btn-danger" href="profil.php?id=<?=$_SESSION['id']?>">&nbsp;retour</a>
     <a style="text-align: left;" class="btn-sm btn-danger" href="deconnexion.php">deconnexion</a>
     <br><br><br>

    <?php if(isset($erreur))
    {
      echo "<p class=\" alert alert-danger\"><font color=\"red\">".$erreur."</font></p>";
    }

     ?> </div><br><br>
     <form class="container alert alert-info" action="" method="post" enctype="multipart/form-data">

    <label>Photo de profil: </label><input style="width: 50%;" type="file" name="newphoto"  class="form-control"><br>

    <label>mail: </label><input style="width: 50%;" type="email" name="newmail" placeholder="Mail.." class="form-control"><br>

      <label>age: </label><input style="width: 50%;" type="number" name="newage" placeholder="age.." class="form-control"><br>

      <label>session <b><i style="letter-spacing: 0; text-transform: none; color: red;">(attention verifier bien s'il s'agit de votre session ici)</i></b>  <select class="form-control" required="required" name="newsession">
        <option>NONE</option>
      <option>SEPTEMBRE</span></option>
      <option>JANVIER</option>
      <option>AVRIL</option>
      <option>JUIN</option>
      <option>DECEMBRE</option>
      </select></label><br> <br>


      <p align="left">--Specialite--
       <select class="form-control" required="required" name="newmatiere" style="width: 50%;">     
        <?php while ($mat = $mati->fetch()) {  ?>
      <option><?= $mat['matiere'];?></option>
      <?php } ?>
    </select></p> 
 

        <label>date de naissance: </label><input style="width: 50%;" type="date" name="newdate" placeholder="date de naissance.." class="form-control"><br>

            <label>nom: </label><input style="width: 50%;" type="name" name="newfirst" placeholder="nom.." class="form-control"><br>

              <label>prenom: </label><input style="width: 50%;" type="name" name="newlast" placeholder="prenom.." class="form-control"><br>

                <label>sexe: </label><select style="width: 50%;" class="form-control" name="newsexe"> <option>M</option><option>F</option></select><br>

          <label >mot de passe: </label><input style="width: 50%;" type="password" name="newmdp" placeholder="mot de passe.." class="form-control"><br>

          <label>mot de passe: </label><input style="width: 50%;" type="password" name="newmdp2" placeholder="Confirmation mot de passe.." class="form-control"><br>

          <button style="width: 50%;" type="submit" name="valid" class="form-control btn btn-info"><u>Modifier</u></button>
  </form>

<h6 style="font-family: berlin sans fb; color: white; font-size: 15px;" class="info"><span><i><u> Si vous souhaitez modifier un champs ..  modifier le champs ensuite valider</u></i></span></h6>


</body>
</html>

<?php }
else{
  header('Location:connexion.php');
}
 ?>
