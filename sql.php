<?php
    $access = "";
?>

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<!-- Imporation de bdd -->
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") // Si formulaire soumis
    {  
        if ($_POST['id'] == "admin" && $_POST['pass'] == "ericflag") $access = TRUE; // Vérification pour reload bdd
    }

    if ($access == TRUE)
    {
        // Connexion à la bdd
        require('inc/constantes.php');
        require('inc/includes.php');
        $connexion = getConnexionBD(); // connexion à la BD
        mysqli_set_charset($connexion, "utf8");

        // Importation dans bdd les fichiers .sql
        importBDD("bdd/bdd.sql");
        importBDD("bdd/dataset.sql");

        // Requete SQL qui récupère la table avec les données
        $requete = "SELECT * FROM DonneesFournies;";
        $donnes = mysqli_query($connexion, $requete);

        if ($donnes == FALSE) echo "Aucune données n'a été trouvée dans la base de données !"; 
        else 
        {
            // Déclaration de ID créature et ID élément
            $idCreature = 0;
            $idElement = 0;
            while ($data = mysqli_fetch_assoc($donnes)) // parcours de la table "DonneesFournies"
            {
                if ($data['type'] == "créature") 
                {
                    $idCreature++;
                    $nom = $data['nom'];
                    $explore_0 = explode(",",$data['attributs']); // Séparation des attibuts à l'aide de virgule
                    for ($i = 0; $i < count($explore_0); $i++)
                    {
                        // Séparation du type d'attribut et son résultat
                        $explore_1 = explode("=", $explore_0[$i]); // séparation ex: catégorie=Undead > catégorie = 0, Undead = 1
                        // Vérification et remplissage de variables avec les attributs donnés
                        if ($explore_1[0] == "catégorie") $categorie = $explore_1[1];
                        else if ($explore_1[0] == " climat") $climat = $explore_1[1];
                        else if ($explore_1[0] == " pieces") $quantiteOr = $explore_1[1];
                        else if ($explore_1[0] == " environnement" && $explore_1[1] != "Unknown") $environnement = $explore_1[1];
                        else if ($explore_1[0] == " difficulté") $difficulte = $explore_1[1];
                        else if ($explore_1[0] == " attaque") $ptAtt = $explore_1[1];
                        else if ($explore_1[0] == " vie") $pv = $explore_1[1];
                    }

                    // Requete SQL d'insértion dans table "Etre" à l'aide AUTO_INCREMENT pour ID 
                    $requete =  'INSERT INTO Etre(`nom`, `categorie`, `quantiteOr`, `ptAtt`, `pv`) 
                    VALUES ("'.$nom.'","'.$categorie.'","'.$quantiteOr.'","'.$ptAtt.'","'.$pv.'");';
                    $insertion = mysqli_query($connexion, $requete);
                    if ($insertion == TRUE)
                    {
                        $requete =  'INSERT INTO Creature(`idEtre_1_1`,`climat`, `environnement`, `difficulte`) 
                        VALUES ('.$idCreature.',"'.$climat.'","'.$environnement.'","'.$difficulte.'");';
                        $insertion = mysqli_query($connexion, $requete);

                        if ($insertion == TRUE) 
                        {
                            $requete =  'SELECT nomE FROM Environnement WHERE nomE = "'.$environnement.'";';
                            $verif = mysqli_query($connexion, $requete);
                            $env = mysqli_fetch_assoc($verif);
                            if ($env == NULL && $environnement != "") // Vérification si l'environnement n'existe pas dans bdd
                            {
                                $requete =  'INSERT INTO Environnement(`nomE`) 
                                VALUES ("'.$environnement.'");';
                                $insertion = mysqli_query($connexion, $requete);
                                if($insertion == FALSE)
                                {
                                    echo "Erreur lors de l'insertion dans Environnement!<br>";
                                    echo $requete;
                                    echo "<br><br>";
                                }
                            }                       
                        }

                        if ($insertion == FALSE)
                        {
                            echo "Erreur lors de l'insertion dans Creature!<br>";
                            echo $requete;
                            echo "<br><br>";
                        }
                    }
                    else
                    {
                        echo "Erreur lors de l'insertion dans Etre!<br>";
                        echo $requete;
                        echo "<br><br>";
                    }
                }

                else if ($data['type'] == "piège")
                {
                    $idElement++;
                    $nom = $data['nom'];
                    $explore_0 = explode(",",$data['attributs']);
                    for ($i = 0; $i < count($explore_0); $i++)
                    {
                        $explore_1 = explode("=", $explore_0[$i]); // séparation ex: catégorie=Undead > catégorie = 0, Undead = 1
                        if ($explore_1[0] == "catégorie") $categorie = $explore_1[1];
                        else if ($explore_1[0] == " detecter") $detecter = $explore_1[1];
                        else if ($explore_1[0] == " esquiver") $esquiver = $explore_1[1];
                        else if ($explore_1[0] == " desamorcer") $desamorcer = $explore_1[1];
                        else if ($explore_1[0] == " zone")
                        {
                            $zone = $explore_1[1];
                            $explore_zone = explode(" ",$zone);
                            $zone = $explore_zone[0];
                        } 
                        else if ($explore_1[0] == " image") $image = $explore_1[1];

                    }

                    $requete =  'INSERT INTO Element(`nom`, `cheminImage`) 
                    VALUES ("'.$nom.'","'.$image.'");';
                    $insertion = mysqli_query($connexion, $requete);
                    if ($insertion == TRUE)
                    {
                        $requete =  'INSERT INTO Piege(`idElement_1_1`,`categorie`, `zoneEffet`, `detecter`, `esquiver`, `desamorcer`) 
                        VALUES ('.$idElement.',"'.$categorie.'","'.$zone.'","'.$detecter.'","'.$esquiver.'","'.$desamorcer.'");';
                        $insertion = mysqli_query($connexion, $requete);
                        if ($insertion != TRUE) 
                        {
                            echo "Erreur lors de l'insertion dans Piege!<br>";
                            echo $requete;
                            echo "<br><br>";
                        }
                    }
                    else
                    {
                        echo "Erreur lors de l'insertion dans Element!<br>";
                        echo $requete;
                        echo "<br><br>";
                    }
                }

                else if ($data['type'] == "mobilier")
                {
                    $idElement++;
                    $nom = $data['nom'];
                    $explore_0 = explode(",",$data['attributs']);
                    for ($i = 0; $i < count($explore_0); $i++)
                    {
                        $explore_1 = explode("=", $explore_0[$i]); // séparation ex: catégorie=Undead > catégorie = 0, Undead = 1
                        if ($explore_1[0] == "image") $image = $explore_1[1];
                        else if ($explore_1[0] == " deplacable") $deplacable = $explore_1[1];
                        else if ($explore_1[0] == " dimensions") $dimension = $explore_1[1];
                    }

                    $requete =  'INSERT INTO Element(`nom`, `cheminImage`) 
                    VALUES ("'.$nom.'","'.$image.'");';
                    $insertion = mysqli_query($connexion, $requete);
                    if ($insertion == TRUE)
                    {
                        $requete =  'INSERT INTO Mobilier(`idElement_1_1`,`deplacable`, `dimension`) 
                        VALUES ('.$idElement.',"'.$deplacable.'","'.$dimension.'");';
                        $insertion = mysqli_query($connexion, $requete);
                        if ($insertion != TRUE) 
                        {
                            echo "Erreur lors de l'insertion dans Mobilier!<br>";
                            echo $requete;
                            echo "<br><br>";
                        }
                    }
                    else
                    {
                        echo "Erreur lors de l'insertion dans Element!<br>";
                        echo $requete;
                        echo "<br><br>";
                    }
                }
            }
            importBDD('bdd/data.sql');
            $requete = "DROP TABLE IF EXISTS DonneesFournies;";
            mysqli_query($connexion, $requete);
            echo'   <div class="w3-container w3-display-middle" style="width:500px;">
                    <br>
                    <div class="w3-border-black w3-xxlarge">
                    <div class="w3-container w3-green w3-center" style="width:100%">100%</div>
                    </div>
                    <br>';
            echo "  <a href='https://bdw1.univ-lyon1.fr/p2002123/PROJET/index.php' style='text-decoration:none;'>
                    <div class='w3-button w3-panel w3-border w3-round-xlarge w3-black' style='display: block;'>
                    <p>Voir site</p>
                    </div></a>";
        }
        echo "  <a href='https://bdw1.univ-lyon1.fr/phpmyadmin/' style='text-decoration:none'>
                <div class='w3-button w3-panel w3-border w3-round-xlarge w3-red' style='display: block;'>
                <p>Voir BDD</p>
                </div></a>
                </div>";
    }
?>


<!-- Formulaire d'identification pour reload bdd -->
<div class="w3-white w3-display-middle" id="form" style="width:500px; <?php if ($access == TRUE) echo "display:none;"; ?>">
    <br>
    <div class="w3-container">
        <section class="w3-card-4">
            <div class="w3-container w3-black"><h2>Authentification</h2></div>
            <form method="POST" id="form" class="w3-container" action="">
                <p>
                    <label for="id">ID:</label>
                    <input type="text" name="id" id="id" class="w3-input w3-border"/>
                </p>
                <p>
                    <label for="pass">PASS:</label>
                    <input type="password" name="pass" id="pass" class="w3-input w3-border" />
                </p>
                <p class="w3-center">
                    <button type="sumbit" class="w3-button w3-black w3-mobile w3-border">Soumettre</button>
                    <button type="reset" class="w3-button w3-black w3-mobile w3-border">Annuler</button>
                </p>
            </form>
        </section>
    </div>
        <a href='https://bdw1.univ-lyon1.fr/p2002123/PROJET/index.php' style='text-decoration:none;'>
            <div class='w3-button w3-panel w3-border w3-round-xlarge w3-black' style='display: block;'>
                <p>Retour sur le site</p>
            </div>
        </a>
        <a href='https://bdw1.univ-lyon1.fr/phpmyadmin/' style='text-decoration:none'>
            <div class='w3-button w3-panel w3-border w3-round-xlarge w3-red' style='display: block;'>
                <p>Voir BDD</p>
            </div>
        </a>
    </div>
</div>


<?php
    // Fonction d'importation de fichiers .sql dans bdd
    function importBDD($file)
    {
        // Connexion à la bdd
        $connexion = getConnexionBD();
        mysqli_set_charset($connexion, "utf8");
        // Récuperation du fichier .sql et séparation ligne par ligne
        $file = file_get_contents($file);
        $explore_file = explode(";",$file);
        // Insértion ligne par ligne
        for ($i = 0; $i < count($explore_file); $i++)
        {
            $requete = $explore_file[$i];
            if ($requete != "") mysqli_query($connexion, $requete);
        }
    }
?>
