
<!-- Formulaire de création de la zone -->
<div class="w3-white" id="form" style="width:800px; margin: auto; <?php if ($div == "Off") echo "display: none;" ?>">
    <div class="w3-container">
        <section class="w3-card-4">
            <div class="w3-container w3-black"><h2>Formulaire de génération de zone:</h2></div>
                <form method="POST" id="form" class="w3-container" action="">
                    <p>
                        <label for="description">Decscription:</label>
                        <input type="text" name="description" id="description" class="w3-input w3-border" placeholder="..." 
                        onfocus="this.placeholder='...'"  onMouseout="this.placeholder='...'">
                    </p>
                    <p>
                        <label for="dimensions">Dimensions (<u>Attention à ne pas dépasser 100x100</u>):</label>
                        <span class="error" style = "color: #FF0000"><?php echo $dimensionsErr;?></span>
                        <input type="text" name="dimensions" id="dimensions" class="w3-input w3-border" placeholder="Ex: 1x1" 
                        onfocus="this.placeholder='Ex: 1x1'" value="<?php echo $dimension; ?>"/>
                    </p>
                    <p>
                        <label for="environnement">Environnement: </label>
                        <span class="error" style = "color: #FF0000"><?php echo $environnementErr;?></span>
                        <select class="w3-select" name="environnement" id="environnement" style="width: 150px;">
                            <option value="" disabled <?php if ( $environnement == "" ) echo "selected";?> >Choisissez:</option>
                            <?php
                                while ( $environnementD = mysqli_fetch_assoc($data_Environnement) )
                                {
                                    echo '<option value="'.$environnementD['nomE'].'"'; ?>
                                    <?php if ($environnement == $environnementD['nomE']) echo "selected";?>
                                    <?php echo '>'.$environnementD['nomE'].'</option>';
                                }
                            ?>
                        </select>
                    </p>
                    <p>
                    <label for="NbEquipements" >Nombre d'équipements (Maximum à ne pas dépasser: <?php echo $nb_MaxEquipement['COUNT(*)']; ?>):</label><br>
                    <span class="error" style = "color: #FF0000"><?php echo $equipementErr;?></span>
                    <input type="number" name="minEquipements" id="minEquipements" class="w3-half w3-input w3-border" 
                    placeholder="Min" onfocus="this.placeholder='Min'" value="<?php echo $nb_equipementMin; ?>"/>
                    <input type="number" name="maxEquipements" id="maxEquipements" class="w3-half w3-input w3-border" 
                    placeholder="Max" onfocus="this.placeholder='Max'" value="<?php echo $nb_equipementMax; ?>" />
                    </p>
                    <br>
                    <p>
                    <label for="NbPieges" >Nombre de pièges (Maximum à ne pas dépasser: <?php echo $nb_MaxPiege['COUNT(*)']; ?>):</label><br>
                    <span class="error" style = "color: #FF0000"><?php echo $piegeErr;?></span>
                    <input type="number" name="minPieges" id="minPieges" class="w3-half w3-input w3-border" 
                    placeholder="Min" onfocus="this.placeholder='Min'" value="<?php echo $nb_piegeMin; ?>" />
                    <input type="number" name="maxPieges" id="maxPieges" class="w3-half w3-input w3-border" 
                    placeholder="Max" onfocus="this.placeholder='Max'" value="<?php echo $nb_piegeMax; ?>"/>
                    </p>
                    <br>
                    <p>
                    <label for="NbMobiliers" >Nombre de mobiliers (Maximum à ne pas dépasser: <?php echo $nb_MaxMobilier['COUNT(*)']; ?>):</label><br>
                    <span class="error" style = "color: #FF0000"><?php echo $mobilierErr;?></span>
                    <input type="number" name="minMobiliers" id="minMobiliers" class="w3-half w3-input w3-border"
                    placeholder="Min" onfocus="this.placeholder='Min'" value="<?php echo $nb_mobilierMin; ?>" />
                    <input type="number" name="maxMobiliers" id="maxMobiliers" class="w3-half w3-input w3-border" 
                    placeholder="Max" onfocus="this.placeholder='Max'" value="<?php echo $nb_mobilierMax; ?>" />
                    </p>
                    <br>
                    <p>
                    <label for="NbCreatures" >Nombre de créatures (Maximum à ne pas dépasser: <?php echo $nb_MaxCreature['COUNT(*)']; ?>):</label><br>
                    <span class="error" style = "color: #FF0000"><?php echo $creatureErr;?></span>
                    <input type="number" name="minCreatures" id="minCreatures" class="w3-half w3-input w3-border" 
                    placeholder="Min" onfocus="this.placeholder='Min'" value="<?php echo $nb_creatureMin; ?>" />
                    <input type="number" name="maxCreatures" id="maxCreatures" class="w3-half w3-input w3-border" 
                    placeholder="Max" onfocus="this.placeholder='Max'" value="<?php echo $nb_creatureMax; ?>"/>
                    </p>
                    <br>
                    <p>
                    <label for="NbPNJ" >Nombre de PNJ (Maximum à ne pas dépasser: <?php echo $nb_MaxPNJ['COUNT(*)']; ?>):</label><br>
                    <span class="error" style = "color: #FF0000"><?php echo $pnjErr;?></span>
                    <input type="number" name="minPNJ" id="minPNJ" class="w3-half w3-input w3-border" 
                    placeholder="Min" onfocus="this.placeholder='Min'" value="<?php echo $nb_pnjMin; ?>"/>
                    <input type="number" name="maxPNJ" id="maxPNJ" class="w3-half w3-input w3-border" 
                    placeholder="Max" onfocus="this.placeholder='Max'" value="<?php echo $nb_pnjMax; ?>"/>
                    </p>
                    <br>
                    <p class="w3-center">
                        <button type="sumbit" class="w3-button w3-black w3-mobile w3-border">Soumettre</button>
                        <button type="reset" class="w3-button w3-black w3-mobile w3-border">Annuler</button>
                    </p>
                </form>
        </section>
    </div>
    <br><br><br><br>
</div>

<!-- Affichage de la zone -->
<?php
    // Affichage de la zone crée auparavant
    if ( $div == "Off" )
    {
        echo "<div class='w3-display-middle'>";
        echo "<p><b>Dimensions:</b> $dimension</p>";
        echo "<p><b>Equipement:</b> Vert, <b>Piège:</b> Gris, <b>Mobilier:</b> Marron</p>";
        echo "<p><b>Créature:</b> Noir, <b>PNJ:</b> Rouge</p>";
        echo '<table class="w3-border w3-centered" style="width:500px; height:500px;" cellspacing="0" cellpadding="0">';
        $mis = FALSE; // Aide à savoir si une case a été affiché ou pas

        // Parcours du tableau $zone pour pouvoir afficher la zone
        for ($i = 0; $i < $dimensions[0]; $i++)
        {   
            echo "<tr>";
            for ($j = 0; $j < $dimensions[1]; $j++)
            {
                foreach ($id_Element as $value) // Parcours du tableau $id_Element pour pouvoir identifer le bon élément 
                {
                    if ($value == $zone[$i][$j])
                    {
                        // Récuperation de données précises de bdd
                        $requete = "SELECT * FROM Element NATURAL JOIN Equipement 
                                    WHERE idElement = ".$value." && idElement_1_1 = ".$value.";";
                        $data_Element = mysqli_query($connexion, $requete);
                        $data_Element = mysqli_fetch_assoc($data_Element);
                        if ( $data_Element != NULL )
                        {
                            if ( $data_Element['cheminImage'] == NULL )
                            {
                                // Affichage de la case avec les données récupérées plus haut
                                echo "  <td class='w3-green w3-dropdown-hover w3-border'>
                                        <div class='w3-dropdown-content w3-card-4' style='width:200px'>
                                        <div class='w3-container'>
                                        <p><b>ID:</b> $value</p>
                                        <p><b>Nom:</b> ".$data_Element['nom']."</p>
                                        <p><b>Valeur d'or:</b> ".$data_Element['valeurOr']."</p>
                                        <p><b>Dimensions:</b> ".$data_Element['dimension']."</p>
                                        </div>
                                        </div>
                                        $value</td>";
                                $mis = TRUE;
                            }
                            else
                            {
                                echo "  <td class='w3-green w3-dropdown-hover w3-border'>
                                    <div class='w3-dropdown-content w3-card-4' style='width:200px'>
                                    <img src='img/".$data['cheminImage']."' style='width:100%'>
                                    <div class='w3-container'>
                                    <p><b>ID:</b> $value</p>
                                    <p><b>Nom:</b> ".$data_Element['nom']."</p>
                                    <p><b>Valeur d'or:</b> ".$data_Element['valeurOr']."</p>
                                    <p><b>Dimensions:</b> ".$data_Element['dimension']."</p>
                                    </div>
                                    </div>
                                    $value</td>";
                                $mis = TRUE;
                            }
                        }
                        else
                        {
                            $requete = "SELECT * FROM Element NATURAL JOIN Piege 
                                        WHERE idElement = ".$value." && idElement_1_1 = ".$value.";";
                            $data_Element = mysqli_query($connexion, $requete);
                            $data_Element = mysqli_fetch_assoc($data_Element);
                            if ( $data_Element != NULL )
                            {
                                if ( $data_Element['cheminImage'] == NULL && $data_Element['cheminImage'] == "")
                                {
                                    echo "  <td class='w3-gray w3-dropdown-hover w3-border'>
                                            <div class='w3-dropdown-content w3-card-4' style='width:200px'>
                                            <div class='w3-container'>
                                            <p><b>ID:</b> $value</p>
                                            <p><b>Nom:</b> ".$data_Element['nom']."</p>
                                            <p><b>Catégorie:</b> ".$data_Element['categorie']."</p>
                                            <p><b>Zone d'effet:</b> ".$data_Element['zoneEffet']."</p>
                                            <p><b>Détecter:</b> ".$data_Element['detecter']."</p>
                                            <p><b>Esquiver:</b> ".$data_Element['esquiver']."</p>
                                            <p><b>Désamorcer:</b> ".$data_Element['desamorcer']."</p>
                                            </div>
                                            </div>
                                            $value</td>";
                                    $mis = TRUE;
                                }
                                else
                                {
                                    echo "  <td class='w3-gray w3-dropdown-hover w3-border'>
                                            <div class='w3-dropdown-content w3-card-4' style='width:200px'>
                                            <img src='img/".$data_Element['cheminImage']."' style='width:100%'>
                                            <div class='w3-container'>
                                            <p><b>ID:</b> $value</p>
                                            <p><b>Nom:</b> ".$data_Element['nom']."</p>
                                            <p><b>Catégorie:</b> ".$data_Element['categorie']."</p>
                                            <p><b>Zone d'effet:</b> ".$data_Element['zoneEffet']."</p>
                                            <p><b>Détecter:</b> ".$data_Element['detecter']."</p>
                                            <p><b>Esquiver:</b> ".$data_Element['esquiver']."</p>
                                            <p><b>Désamorcer:</b> ".$data_Element['desamorcer']."</p>
                                            </div>
                                            </div>
                                            $value</td>";
                                    $mis = TRUE;
                                }
                            }
                            else
                            {
                                $requete = "SELECT * FROM Element NATURAL JOIN Mobilier 
                                            WHERE idElement = ".$value." && idElement_1_1 = ".$value.";";
                                $data_Element = mysqli_query($connexion, $requete);
                                $data_Element = mysqli_fetch_assoc($data_Element);
                                if ( $data_Element != NULL )
                                {
                                    if ( $data_Element['cheminImage'] == NULL && $data_Element['cheminImage'] == "" )
                                    {
                                        echo "  <td class='w3-brown w3-dropdown-hover w3-border'>
                                                <div class='w3-dropdown-content w3-card-4' style='width:200px'>
                                                <div class='w3-container'>
                                                <p><b>ID:</b> $value</p>
                                                <p><b>Nom:</b> ".$data_Element['nom']."</p>
                                                <p><b>Déplaçable:</b> ".$data_Element['deplacable']."</p>
                                                <p><b>Dimensions:</b> ".$data_Element['dimension']."</p>
                                                </div>
                                                </div>
                                                $value</td>";
                                        $mis = TRUE;
                                    }
                                    else
                                    {
                                        echo "  <td class='w3-brown w3-dropdown-hover w3-border'>
                                                <div class='w3-dropdown-content w3-card-4' style='width:200px'>
                                                <img src='img/".$data_Element['cheminImage']."' style='width:100%'>
                                                <div class='w3-container'>
                                                <p><b>ID:</b> $value</p>
                                                <p><b>Nom:</b> ".$data_Element['nom']."</p>
                                                <p><b>Déplaçable:</b> ".$data_Element['deplacable']."</p>
                                                <p><b>Dimensions:</b> ".$data_Element['dimension']."</p>
                                                </div>
                                                </div>
                                                $value</td>";
                                        $mis = TRUE;
                                    }
                                }
                            } 
                        }
                    }
                }

                foreach ($id_Etre as $value) // Parcours du tableau $id_Etre pour pouvoir identifer le bon élément 
                {
                    if ($value == $zone[$i][$j])
                    {
                        $requete = "SELECT * FROM Etre NATURAL JOIN Creature 
                                    WHERE idEtre = ".$value." && idEtre_1_1 = ".$value.";";
                        $data_Etre = mysqli_query($connexion, $requete);
                        $data_Etre = mysqli_fetch_assoc($data_Etre);
                        if ( $data_Etre != NULL )
                        {
                            echo "  <td class='w3-black w3-dropdown-hover w3-border'>
                                    <div class='w3-dropdown-content w3-card-4' style='width:200px'>
                                    <div class='w3-container'>
                                    <p><b>ID:</b> $value</p>
                                    <p><b>Nom:</b> ".$data_Etre['nom']."</p>
                                    <p><b>Catégorie:</b> ".$data_Etre['quantiteOr']."</p>
                                    <p><b>Point d'attaque:</b> ".$data_Etre['ptAtt']."</p>
                                    <p><b>Point de vie:</b> ".$data_Etre['pv']."</p>
                                    <p><b>Climat:</b> ".$data_Etre['climat']."</p>
                                    <p><b>Environnement:</b> ".$data_Etre['environnement']."</p>
                                    <p><b>Difficulté:</b> ".$data_Etre['difficulte']."</p>
                                    </div>
                                    </div>
                                    $value</td>";
                            $mis = TRUE;
                        }
                        else
                        {
                            $requete = "SELECT * FROM Etre NATURAL JOIN PNJ 
                                    WHERE idEtre = ".$value." && idEtre_1_1 = ".$value.";";
                            $data_Etre = mysqli_query($connexion, $requete);
                            $data_Etre = mysqli_fetch_assoc($data_Etre);
                            if ( $data_Etre != NULL )
                            {
                                echo "  <td class='w3-red w3-dropdown-hover w3-border'>
                                        <div class='w3-dropdown-content w3-card-4' style='width:200px'>
                                        <div class='w3-container'>
                                        <p><b>ID:</b> $value</p>
                                        <p><b>Nom:</b> ".$data_Etre['nom']."</p>
                                        <p><b>Catégorie:</b> ".$data_Etre['quantiteOr']."</p>
                                        <p><b>Point d'attaque:</b> ".$data_Etre['ptAtt']."</p>
                                        <p><b>Point de vie:</b> ".$data_Etre['pv']."</p>
                                        <p><b>Métier:</b> ".$data_Etre['metierPNJ']."</p>
                                        <p><b>Caractère:</b> ".$data_Etre['caracterePNJ']."</p>
                                        <p><b>Phrase:</b> ".$data_Etre['phraseTypePNJ']."</p>
                                        </div>
                                        </div>
                                        $value</td>";
                                $mis = TRUE;
                            }
                        }
                    }
                }
                
                // Si aucune case n'a été placé auparavant alors cela met une case vide
                if ( $mis != TRUE ) echo "<td class='w3-white w3-border'>X</td>";
                else $mis = FALSE;

            }
            echo "</tr>";
        }
        echo '</table>';
        echo "</div>";
        echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
    }
   
?>