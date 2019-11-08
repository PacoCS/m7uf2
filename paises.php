<html>
 <head>
 	<title>PAISES</title>
 	<style>
 		body{
 		}
 		table,td {
 			border: 1px solid black;
 			border-spacing: 0px;
 		}
 	</style>
 </head>
 
 <body>
 	<h1>Exemple de lectura de dades a MySQL</h1>
 
 	<?php
 		# (1.1) Connectem a MySQL (host,usuari,contrassenya)
 		$conn = mysqli_connect('localhost','paco','Admin1234');
 
 		# (1.2) Triem la base de dades amb la que treballarem
 		mysqli_select_db($conn, 'world');
 
 		# (2.1) creem el string de la consulta (query)
 		$consulta = " select name,code from country";
 
 		# (2.2) enviem la query al SGBD per obtenir el resultat
 		$resultat = mysqli_query($conn, $consulta);
 
 		# (2.3) si no hi ha resultat (0 files o bé hi ha algun error a la sintaxi)
 		#     posem un missatge d'error i acabem (die) l'execució de la pàgina web
 		if (!$resultat) {
     			$message  = 'Consulta invàlida: ' . mysqli_error() . "\n";
     			$message .= 'Consulta realitzada: ' . $consulta;
     			die($message);
 		}
 	?>
 
 	<?php
 		# (3.2) Bucle while
 		echo "<form action='action_page.php' method='POST'>";
 		echo "<select name='cd'>";
 		while( $registre = mysqli_fetch_assoc($resultat) )
 		{
 			
 			echo "<option value='" . $registre['code'] . "'>". $registre['name'] . "</option>";
 			


 			
 		}
 		echo "</select>";
 		echo "<br>";
 		echo "<input type='submit'>";
 		echo "</form>";
 	?>
  	<!-- (3.6) tanquem la taula -->
 		
 </body>
</html>