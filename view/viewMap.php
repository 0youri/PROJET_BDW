<!-- Formulaire de création de la map -->
<div class="w3-white" id="form" style="width:800px; margin: auto; <?php if ($div == "Off") echo "display: none;" ?>">
    <div class="w3-container">
        <section class="w3-card-4">
            <div class="w3-container w3-black"><h2>Formulaire de génération de map:</h2></div>
                <form method="POST" id="form" class="w3-container" action="">
                    <p>
                        <label for="nomMap">Nom:</label>
                        <span class="error" style = "color: #FF0000"><?php echo $nomMapErr;?></span>
                        <input type="text" name="nomMap" id="nomMap" class="w3-input w3-border" placeholder="..." 
                        onfocus="this.placeholder='...'"  onMouseout="this.placeholder='...'" value="<?php echo $nomMap; ?>">
                    </p>
                    <p>
                        <label for="description">Decscription:</label>
                        <input type="text" name="description" id="description" class="w3-input w3-border" placeholder="..." 
                        onfocus="this.placeholder='...'"  onMouseout="this.placeholder='...'">
                    </p>
                    <p>
                        <label for="creator">Contributrice: </label>
                        <span class="error" style = "color: #FF0000"><?php echo $creatorErr;?></span>
                        <select class="w3-select" name="creator" id="creator" style="width: 150px;">
                            <option value="" disabled <?php if ( $creator == "" ) echo "selected";?> >Choisissez:</option>
                            <?php
                                while ( $data = mysqli_fetch_assoc($data_Contributrice) )
                                {
                                    echo '<option value="'.$data['idContributrice'].'"'; ?>
                                    <?php if ($creator == $data['idContributrice']) echo "selected";?>
                                    <?php echo '>#'.$data['idContributrice'].' - '.$data['nom'].' </option>';
                                }
                            ?>
                        </select>
                    </p>
                    <p>
                        <label for="nbZone" >Nombre de zones:</label><br>
                        <span class="error" style = "color: #FF0000"><?php echo $nb_zoneErr;?></span>
                        <input type="number" name="nbzoneMin" id="nbzoneMin" class="w3-half w3-input w3-border" 
                        placeholder="Min" onfocus="this.placeholder='Min'" value="<?php echo $nb_zoneMin; ?>"/>
                        <input type="number" name="nbzoneMax" id="nbzoneMax" class="w3-half w3-input w3-border" 
                        placeholder="Max" onfocus="this.placeholder='Max'" value="<?php echo $nb_zoneMax; ?>" />
                    </p>
                    <br>
                    <p>
                        <label for="dimensionsZone" >Dimensions de zones:</label><br>
                        <span class="error" style = "color: #FF0000"><?php echo $d_zoneErr;?></span>
                        <input type="number" name="minZone" id="minZone" class="w3-half w3-input w3-border" 
                        placeholder="Min" onfocus="this.placeholder='Min'" value="<?php echo $d_zoneMin; ?>"/>
                        <input type="number" name="maxZone" id="maxZone" class="w3-half w3-input w3-border" 
                        placeholder="Max" onfocus="this.placeholder='Max'" value="<?php echo $d_zoneMax; ?>" />
                    </p>
                    <br>
                    <p>
                        <label for="environnement">Environnements: </label>
                        <section class="w3-container w3-padding-large" >
                            <div class="w3-row">
                                <div class="w3-third">
                                    <select class="w3-select" name="environnement" id="environnement" size="12" >
                                        <option value="" class="w3-black w3-center" disabled >Choix:</option>
                                        <?php
                                            while ( $environnementD = mysqli_fetch_assoc($data_Environnement) )
                                            {
                                                echo '<option value="'.$environnementD['nomE'].'" >'.$environnementD['nomE'].'</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class=" w3-third w3-center" style="margin: auto;">
                                    <button type="button" class="w3-button w3-white w3-border" onclick="{Selection();}" > >> Sélectionner >> </button>
                                </div>
                                <div class="w3-third">
                                    <select name="environnement" id= "environnement1" size="12" class="w3-select">
                                        <option value="" class="w3-black w3-center" disabled>Sélectionnés:</option>
                                    </select>
                                </div>
                            </div>
                        </section>
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
                    <p>
                        <label for="objectif">Objectif: </label>
                        <span class="error" style = "color: #FF0000"><?php echo $objectifErr;?></span>
                        <select class="w3-select" name="objectif" id="objectif" style="width: 150px;">
                            <option value="" disabled <?php if ( $objectif == "" ) echo "selected";?> >Choisissez:</option>
                            <option value="zone"  <?php if ( $objectif == "zone" ) echo "selected";?> >Zone</option>
                            <option value="equipement"  <?php if ( $objectif == "equipement" ) echo "selected";?> >Equipement</option>
                        </select>
                    </p>
                    <p class="w3-center">
                        <button type="sumbit" class="w3-button w3-black w3-mobile w3-border">Soumettre</button>
                        <button type="reset" class="w3-button w3-black w3-mobile w3-border">Annuler</button>
                    </p>
                </form>
        </section>
    </div>
    <br><br><br><br>
</div>

<?php
    if ( $div == "Off" )
    {
        echo '<table class="w3-border w3-centered w3-display-middle" style="width:500px; height:500px;" cellspacing="0" cellpadding="0">';
        for ($i = 0; $i < 20; $i++)
        {
            echo "<tr>";
            for ($j = 0; $j < 100; $j++)
            {
                if ( $map[$i][$j] != 0 ) echo "<td class='w3-black w3-border'>".$map[$i][$j]."</td>";
                else echo "<td class='w3-white w3-border'>X</td>";
            }
            echo "</tr>";
        }
        
        
        echo "</table>";
    }

?>