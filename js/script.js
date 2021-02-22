// Ouverture d'interface de statistiques
function openStats() 
{
	// Afficher interface de statistiques
	document.getElementById("mySidebar").style.display = "block"; 
	document.getElementById("myOverlay").style.display = "block";
}
// Femature d'interface de statistiques
function closeStats()
{
	// Cacher interface de statistiques
	document.getElementById("mySidebar").style.display = "none";
	document.getElementById("myOverlay").style.display = "none";
}


// Ouverture/Fermeture de tableau d'interface de statistiques
function afficherTabStats(id)
{
	let x = document.getElementById(id); // Déclaration de variable avec lien vers ID d'une balise
  	if ( x.className.indexOf("w3-show" ) == -1)	x.className += " w3-show"; // Afficher le tableau grace au framework W3.CSS
  	else x.className = x.className.replace(" w3-show", ""); // Cacher le tableau grace au framework W3.CSS
}

// Filtre qui affiche par catégorie choisie dans select
function filtreData()
{
	let select = document.getElementById("filtre").value; // Récuparation de variable du select d'ID indiqué 
	// Déclaration de variable avec lien vers ID d'une balise
	let creature = document.getElementById("creature");
	let piege = document.getElementById("piege");
	let mobilier = document.getElementById("mobilier");
	let environnement = document.getElementById("environnement");
	
	// Afficher/cacher les tableaux en fonction ce qui a été choisie dans select
	if (select == "creature")
	{
		creature.style.display = "block";
		piege.style.display = "none";
        mobilier.style.display = "none";
		environnement.style.display = "none";
	}
	else if (select == "piege")
	{
		piege.style.display = "block";
		creature.style.display = "none";
        mobilier.style.display = "none";
		environnement.style.display = "none";
	}
	else if (select == "mobilier")
	{
		mobilier.style.display = "block";
        creature.style.display = "none";
		piege.style.display = "none";
		environnement.style.display = "none";
	}
	else if (select == "environnement")
	{
		environnement.style.display = "block";
		mobilier.style.display = "none";
        creature.style.display = "none";
		piege.style.display = "none";
	}	
	else alert("ERREUR");
}


function Selection()
{
	let a = document.getElementById("environnement");
	if (a.selectedIndex != -1)
	{
		a = document.getElementById("environnement1");
		let x = document.createElement("option");
		x.value = document.getElementById("environnement").value;
		x.text = document.getElementById("environnement").value;
		x.selected = true;
		a.add(x);
		a = document.getElementById("environnement");
		let c = a.options[a.selectedIndex];
		a.removeChild(c);
	}
}
