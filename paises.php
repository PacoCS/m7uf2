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
    $resultat2 = mysqli_query($conn, $consulta);


 		# (2.3) si no hi ha resultat (0 files o bé hi ha algun error a la sintaxi)
 		#     posem un missatge d'error i acabem (die) l'execució de la pàgina web
 		if (!$resultat) {
     			$message  = 'Consulta invàlida: ' . mysqli_error() . "\n";
     			$message .= 'Consulta realitzada: ' . $consulta;
     			die($message);
 		}
    if (!$resultat2) {
     			$message  = 'Consulta invàlida: ' . mysqli_error() . "\n";
     			$message .= 'Consulta realitzada: ' . $consulta;
     			die($message);
 		}

 	?>

  <form action='action_page.php' method='POST'>
  <select name='cd'style='display: inline; margin-bottom: 10px;>
 	<?php
 		# (3.2) Bucle while
 		while( $registre = mysqli_fetch_assoc($resultat) )
 		{
 			echo "<option value='" . $registre['code'] . "'>". $registre['name'] . "</option>";
 		}
  ?>
 	</select>
 	<br>
 	<input type='submit'>
 	</form>

  <?php
  for ($i=0; $i < 4; $i++) {
    echo "<br>";
  }
  ?>

  <h4>Afegeix una ciutat!</h4>
  <form action='' method='POST'>
  <div style='display: block'>
  Nom de la ciutat:
  <input type='text' name='nameCity' style='display: inline; margin-bottom: 10px;' value=''>
  </div>
  <div style='display: block; margin-bottom: 10px;'>
  Pais:
  <select name='nameCountry' style='margin-bottom: 10px;' value=''>
  </div>
  <?php

  # (3.2) Bucle while
  echo "<option value='' selected disabled hidden> Elige un país</option>";
  while( $registre = mysqli_fetch_assoc($resultat2) )
  {
    echo "<option value='" . $registre['code'] . "'>". $registre['name'] . "</option>";
  }
  ?>
  </select>
  <div style='display: block; margin-bottom: 10px;'>
  Població
  <input type='text' name='numPopulation' value=''>
  </div>
  <input type='submit'>
  </form>

  <?php
  if(isset($_POST['nameCity']) && isset($_POST['nameCountry']) && isset($_POST['numPopulation'])){

    $insert = "insert into city (Name, CountryCode, Population) values ('".$_POST['nameCity']."', '".$_POST['nameCountry']."', ".$_POST['numPopulation'].");";

    mysqli_query($conn, $insert);

    unset($_POST['nameCity']);
    unset($_POST['nameCountry']);
    unset($_POST['numPopulation']);
  }
  ?>






</body>
</html>
