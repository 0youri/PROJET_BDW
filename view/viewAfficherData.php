<!-- Selection de tableau affiché -->
<div class="w3-container w3-content w3-center">
	<select class="w3-center w3-select" id="filtre" onchange="filtreData()" style="width: 150px;">
		<option value="" disabled selected>Choisissez:</option>
		<option value="creature">Créatures</option>
		<option value="piege" >Pièges</option>
		<option value="mobilier" >Mobiliers</option>
		<option value="environnement" >Environnement</option>
	</select>
</div>

<!-- Tableaux -->
<div class="w3-container" id="creature" style="display: none;">
	<br>
	<table class="w3-table-all">
		<tr class='w3-black'>
			<th>#</th>
			<th>Nom</th>
			<th>Catégorie</th>
			<th>Quantité d'Or</th>
			<th>Point d'attaque</th>
			<th>Point de vie</th>
			<th>Climat</th>
			<th>Environnement</th>
			<th>Difficulté</th>
		</tr>
			<?php
                // Affichage des tableaux avec les données récupérées de bdd
				while ( $creature = mysqli_fetch_assoc($data_Creature) ) 
				{
					echo "<tr>";
					while ( $etre = mysqli_fetch_assoc($data_Etre) )
					{
						if ($etre['idEtre'] == $creature['idEtre_1_1'])
						{
							echo "<td>".$etre['idEtre']."</td>";
							echo "<td>".$etre['nom']."</td>";
							echo "<td>".$etre['categorie']."</td>";
							echo "<td>".$etre['quantiteOr']."</td>";
							echo "<td>".$etre['ptAtt']."</td>";
							echo "<td>".$etre['pv']."</td>";
							echo "<td>".$creature['climat']."</td>";
							echo "<td>".$creature['environnement']."</td>";
							echo "<td>".$creature['difficulte']."</td>";
							break;
						}
					}
					$requete = "SELECT * FROM Etre";
    				$data_Etre = mysqli_query($connexion, $requete);
					echo "</tr>";
				}
			?>
	</table>
	<br><br><br><br>
</div>

<div class="w3-container" id="piege" style="display: none;">
	<br>
	<table class="w3-table-all">
		<tr class="w3-black">
			<th>#</th>
			<th>Nom</th>
			<th>Catégorie</th>
			<th>Zone d'effet</th>
			<th>Détection</th>
			<th>Esquive</th>
			<th>Désamorçage</th>

		</tr>
			<?php
				while ($piege = mysqli_fetch_assoc($data_Piege)) 
				{
					$element = mysqli_fetch_assoc($data_Element);
					echo "<tr>";
					echo "<td>".$element['idElement']."</td>";
					echo "<td>".$element['nom']."</td>";
					if ($element['idElement'] == $piege['idElement_1_1'])
					{
						echo "<td>".$piege['categorie']."</td>";
						echo "<td>".$piege['zoneEffet']."</td>";
						echo "<td>".$piege['detecter']."</td>";
						echo "<td>".$piege['esquiver']."</td>";
						echo "<td>".$piege['desamorcer']."</td>";
					}
					echo "</tr>";
				}
			?>
	</table>
	<br><br><br><br>
</div>

<div class="w3-container" id="mobilier" style="display: none;">
	<br>
	<table class="w3-table-all">
		<tr class="w3-black">
			<th>#</th>
			<th>Nom</th>
			<th>Deplacable</th>
			<th>Dimension</th>
		</tr>
			<?php
				while ($mobilier = mysqli_fetch_assoc($data_Mobilier)) 
				{
					$element = mysqli_fetch_assoc($data_Element);
					echo "<tr>";
					echo "<td>".$element['idElement']."</td>";
					echo "<td>".$element['nom']."</td>";
					if ($element['idElement'] == $mobilier['idElement_1_1'])
					{
						echo "<td>".$mobilier['deplacable']."</td>";
						echo "<td>".$mobilier['dimension']."</td>";
					}
					echo "</tr>";
				}
			?>
	</table>
	<br><br><br><br>
</div>

<div class="w3-container" id="environnement" style="display: none;">
	<br>
	<table class="w3-table-all">
		<tr class="w3-black">
			<th>Nom</th>
			<th>Description</th>
		</tr>
			<?php
				while ($environnement = mysqli_fetch_assoc($data_Environnement)) 
				{
					echo "<tr>";
					echo "<td>".$environnement['nomE']."</td>";
					echo "<td>".$environnement['description']."</td>";
					echo "</tr>";
				}
			?>
	</table>
	<br><br><br><br>
</div>
