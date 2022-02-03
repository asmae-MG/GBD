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

	table, th, td {
	  border: 1px solid black;
	  padding: 5px;
	}
	table {
	  border-spacing: 15px;
	}
</style>

<body>
  <center>
	<h1>  Liste des personnes:</h1>
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

	if(($_SERVER["REQUEST_METHOD"] ?? "POST") == "POST")

 		{
			//recupére la promo selectionnée
	                $value_id = $_POST['idpromo']; 
			//la selection de homme pour la promo choisi
			if ( $value_id && isset($_POST['genre1']))
			{
			 $query  = "SELECT * FROM personne WHERE promo_idpromo= $value_id and sexe=1" ;
			 $result = query_database($query);
			}
			//la selection de femme pour la promo choisi 
			if ( $value_id && isset($_POST['genre2']))
			{
			 $query  = "SELECT * FROM personne WHERE promo_idpromo= $value_id and sexe=2" ;
			 $result = query_database($query);
			}
                        //la selection des deux genres pour la promo choisi 
			if ( $value_id && isset($_POST['genre2']) && isset($_POST['genre1']))
			{
			 $query  = "SELECT * FROM personne WHERE promo_idpromo= $value_id" ;
			 $result = query_database($query);
			} 

		}
   
	?>
  

	<table>
		<tr>
			<th>idpersonne</th>
			<th>prénom</th>
			<th>nom</th>
		</tr>
		<?php
		  	for ($j = 0 ; $j < $result[0] ; ++$j)
		  	{
                                //Affichage des personnes
		    		echo "<tr>"; 
					echo "<td>"; echo $result[1][$j][0]; echo "</td>"; 
					echo "<td>"; echo utf8_encode($result[1][$j][1]); echo "</td>"; 
					echo "<td>"; echo utf8_encode($result[1][$j][2]); echo "</td>"; 
		    		echo "</tr>";
		  	}
		?>
	</table>
	
  </center>
</body>
</html>
