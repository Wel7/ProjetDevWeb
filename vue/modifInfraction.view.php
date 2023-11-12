<!DOCTYPE html>
<html>

<head>
	<title>Modifier une infraction</title>
	<link rel="stylesheet" type="text/css" href="../vue/css/infraModifAjout.css">
</head>

<body>
	<h1>Modifier une infraction</h1>
	<form method="POST">
		<label for="nom">Date de l'infraction :</label>
		<input type="date" id="date" name="date" value="<?php echo $dateInf ?>" required><br><br>
		<label for="immat">Numéro d'immatriculation :</label>
		<input type="text" id="immat" name="immat" value="<?php echo $immatInf ?>" required></input><br><br>
		<label for="permis">Numéro de permis :</label>
		<input type="text" id="permis" name="permis" value="<?php echo $permisInf ?>"><br><br>
		<?php
		foreach ($listeDelit as $delit) {
			echo '<input type="checkbox" id="delit" name="delit[]" value="' . $delit->getIdDelit() . '"';
				if (in_array($delit->getIdDelit(), $delitCocher)) {
					echo ' checked';
				}
			echo '> ' . $delit->getNature() . ' (' . $delit->getTarif() . ' €)<br>';
		}
		?>
		<input type="submit" value="Modifier">
		<input type="button" value="Annuler" onclick="window.location.href='infractionListeAdmin.php'" />
	</form>
	
</body>

</html>