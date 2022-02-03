<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
<head>
  	<title>Page listant les personnes de la base</title>
  	<link rel="stylesheet" href="style3.css">
 	<meta charset="UTF-8"> 
</head>
<style>
	body 
	{
	  background-color: #d4f7b6;
	}
	table, th, td 
	{
	  border: 1px solid black;
	  padding: 5px;
	}
	table 
	{
	  border-spacing: 15px;
	}
</style>

<body>
   <center>


	<h1> Partie V : </h1>

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
		// Requetes de tri en utilisant inner join par la suite on stock les resulats dans les tableaux reslut, result1 et result2
	  	$query  = "SELECT instance_materiel.idinstance_materiel,instance_materiel.ean13, instance_materiel.poids,tm_raspberry.addr_mac,tm_raspberry.addr_ip
	                   FROM tm_raspberry INNER JOIN instance_materiel ON tm_raspberry.instance_materiel_idinstance_materiel =instance_materiel.idinstance_materiel";
		$result = query_database($query);
		$query1 = "SELECT instance_materiel.idinstance_materiel,instance_materiel.ean13,instance_materiel.poids,tm_souris.marque
			   FROM tm_souris INNER JOIN instance_materiel ON tm_souris.instance_materiel_idinstance_materiel =instance_materiel.idinstance_materiel";
	  	$result1 = query_database($query1);
		$query2  = " SELECT instance_materiel.idinstance_materiel,instance_materiel.ean13, instance_materiel.poids,tm_cable.longueur
			   FROM tm_cable INNER JOIN instance_materiel ON tm_cable.instance_materiel_idinstance_materiel=instance_materiel.idinstance_materiel";
	  	$result2 = query_database($query2);
	?>
  
	<table>
	<tr>
		<th>IDinstance_materiel</th>
		<th>EAN13</th>
		<th>Poids</th>
		<th>Longueur/Add_MAC/Marque</th>
		<th>Add_IP</th>
	</tr>
  
	<?php
                // print et affichage des tableaux [ l'enregistrement correspend à j]
	  	for ($j = 0 ; $j < $result[0] ; ++$j)
	  	{
	    		echo "<tr>"; 
				echo "<td>"; echo $result[1][$j][0]; echo "</td>"; 
				echo "<td>"; echo utf8_encode($result[1][$j][1]); echo "</td>"; 
				echo "<td>"; echo utf8_encode($result[1][$j][2]); echo "</td>"; 
		                echo "<td>"; echo utf8_encode($result[1][$j][3]); echo "</td>";
		                echo "<td>"; echo utf8_encode($result[1][$j][4]); echo "</td>";
	    		echo "</tr>";
	  	}
		for ($j = 0 ; $j < $result1[0] ; ++$j)
	  	{
	    		echo "<tr>"; 
				echo "<td>"; echo $result1[1][$j][0]; echo "</td>"; 
				echo "<td>"; echo utf8_encode($result1[1][$j][1]); echo "</td>"; 
				echo "<td>"; echo utf8_encode($result1[1][$j][2]); echo "</td>"; 
		                echo "<td>"; echo utf8_encode($result1[1][$j][3]); echo "</td>"; 
	    		echo "</tr>";
	  	}
		for ($j = 0 ; $j < $result2[0] ; ++$j)
	  	{
	    		echo "<tr>"; 
				echo "<td>"; echo $result2[1][$j][0]; echo "</td>"; 
				echo "<td>"; echo utf8_encode($result2[1][$j][1]); echo "</td>"; 
				echo "<td>"; echo utf8_encode($result2[1][$j][2]); echo "</td>"; 
		echo "<td>"; echo utf8_encode($result1[1][$j][3]); echo "</td>"; 
	    		echo "</tr>";
	  	}
?>

	</table>
  </center>
</body>
</html>
