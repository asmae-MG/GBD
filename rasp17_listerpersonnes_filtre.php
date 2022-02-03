<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
<head>
	<title>Page listant les personnes de la base</title>
	<link rel="stylesheet" href="style3.css">
	<meta charset="UTF-8"> 
</head>
<style>
	body {
	 background-color: #d4f7b6;
	}
</style>

<body>
  <center>

	<h1>Partie III :</h1>
	<?php
		// Cette fonction, fondamentale, prend en entrée la requête et renvoie
		// un array resultat composé de 2 éléments, le nombre d'enregistrements trouvé resultat[0]
		// et la liste des enregistrements resultat[1]
		// resultat[1][y] permet d'accéder au y ème enregistrement
		// resultat{1][y][x] permet d'accéder à la valeur de la colonne x pour l'enregistrement y
		function query_database($q)
		{    	//verification de la connexion
		       $conn = new mysqli("localhost", "asmae", "sqlpass", "matos3");
		        if ($conn->connect_error) die($conn->connect_error);

		        $query  = $q;
		        $result = $conn->query($query);
		        if (!$result)
		                die ("Database access failed: " . $conn->error);

		        $rows = $result->num_rows;

		        $table_1 = array();
			
		        for ($j = 0 ; $j < $rows ; ++$j)
		        {       //deplacement du pointeur sur la ligne numero j
		                $result->data_seek($j);
				//Recuperation de la ligne
		                $row = $result->fetch_row();
				//Stockage dans la table_1
		                array_push($table_1,$row);
		        }
                        //fermeture de connexion
		        $result->close();
		        $conn->close();
			//La fonction Renvoie le nouveau tableau
		        return array($rows, $table_1);
		}

		//selection des promos
  		$query  = "SELECT * FROM promo where 1";
  		$result = query_database($query);
	?>

	<form method= post action = "rasp17_affiche_promo.php">
	   	 <label for="id_p" > Choisir dans la liste : </label>
		 <select id= "id_p" name ="idpromo">
			   
		      <?php

			  for ($j = 0 ; $j < $result[0] ; ++$j)
			  {    
			   echo '<option value="'.$result[1][$j][0].'">'.$result[1][$j][1].'</option><br/>';
			  }
		      ?>

	    	</select>
                <input type = "submit" name ="submit" value = "Go">


  </center>
 	</form>	
</body>
</html>

while ($j< sizeof($myColumns))
		{
	$colonnes = $myColumns[$j];
	$type_donnees=$myFields[$j];
	echo $query1=" ALTER TABLE  $tmMateriel ADD ( $colonnes $type_donnees NOT NULL) ";   
 	 $j++;
}

