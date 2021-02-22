
<!-- 
Youri NOVIKOV p2002123
Lucas BRUSTOLIN p1805322  
-->

<html lang="fr">
<head>
	<title>MAP GENERATOR</title>
</head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script type="text/javascript" src="js/script.js"></script>
<body>

<?php
// index.php fait office de controleur frontal
session_start(); // démarre ou reprend une session
require('inc/constantes.php');
require('inc/includes.php'); // inclut le fichier avec fonctions (notamment celles du modele)
require('inc/routes.php'); // fichiers de routes

include('static/menu.php');
include('static/header.php');

include('static/stats.php');

if(isset($_GET['page'])) // Choix de la page
{
	$page = $_GET['page'];
	
	if(isset($routes[$page])) {
		$controller = $routes[$page]['controller'];
		$view = $routes[$page]['view'];
		include('controller/' . $controller . '.php');
		include('view/' . $view . '.php');
	}
	else {
		include('static/accueil.php');
	}
}
else {
	include('static/accueil.php');
}

include('static/footer.php');
?>
   

</body>
</html>