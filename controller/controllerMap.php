<?php
    $connexion = getConnexionBD(); // connexion à la BD
    mysqli_set_charset($connexion, "utf8");
   
    // Récuperation de données de BDD
    $requete = "SELECT idContributrice, nom FROM Contributrice";
    $data_Contributrice = mysqli_query($connexion, $requete);

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
    $objectif = $creator = $nb_zoneMin = $nb_zoneMax = $environnement = $nb_equipementMin = $nb_equipementMax = $nb_piegeMin 
    = $nb_piegeMax = $nb_mobilierMin = $nb_mobilierMax = $nb_creatureMin = $nb_creatureMax = $nb_pnjMin = $nb_pnjMax = $div =
    $d_zoneMin = $d_zoneMax = $nomMap = "";
    $nomMapErr = $objectifErr = $creatorErr = $environnementErr = $equipementErr = $piegeErr = $mobilierErr = $creatureErr = $pnjErr = $d_zoneErr = 
    $nb_zoneErr =  "";
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") // Si formulaire soumis
    {
        // Vérification des données saisies par user
        if ( $_POST['nomMap'] != "" && isset($_POST['nomMap']) ) $nomMap = $_POST['nomMap'];
        else $nomMapErr = "* Saisissez un nom de la carte!";

        if ( $_POST['nbzoneMin'] != "" && $_POST['nbzoneMax'] != "" && $_POST['nbzoneMin'] >= 0 
            && $_POST['nbzoneMax'] >= 0 && $_POST['nbzoneMax'] >= $_POST['nbzoneMin'] )
        {
            $nb_zoneMin = $_POST['nbzoneMin'];
            $nb_zoneMax = $_POST['nbzoneMax'];
        }
        else $nb_zoneErr = " * Erreur lors de saisie de nombres minimal ou maximal de zones!";

        if ( $_POST['minZone'] != "" && $_POST['maxZone'] != "" && $_POST['minZone'] >= 0 
            && $_POST['maxZone'] >= 0 && $_POST['maxZone'] >= $_POST['minZone'] )
        {
            $d_zoneMin = $_POST['minZone'];
            $d_zoneMax = $_POST['maxZone'];
        }
        else $d_zoneErr = " * Erreur lors de saisie de dimensions minimal ou maximal de zones!";

        if ( isset($_POST['environnement']) && $_POST['environnement'] != "" )
        {
            $environnement = $_POST['environnement'];
        }
        else $environnementErr = " * Choisissez un environnement!";
        
        if ( isset($_POST['objectif']) && $_POST['objectif'] != "" )
        {
            $objectif = $_POST['objectif'];
        }
        else $objectifErr = " * Choisissez un objectif!";

        if ( isset($_POST['creator']) && $_POST['creator'] != "" )
        {
            $creator = $_POST['creator'];
        }
        else $creatorErr = " * Choisissez une contributrice!";
        
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
        if ( $d_zoneMin != "" && $d_zoneMax != "" && $nb_zoneMin != "" && $nb_zoneMax != "" )
        {
            $div = "Off"; // Cacher formulaire
            
            // Déclaration de variables pour création de la zone
            $map = $zone_d_1 = $zone_d_2 = array();
            for ($i = 0; $i < 20; $i++)
            {
                for ($j = 0; $j < 100; $j++)
                {
                    $map[$i][$j] = 0;
                }
            }

            // Génération de nombres aléatoires à partir de nombres saisis par user
            $nb_zone = mt_rand($nb_zoneMin, $nb_zoneMax);

            for ( $k = 1; $k < $nb_zone+1; $k++ )
            {
                $dimension_1 = mt_rand($d_zoneMin, $d_zoneMax);
                $dimension_2 = mt_rand($d_zoneMin, $d_zoneMax);
                zone($map, 20, 100, $dimension_1, $dimension_2, $k);
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