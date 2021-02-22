<?php
    $connexion = getConnexionBD(); // connexion à la BD
    mysqli_set_charset($connexion, "utf8");
   
    // Récuperation de données de BDD
    $requete = "SELECT * FROM Etre";
    $data_Etre = mysqli_query($connexion, $requete);
    if($data_Etre == FALSE) 
    {
        echo "Aucun etre n'a été trouvée dans la base de données !";
    }
    
    $requete = "SELECT * FROM Creature";
    $data_Creature = mysqli_query($connexion, $requete);
    if($data_Creature == FALSE) 
    {
        echo "Aucune créature n'a été trouvée dans la base de données !";
    }

    $requete = "SELECT * FROM Element";
    $data_Element = mysqli_query($connexion, $requete);
    if($data_Element == FALSE) 
    {
        echo "Aucun élément n'a été trouvée dans la base de données !";
    }

    $requete = "SELECT * FROM Piege";
    $data_Piege = mysqli_query($connexion, $requete);
    if($data_Piege == FALSE) 
    {
        echo "Aucun piège n'a été trouvée dans la base de données !";
    }

    $requete = "SELECT * FROM Mobilier";
    $data_Mobilier = mysqli_query($connexion, $requete);
    if($data_Mobilier == FALSE) 
    {
        echo "Aucun mobilier n'a été trouvée dans la base de données !";
    }

    $requete = "SELECT * FROM Environnement";
    $data_Environnement = mysqli_query($connexion, $requete);
    if($data_Environnement == FALSE) 
    {
        echo "Aucun environnement n'a été trouvée dans la base de données !";
    }
?>



