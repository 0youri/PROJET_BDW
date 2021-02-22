<?php 
	$connexion = getConnexionBD();
	mysqli_set_charset($connexion, "utf8");

	// Récuperation de données de BDD
	$requete = "SELECT idContributrice, nom, prenom FROM Contributrice";
	$data_Contributrice = mysqli_query($connexion, $requete);
	if($data_Contributrice == FALSE) {
		echo "Aucune contributrice n'a été trouvée dans la base de données !";
	}

	$requete = "SELECT idCarte, idContributrice, type FROM CONTRIBUE";
	$data_CONTRIBUE = mysqli_query($connexion, $requete);
	if($data_CONTRIBUE == FALSE) {
		echo "Aucune contribution n'a été trouvée dans la base de données !";
	}

	$requete = "SELECT count(idEtre) FROM Etre";
	$nb_Etre = mysqli_query($connexion, $requete);
	if($nb_Etre == FALSE) {
		echo "Aucune etre n'a été trouvée dans la base de données !";
	}

		$requete = "SELECT count(idEtre_1_1) FROM Creature";
		$nb_Creature = mysqli_query($connexion, $requete);
		if($nb_Creature == FALSE) {
			echo "Aucune créature n'a été trouvée dans la base de données !";
		}

		$requete = "SELECT count(idEtre_1_1) FROM PNJ";
		$nb_PNJ = mysqli_query($connexion, $requete);
		if($nb_PNJ == FALSE) {
			echo "Aucune PNJ n'a été trouvée dans la base de données !";
		}

	$requete = "SELECT count(idElement) FROM Element";
	$nb_Element = mysqli_query($connexion, $requete);
	if($nb_Element == FALSE) {
		echo "Aucune etre n'a été trouvée dans la base de données !";
	}

		$requete = "SELECT count(idElement_1_1) FROM Piege";
		$nb_Piege = mysqli_query($connexion, $requete);
		if($nb_Piege == FALSE) {
			echo "Aucune etre n'a été trouvée dans la base de données !";
		}

		$requete = "SELECT count(idElement_1_1) FROM Mobilier";
		$nb_Mobilier = mysqli_query($connexion, $requete);
		if($nb_Mobilier == FALSE) {
			echo "Aucune etre n'a été trouvée dans la base de données !";
		}

		$requete = "SELECT count(idElement_1_1) FROM Equipement";
		$nb_Equipement = mysqli_query($connexion, $requete);
		if($nb_Equipement == FALSE) {
			echo "Aucune etre n'a été trouvée dans la base de données !";
		}
	

?>
