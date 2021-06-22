<?php 

$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_menbre;charset = utf8','root','');
$menbres = $bdd->query('SELECT * FROM menbres ORDER BY id DESC LIMIT 0,5');


 ?>




 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<title>ADMINISTRATION</title>
 </head>
 <body>
 <ul>
 	<?php while($m = $menbres->fetch()) {  ?>
 	<li><?= $m['id']?> - <?= $m['pseudo']?> <?php if($m['confirm']==0) { ?>- <a href="index.php?confirme =<?= $m['id'] ?> ">Confirmer</a><?php } ?> - <a href="index.php?supprime =<?= $m['id'] ?> ">Supprimer</a></li>
 	<?php } ?>
 </ul>


 </body>
 </html>