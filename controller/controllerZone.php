<?php
    $connexion = getConnexionBD(); // connexion à la BD
    mysqli_set_charset($connexion, "utf8");
   
    // Récuperation de données de BDD
    $requete = "SELECT nomE FROM Environnement";
    $data_Environnement = mysqli_query($connexion, $requete);

    $requete = "SELECT COUNT(*) FROM Equipement";
    $nb_MaxEquipement = mysqli_query($connexion, $requete);
    $nb_MaxEquipement = mysqli_fetch_assoc($nb_MaxEquipement);

    $requete = "SELECT COUNT(*) FROM Piege";
    $nb_MaxPiege = mysqli_query($connexion, $requete);
    $nb_MaxPiege = mysqli_fetch_assoc($nb_MaxPiege);

    $requete = "SELECT COUNT(*) FROM Mobilier";
    $nb_MaxMobilier = mysqli_query($connexion, $requete);
    $nb_MaxMobilier = mysqli_fetch_assoc($nb_MaxMobilier);

    $requete = "SELECT COUNT(*) FROM Creature";
    $nb_MaxCreature = mysqli_query($connexion, $requete);
    $nb_MaxCreature = mysqli_fetch_assoc($nb_MaxCreature);

    $requete = "SELECT COUNT(*) FROM PNJ";
    $nb_MaxPNJ = mysqli_query($connexion, $requete);
    $nb_MaxPNJ = mysqli_fetch_assoc($nb_MaxPNJ);

    // Déclaration des variables
    $dimension = $dimensions = $environnement = $nb_equipementMin = $nb_equipementMax = $nb_piegeMin = $nb_piegeMax = $nb_mobilierMin = 
    $nb_mobilierMax = $nb_creatureMin = $nb_creatureMax = $nb_pnjMin = $nb_pnjMax = $div = "";
    $dimensionsErr = $environnementErr = $equipementErr = $piegeErr = $mobilierErr = $creatureErr = $pnjErr = "";
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") // Si formulaire soumis
    {
        // Vérification des données saisies par user
        if ( $_POST['dimensions'] != "" )
        {
            $dimensions = explode("x",$_POST['dimensions']);
            if ( $dimensions[0] <= "0" || $dimensions[1] <= "0" )
            {
                $dimensionsErr = " * Saisissez des dimensions à partir de 1!";
                $dimensions = "";
            }
            else $dimension = $_POST['dimensions'];
        }
        else $dimensionsErr = " * Saisissez des dimensions!";


        if ( isset($_POST['environnement']) && $_POST['environnement'] != "x" )
        {
            $environnement = $_POST['environnement'];
        }
        else $environnementErr = " * Choisissez un environnement!";
        
        
        if ( $_POST['minEquipements'] != "" && $_POST['maxEquipements'] != "" && $_POST['minEquipements'] >= 0 &&
        $_POST['minEquipements'] <= $_POST['maxEquipements'] && $_POST['maxEquipements'] >= 0 && 
        $_POST['maxEquipements'] <= $nb_MaxEquipement['COUNT(*)'] )
        {
           $nb_equipementMin = $_POST['minEquipements'];
           $nb_equipementMax = $_POST['maxEquipements'];
        }
        else $equipementErr = " * Erreur lors de saisie de nombre minimal ou maximal d'équipements!";
  
        if ( $_POST['minPieges'] != "" && $_POST['maxPieges'] != "" && $_POST['minPieges'] >= 0 &&
        $_POST['minPieges'] <= $_POST['maxPieges'] && $_POST['maxPieges'] >= 0 && 
        $_POST['maxPieges'] <= $nb_MaxPiege['COUNT(*)'] )
        {
           $nb_piegeMin = $_POST['minPieges'];
           $nb_piegeMax = $_POST['maxPieges'];
        }
        else $piegeErr = " * Erreur lors de saisie de nombre minimal ou maximal de pièges!";

        if ( $_POST['minMobiliers'] != "" && $_POST['maxMobiliers'] != "" && $_POST['minMobiliers'] >= 0 &&
        $_POST['minMobiliers'] <= $_POST['maxMobiliers'] && $_POST['maxMobiliers'] >= 0 && 
        $_POST['maxMobiliers'] <= $nb_MaxMobilier['COUNT(*)'] )
        {
           $nb_mobilierMin = $_POST['minMobiliers'];
           $nb_mobilierMax = $_POST['maxMobiliers'];
        }
        else $mobilierErr = " * Erreur lors de saisie de nombre minimal ou maximal de mobiliers!";
        
        if ( $_POST['minCreatures'] != "" && $_POST['maxCreatures'] != "" && $_POST['minCreatures'] >= 0 &&
        $_POST['minCreatures'] <= $_POST['maxCreatures'] && $_POST['maxCreatures'] >= 0 && 
        $_POST['maxCreatures'] <= $nb_MaxCreature['COUNT(*)'] )
        {
           $nb_creatureMin = $_POST['minCreatures'];
           $nb_creatureMax = $_POST['maxCreatures'];
        }
        else $creatureErr = " * Erreur lors de saisie de nombre minimal ou maximal de créatures!";

        if ( $_POST['minPNJ'] != "" && $_POST['maxPNJ'] != "" && $_POST['minPNJ'] >= 0 &&
        $_POST['minPNJ'] <= $_POST['maxPNJ'] && $_POST['maxPNJ'] >= 0 && 
        $_POST['maxPNJ'] <= $nb_MaxPNJ['COUNT(*)'] )
        {
           $nb_pnjMin = $_POST['minPNJ'];
           $nb_pnjMax = $_POST['maxPNJ'];
        }
        else $pnjErr = " * Erreur lors de saisie de nombre minimal ou maximal de PNJ!";

        // Création de la zone avec les données saisies par user
        if ( $environnement != "" && $nb_equipementMin != "" && $nb_equipementMax != "" && $nb_piegeMin != "" && $nb_piegeMax != "" && 
        $nb_mobilierMin != "" && $nb_mobilierMax != "" && $nb_creatureMin != "" && $nb_creatureMax != "" && $nb_pnjMin != "" && 
        $nb_pnjMax != "" )
        {
            $div = "Off"; // Cacher formulaire
            
            // Déclaration de variables pour création de la zone
            $zone = array();
            $id_Element = array();
            $id_Etre = array();
            $compteur_Element= 0;
            $compteur_Etre= 0;

            // Remplissage du tableau $zone
            for ($i = 0; $i < $dimensions[0]; $i++)
            {
                for ($j = 0; $j < $dimensions[1]; $j++)
                {
                    $zone[$i][$j] = 0;
                }
            }

            // Génération de nombres aléatoires à partir de nombres saisis par user
            $rand_Equipement = mt_rand($nb_equipementMin, $nb_equipementMax); // $nb = 1
            $rand_Piege = mt_rand($nb_piegeMin, $nb_piegeMax); // $nb = 2
            $rand_Mobilier = mt_rand($nb_mobilierMin, $nb_mobilierMax); // $nb = 3
            $rand_Creature = mt_rand($nb_creatureMin, $nb_creatureMax); // $nb = 4
            $rand_PNJ = mt_rand($nb_pnjMin, $nb_pnjMax); // $nb = 5

            // Remplissage du tableau $zone en choisissant des objets aléatoires de BDD à partir de nombres aléatoires généres en dessus
            // Et remplissage du tableau $id_Element et $id_Etre pour pouvoir les identifier ultérieurement
            $requete = "SELECT * FROM Equipement ORDER BY RAND() LIMIT ".$rand_Equipement.";";
            $data_bdd = mysqli_query($connexion, $requete);
            if ( $data_bdd == TRUE)
            {
                while ( $data = mysqli_fetch_assoc($data_bdd) )
                {
                    $x = explode("x",$data['dimension']);
                    if ( zone($zone, $dimensions[0], $dimensions[1], $x[0], $x[1], $data['idElement_1_1']) )
                    {
                        $id_Element[$compteur_Element] = $data['idElement_1_1'];
                        $compteur_Element++;
                    }
                }
            }
            
            $requete = "SELECT * FROM Piege ORDER BY RAND() LIMIT ".$rand_Piege.";";
            $data_bdd = mysqli_query($connexion, $requete);
            if ( $data_bdd == TRUE)
            {
                while ( $data = mysqli_fetch_assoc($data_bdd) )
                {
                    $x = explode("x",$data['zoneEffet']);
                    if ( is_numeric($x[0]) && is_numeric($x[1]) ) // Piège 157 ne contient pas de dimensions
                    {
                        if ( zone($zone, $dimensions[0], $dimensions[1], $x[0], $x[1], $data['idElement_1_1']) )
                        {
                            $id_Element[$compteur_Element] = $data['idElement_1_1'];
                            $compteur_Element++;
                        }
                    }
                }
            }

            $requete = "SELECT * FROM Mobilier ORDER BY RAND() LIMIT ".$rand_Mobilier.";";
            $data_bdd = mysqli_query($connexion, $requete);
            if ( $data_bdd == TRUE)
            {
                while ( $data = mysqli_fetch_assoc($data_bdd) )
                {
                    $x = explode("x",$data['dimension']);
                    if ( zone($zone, $dimensions[0], $dimensions[1], $x[0], $x[1], $data['idElement_1_1']) )
                    {
                        $id_Element[$compteur_Element] = $data['idElement_1_1'];
                        $compteur_Element++;
                    }
                }
            }

            $requete = "SELECT * FROM Creature ORDER BY RAND() LIMIT ".$rand_Creature.";";
            $data_bdd = mysqli_query($connexion, $requete);
            if ( $data_bdd == TRUE)
            {
                while ( $data = mysqli_fetch_assoc($data_bdd) )
                {
                    if ( zone($zone, $dimensions[0], $dimensions[1], 1, 1, $data['idEtre_1_1']) )
                    {
                        $id_Etre[$compteur_Etre] = $data['idEtre_1_1'];
                        $compteur_Etre++;
                    }
                }
            }

            $requete = "SELECT * FROM PNJ ORDER BY RAND() LIMIT ".$rand_PNJ.";";
            $data_bdd = mysqli_query($connexion, $requete);
            if ( $data_bdd == TRUE)
            {
                while ( $data = mysqli_fetch_assoc($data_bdd) )
                {
                    if ( zone($zone, $dimensions[0], $dimensions[1], 1, 1, $data['idEtre_1_1']) )
                    {
                        $id_Etre[$compteur_Etre] = $data['idEtre_1_1'];
                        $compteur_Etre++;
                    }
                }
            }
            


        }
    }

?>




<?php
    // Fonction qui remplie le tableau en fonction de cases libres
    function zone(&$tab, $dimension_1, $dimension_2, $x1, $x2, $nb)
    {
        $compteur = 0;
        for ($i = 0; $i < $dimension_1; $i++) 
        {                    
            for ($j = 0; $j < $dimension_2; $j++)
            {
                if ( tab($tab, $dimension_1, $dimension_2, $x1, $x2, $i, $j) )
                {   
                    for ( $k = $i; $k < $i+$x1; $k++ )
                    {
                        for ( $d = $j; $d < $j+$x2; $d++ )
                        {
                            $tab[$k][$d] = $nb;
                            $compteur++;
                        }
                        if ($compteur == $x1*$x2) return TRUE;                  
                    }
                }
            }
        }
        return FALSE;
    }
    // Fonction qui est un complément de fonction $zone pour pouvoir vérifier les cases précises
    function tab ($tab, $dimension_1, $dimension_2, $x1, $x2, $i, $j)
    {   
        if ( is_numeric($i) && is_numeric($j) && is_numeric($x1) && is_numeric($x2) && is_numeric($dimension_1) && is_numeric($dimension_2) )
        {
            if ( $i+$x1-1 < $dimension_1 && $j+$x2-1 < $dimension_2 )
            {
                for ( $a = $i; $a < $i+$x1; $a++ )
                {
                    for ( $b = $j; $b < $j+$x2; $b++ )
                    {
                        if ( $tab[$a][$b] != 0 ) return FALSE;                            
                    }
                } 
                return TRUE; 
            }
            else return FALSE;
        }
        else return FALSE;
    }
?>