<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<script type="text/javascript">
		function selected(){
			alert("vous avez clique sur un champs");
		}

		function envoi(){
			alert("formulaire envoye");
		}
	</script>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body><br><br>
<form class="container form-group" action="" method="post" onsubmit="return envoi();">
<p align="center">--NOM--
	<input type="text" class="form-control" name="" onfocus="//selected();">
</p><br>
<p align="center">--PRENOM--
	<input type="text" class="form-control" name="">
</p><br>
<p align="center">AD
	<input type="text" class="form-control" name="">
</p><br>
<button type="submit" class="form-control btn-sm btn-info">envoyer</button>	<br>
<button type="reset" onmouseover="alert('attention suppression');" class="form-control btn-sm btn-warning">reset</button>	
</form>
</body>
</html>