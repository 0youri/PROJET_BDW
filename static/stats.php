<?php
    include('controller/controllerStats.php');
?>

<div class="w3-sidebar w3-bar-block w3-animate-left" style="width:500px;display:none;z-index:5" id="mySidebar">
    <button class="w3-button w3-xlarge w3-right" onclick="closeStats()">×</button>
    <p class="w3-bar-item w3-center"><u> STATISTIQUES</u></p>
    <p class="w3-bar-item">Nombre de cartes générées par contributrice:
        <button onclick="afficherTabStats('nbCC')" class="w3-button "><i class="fa fa-caret-down w3-large"></i></button>
        <div style="width:100%" id="nbCC" class="w3-container w3-hide">
            <table class="w3-table-all">
                <tr class="w3-black">
                    <th>#</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Nombre</th>
                </tr>
                <?php
                    // Affichage des tableaux avec les données récupérées de bdd
                    while ( $contributrice = mysqli_fetch_assoc($data_Contributrice) )
                    {
                        $nb = 0;
                        echo "<tr>";
                        echo "<td>".$contributrice['idContributrice']."</td>";
                        echo "<td>".$contributrice['nom']."</td>";
                        echo "<td>".$contributrice['prenom']."</td>";
                        while ( $CONTRIBUE = mysqli_fetch_assoc($data_CONTRIBUE) )
                        {
                            if ( $CONTRIBUE['idContributrice'] == $contributrice['idContributrice'] && $CONTRIBUE['type'] == "création" ) 
                            {
                                $nb++;
                            }
                        }
                        $requete = "SELECT idCarte, idContributrice, type FROM CONTRIBUE";
	                    $data_CONTRIBUE = mysqli_query($connexion, $requete);
                        echo "<td>".$nb."</td>";
                        echo "</tr>";
                    }
                ?>
            </table>
        </div>
    </p>
    <p class="w3-bar-item">Nombre d'Être: <?php $nb_Etre = mysqli_fetch_assoc($nb_Etre); echo $nb_Etre['count(idEtre)']; ?>
        <button onclick="afficherTabStats('nbEtre')" class="w3-button "><i class="fa fa-caret-down w3-large"></i></button>
        <div style="width:100%" id="nbEtre" class="w3-container w3-hide">
            <table class="w3-table-all">
                <tr class="w3-black">
                    <th>Nom</th>
                    <th>Nombre</th>
                </tr>
                <?php
                    $nb_Creature = mysqli_fetch_assoc($nb_Creature);
                    $nb_PNJ = mysqli_fetch_assoc($nb_PNJ);
                    echo "<tr>";
                    echo "<td>Créature</td>";
                    echo "<td>".$nb_Creature['count(idEtre_1_1)']."</td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td>PNJ</td>";
                    echo "<td>".$nb_PNJ['count(idEtre_1_1)']."</td>";
                    echo "</tr>";
                ?>
            </table>
        </div>
    </p>
    <p class="w3-bar-item">Nombre d'Éléments: <?php $nb_Element = mysqli_fetch_assoc($nb_Element); echo $nb_Element['count(idElement)']; ?>
        <button onclick="afficherTabStats('nbElement')" class="w3-button "><i class="fa fa-caret-down w3-large"></i></button>
        <div style="width:100%" id="nbElement" class="w3-container w3-hide">
            <table class="w3-table-all">
                <tr class="w3-black">
                    <th>Nom</th>
                    <th>Nombre</th>
                </tr>
                <?php
                    $nb_Piege = mysqli_fetch_assoc($nb_Piege);
                    $nb_Mobilier = mysqli_fetch_assoc($nb_Mobilier);
                    $nb_Equipement = mysqli_fetch_assoc($nb_Equipement);
                    echo "<tr>";
                    echo "<td>Piège</td>";
                    echo "<td>".$nb_Piege['count(idElement_1_1)']."</td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td>Mobilier</td>";
                    echo "<td>".$nb_Mobilier['count(idElement_1_1)']."</td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td>Equipement</td>";
                    echo "<td>".$nb_Equipement['count(idElement_1_1)']."</td>";
                    echo "</tr>";
                ?>
            </table>
        </div>
    </p>
   </div>
   <div class="w3-overlay w3-animate-opacity" onclick="closeStats()" style="cursor:pointer" id="myOverlay"></div>
    
    <button class="w3-button w3-xxlarge fa " onclick="openStats()">&#xf0ce;</button>
</div>