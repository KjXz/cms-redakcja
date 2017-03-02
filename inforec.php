<?php include('session.php'); ?>

<!DOCTYPE html>
<html lang=pl>
<head>
<title>System zarządzania redakcją czasopism</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
<link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />
<script type="text/javascript" src="szukajka.js"></script>
<link rel="stylesheet" href="multiselect.css" type="text/css"/>
</head>

<?php include_once('body.php'); ?>

<div class="panel panel-default">
<div class="panel-heading"><h2><span class="glyphicon glyphicon-list-alt"></span> Informacje o recenzentach: </h2></div>
<div class="panel-body">
<div class="container">
<form role="form" method="post" action="inforec.php">
<div class="form-group">

<!-- WSZYSCY -->
<label for="listaosobR">Lista wszystkich recenzentów:</label>
	<select class="form-control" name="OSOBYR">
		<?php
			$zapytanie = mysql_query("SELECT ID, IMIE, NAZWISKO FROM OSOBY WHERE ID NOT IN (SELECT RECENZENCI.ID_OSOBA FROM RECENZENCI) AND ROLA LIKE '%R' ORDER BY IMIE");
				while ($wynik = mysql_fetch_assoc($zapytanie)){
					echo "<option value=" .$wynik['ID']. ">" .$wynik['IMIE']. " " .$wynik['NAZWISKO']. "</option>";
				}
		?>
	</select>
	<br />
<button type="submit" name="showrec" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-search"></span> Wyświetl</button>
<button type="submit" name="editrec" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil"></span> Wprowadź</button>

<!--ZIELONI-->
<hr />
<button type="button" class="btn btn-success btn-block" data-toggle="collapse" data-target="#ZIEL"><b>Udana współpraca</b></button>
<div id="ZIEL" class="panel-collapse collapse">
<br />
<label for="ZIEL">Wybierz osobę:</label>
	<select class="form-control" name="ZIEL">
		<?php
			$zapytanie2 = mysql_query("SELECT OSOBY.ID, OSOBY.IMIE, OSOBY.NAZWISKO from OSOBY INNER JOIN RECENZENCI ON OSOBY.ID = RECENZENCI.ID_OSOBA WHERE RECENZENCI.WSPOLPRACA = 0");
				while ($wynik2 = mysql_fetch_assoc($zapytanie2)){
					echo "<option value=" .$wynik2['ID']. ">" .$wynik2['IMIE']. " " .$wynik2['NAZWISKO']. "</option>";
						}
		?>
	</select>
	<br />
<button type="submit" name="showziel" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-search"></span> Wyświetl</button>
<button type="submit" name="editziel" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-pencil"></span> Edycja</button>
<button type="submit" name="delforziel" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-trash"></span> Usuń z tej listy</button>
</div>

<!-- CZERWONI -->
<hr />
<button type="button" class="btn btn-danger btn-block" data-toggle="collapse" data-target="#CZERW"><b>Nieudana współpraca</b></button>
<div id="CZERW" class="panel-collapse collapse">
<br />
<label for="CZERW">Wybierz osobę:</label>
	<select class="form-control" name="CZERW">
		<?php
			$zapytanie3 = mysql_query("SELECT OSOBY.ID, OSOBY.IMIE, OSOBY.NAZWISKO from OSOBY INNER JOIN RECENZENCI ON OSOBY.ID = RECENZENCI.ID_OSOBA WHERE RECENZENCI.WSPOLPRACA = 1");
				while ($wynik3 = mysql_fetch_assoc($zapytanie3)){
					echo "<option value=" .$wynik3['ID']. ">" .$wynik3['IMIE']. " " .$wynik3['NAZWISKO']. "</option>";
						}
		?>
	</select>
	<br />
<button type="submit" name="showred" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-search"></span> Wyświetl</button>
<button type="submit" name="editred" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-pencil"></span> Edycja</button>
<button type="submit" name="delforred" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-trash"></span> Usuń z tej listy</button>

</div>

<!-- NIEBIESCY -->
<hr />
<button type="button" class="btn btn-primary btn-block" data-toggle="collapse" data-target="#BLUE"><b>Brak odpowiedzi</b></button>
<div id="BLUE" class="panel-collapse collapse">
<br />
<label for="BLUE">Wybierz osobę:</label>
	<select class="form-control" name="BLUE">
		<?php
			$zapytanie4 = mysql_query("SELECT OSOBY.ID, OSOBY.IMIE, OSOBY.NAZWISKO from OSOBY INNER JOIN RECENZENCI ON OSOBY.ID = RECENZENCI.ID_OSOBA WHERE RECENZENCI.WSPOLPRACA = 2");
				while ($wynik4 = mysql_fetch_assoc($zapytanie4)){
					echo "<option value=" .$wynik4['ID']. ">" .$wynik4['IMIE']. " " .$wynik4['NAZWISKO']. "</option>";
						}
		?>
	</select>
	<br />
<button type="submit" name="showblue" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-search"></span> Wyświetl</button>
<button type="submit" name="editblue" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil"></span> Edycja</button>
<button type="submit" name="delforblue" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-trash"></span> Usuń z tej listy</button>

</div>
</div>
</div>
</div>
</div>

<!-- WYSWIETLANIE Z LISTY WSZYSTKICH RECENZENTÓW -->
<?php
if (isset($_POST['showrec'])) {
	$name = mysql_query("SELECT ID, IMIE, NAZWISKO FROM OSOBY WHERE ID = '$_POST[OSOBYR]'");
	echo "<div class='panel panel-info'>
		  <div class='panel-heading'><h3><span class='glyphicon glyphicon-search'>
		  </span> "; while ($selectname = mysql_fetch_assoc($name)){echo $selectname['IMIE']. " " .$selectname['NAZWISKO'];}
	echo "</h3></div>";
	echo "<div class='panel-body'>";
		  
	$inforec = mysql_query("SELECT ID, ID_OSOBA, DATA_ZAPYTANIA, DATA_ODPOWIEDZI, WSPOLPRACA FROM RECENZENCI WHERE ID_OSOBA = '$_POST[OSOBYR]'");	  
		while($showinforec = mysql_fetch_assoc($inforec)){
			echo $showinforec['ID_OSOBA'];
			echo "<h4>Data zapytania: <b>" .$showinforec['DATA_ZAPYTANIA']. "</b><hr />";
			echo "Data odpowiedzi: <b>" .$showinforec['DATA_ODPOWIEDZI']. "</b><hr />";
			echo "Udana współpraca: <b>";
			if ($showinforec['WSPOLPRACA'] == "0")
			{
				echo "Tak</h4></b>";
			}
			if ($showinforec['WSPOLPRACA'] == "1")
			{
				echo "Nie</h4></b>";
			}
			if ($showinforec['WSPOLPRACA'] == "2")
			{
				echo "Oczekujący</h4></b>";
			}
		}

	echo "</div>";		
	echo "</div";
}
?>

<!-- EDYCJA Z LISTYCH ZIELONYCH -->
<?php 
if (isset($_POST['editziel'])) {
	$nameedit = mysql_query("SELECT ID, IMIE, NAZWISKO FROM OSOBY WHERE ID = '$_POST[ZIEL]'");
	echo "<div class='panel panel-success'>
		  <div class='panel-heading'><h3><span class='glyphicon glyphicon-pencil'>
		  </span> "; while ($selectnameedit = mysql_fetch_assoc($nameedit)){echo $selectnameedit['IMIE']. " " .$selectnameedit['NAZWISKO'];}
	echo "</h3></div>";
	echo "<div class='panel-body'>";
	
	echo "<form role='form' method='post' action='inforec.php'>";
	$inforec = mysql_query("SELECT ID, ID_OSOBA, DATA_ZAPYTANIA, DATA_ODPOWIEDZI, WSPOLPRACA FROM RECENZENCI WHERE ID_OSOBA = '$_POST[ZIEL]'");
		while ($editinfog = mysql_fetch_array($inforec)){
			
			echo "<input type='hidden' name='ID' value='$editinfog[ID]'>";
			
			echo "<input type='hidden' name='ID_OSOBA' value='$editinfog[ID_OSOBA]'>";
			
			echo "<div class='form-group'>
				  <label for='DATAZAP'>Data zapytania: </label>
				  <input type='text' class='form-control' name='DATA_ZAPYTANIA' value='$editinfog[DATA_ZAPYTANIA]'>
				  </div>";
				  
			echo "<div class='form-group'>
				  <label for='DATAODP'>Data odpowiedzi: </label>
				  <input type='text' class='form-control' name='DATA_ODPOWIEDZI' value='$editinfog[DATA_ODPOWIEDZI]'>
				  </div>";
			
			echo "<div class='form-group'>
				 <label for='WSPOLPRACA'>Udana współpraca:</label><br/>";
				if ($editinfog['WSPOLPRACA'] == "0"){
					echo "<label class='radio-inline'><input type='radio' name='WSPOLPRACA' value='0' checked>Tak</label><br />";
					echo "<label class='radio-inline'><input type='radio' name='WSPOLPRACA' value='1'>Nie</label><br />";
					echo "<label class='radio-inline'><input type='radio' name='WSPOLPRACA' value='2'>Oczekujący</label>";
				 }
				 if ($editinfog['WSPOLPRACA'] == "1"){
					echo "<label class='radio-inline'><input type='radio' name='WSPOLPRACA' value='0'>Tak</label><br />";
					echo "<label class='radio-inline'><input type='radio' name='WSPOLPRACA' value='1' checked>Nie</label><br />";
					echo "<label class='radio-inline'><input type='radio' name='WSPOLPRACA' value='2'>Oczekujący</label>";
				 }
				 if ($editinfog['WSPOLPRACA'] == "2"){
					echo "<label class='radio-inline'><input type='radio' name='WSPOLPRACA' value='0'>Tak</label><br />";
					echo "<label class='radio-inline'><input type='radio' name='WSPOLPRACA' value='1'>Nie</label><br />";
					echo "<label class='radio-inline'><input type='radio' name='WSPOLPRACA' value='2' checked>Oczekujący</label>";
				 }
			echo "</div>";
			
			echo "<button type='submit' name='saveziel' class='btn btn-success'><span class='glyphicon glyphicon-thumbs-up'></span> Zapisz zmiany</button>
				  <button type='submit' class='btn btn-info'><span class='glyphicon glyphicon-thumbs-down'></span> Anuluj</button>";
				  
		}
	echo "</form>";	
	echo "</div>";	
	echo "</div>";	
}

if (isset($_POST['saveziel'])) {
	$DATA_ZAPYTANIA = strip_tags($_POST['DATA_ZAPYTANIA']);
	$DATA_ODPOWIEDZI = strip_tags($_POST['DATA_ODPOWIEDZI']);
	$WSPOLPRACA = strip_tags($_POST['WSPOLPRACA']);
	$ID = strip_tags($_POST['ID']);
	
	$saveziel = mysql_query("UPDATE RECENZENCI SET DATA_ZAPYTANIA = '$DATA_ZAPYTANIA', DATA_ODPOWIEDZI = '$DATA_ODPOWIEDZI', WSPOLPRACA='$WSPOLPRACA' WHERE ID = '$ID'");
		echo "<br><div class='alert alert-success'>
		<a href='/inforec.php' class='close' data-dismiss='alert' aria-label='close'><span class='glyphicon glyphicon-ok'></span> OK</a>
		<strong>Sukces!</strong> Wpis został pomyślnie zaktualizowany!</div>";
	
}
?>

<!-- WPROWADŹ Z WSZYSTKICH RECENZENTÓW -->
<?php
if (isset($_POST['editrec'])) {
	$nameinsert = mysql_query("SELECT ID, IMIE, NAZWISKO FROM OSOBY WHERE ID = '$_POST[OSOBYR]'");
	echo "<div class='panel panel-primary'>
		  <div class='panel-heading'><h3><span class='glyphicon glyphicon-pencil'>
		  </span> "; while ($insert = mysql_fetch_assoc($nameinsert)){echo $insert['IMIE']. " " .$insert['NAZWISKO'];}
	echo "</h3></div>";
	echo "<div class='panel-body'>";
	echo "<form role='form' method='post' action='inforec.php'>";
	
	$select = mysql_query ("SELECT ID FROM OSOBY WHERE ID = '$_POST[OSOBYR]'");
	while ($inslect = mysql_fetch_assoc($select)){
	echo "<input type='hidden' name='ID' value='$inslect[ID]'>";}
	
	echo "<div class='form-group'>
		  <label for='DATAZAP'>Data zapytania: </label>
		  <input type='text' class='form-control' name='DATA_ZAPYTANIA'>
		  </div>";
				  
	echo "<div class='form-group'>
		  <label for='DATAODP'>Data odpowiedzi: </label>
		  <input type='text' class='form-control' name='DATA_ODPOWIEDZI'>
		  </div>";
			
	echo "<div class='form-group'>
		  <label for='WSPOLPRACA'>Udana współpraca:</label><br/>
		   <label class='radio-inline'><input type='radio' name='WSPOLPRACA' value='0'>Tak</label><br />
		   <label class='radio-inline'><input type='radio' name='WSPOLPRACA' value='1'>Nie</label><br />
		   <label class='radio-inline'><input type='radio' name='WSPOLPRACA' value='2'>Oczekujący</label>
		   </div>";
		   
	echo "<button type='submit' name='saveblue' class='btn btn-primary'><span class='glyphicon glyphicon-thumbs-up'></span> Zapisz zmiany</button>
		  <button type='submit' class='btn btn-danger'><span class='glyphicon glyphicon-thumbs-down'></span> Anuluj</button>";
	
	echo "</form>";
	echo "</div>";
	echo "</div>";
}

if (isset($_POST['saveblue'])) {
	$DATA_ZAPYTANIA = strip_tags($_POST['DATA_ZAPYTANIA']);
	$DATA_ODPOWIEDZI = strip_tags($_POST['DATA_ODPOWIEDZI']);
	$WSPOLPRACA = strip_tags($_POST['WSPOLPRACA']);
	$ID = strip_tags($_POST['ID']);
	
	$ins = mysql_query("INSERT INTO RECENZENCI SET ID_OSOBA = '$ID', DATA_ZAPYTANIA = '$DATA_ZAPYTANIA', DATA_ODPOWIEDZI = '$DATA_ODPOWIEDZI', WSPOLPRACA='$WSPOLPRACA'");
	echo "<br><div class='alert alert-success'>
		  <a href='/inforec.php' class='close' data-dismiss='alert' aria-label='close'><span class='glyphicon glyphicon-ok'></span> OK</a>
		  <strong>Sukces!</strong> Wpis został pomyślnie zaktualizowany!</div>";	
}

?>

<!-- WYŚWIETALNIE ZIEL -->
<?php 
if (isset($_POST['showziel'])) {
	$name = mysql_query("SELECT ID, IMIE, NAZWISKO FROM OSOBY WHERE ID = '$_POST[ZIEL]'");
	echo "<div class='panel panel-success'>
		  <div class='panel-heading'><h3><span class='glyphicon glyphicon-search'>
		  </span> "; while ($selectname = mysql_fetch_assoc($name)){echo $selectname['IMIE']. " " .$selectname['NAZWISKO'];}
	echo "</h3></div>";
	echo "<div class='panel-body'>";
		  
	$inforec = mysql_query("SELECT ID, ID_OSOBA, DATA_ZAPYTANIA, DATA_ODPOWIEDZI, WSPOLPRACA FROM RECENZENCI WHERE ID_OSOBA = '$_POST[ZIEL]'");	  
		while($showinforec = mysql_fetch_assoc($inforec)){
			echo "<h4>Data zapytania: <b>" .$showinforec['DATA_ZAPYTANIA']. "</b><hr />";
			echo "Data odpowiedzi: <b>" .$showinforec['DATA_ODPOWIEDZI']. "</b><hr />";
			echo "Udana współpraca: <b>";
			if ($showinforec['WSPOLPRACA'] == "0")
			{
				echo "Tak</h4></b>";
			}
			if ($showinforec['WSPOLPRACA'] == "1")
			{
				echo "Nie</h4></b>";
			}
			if ($showinforec['WSPOLPRACA'] == "2")
			{
				echo "Oczekujący</h4></b>";
			}
		}
		
	echo "</div>";
	echo "</div>";
}
?>

<!-- WYSWIETLANIE RED -->
<?php 
if (isset($_POST['showred'])) {
	$namered = mysql_query("SELECT ID, IMIE, NAZWISKO FROM OSOBY WHERE ID = '$_POST[CZERW]'");
	echo "<div class='panel panel-danger'>
		  <div class='panel-heading'><h3><span class='glyphicon glyphicon-search'>
		  </span> "; while ($selectnamer = mysql_fetch_assoc($namered)){echo $selectnamer['IMIE']. " " .$selectnamer['NAZWISKO'];}
	echo "</h3></div>";
	echo "<div class='panel-body'>";
		  
	$inforecr = mysql_query("SELECT ID, ID_OSOBA, DATA_ZAPYTANIA, DATA_ODPOWIEDZI, WSPOLPRACA FROM RECENZENCI WHERE ID_OSOBA = '$_POST[CZERW]'");	  
		while($showinforecr = mysql_fetch_assoc($inforecr)){
			echo "<h4>Data zapytania: <b>" .$showinforecr['DATA_ZAPYTANIA']. "</b><hr />";
			echo "Data odpowiedzi: <b>" .$showinforecr['DATA_ODPOWIEDZI']. "</b><hr />";
			echo "Udana współpraca: <b>";
			if ($showinforecr['WSPOLPRACA'] == "0")
			{
				echo "Tak</h4></b>";
			}
			if ($showinforecr['WSPOLPRACA'] == "1")
			{
				echo "Nie</h4></b>";
			}
			if ($showinforecr['WSPOLPRACA'] == "2")
			{
				echo "Oczekujący</h4></b>";
			}
		}
		
	echo "</div>";
	echo "</div>";
}
?>

<!-- WYSWIETLANIE BLUE -->
<?php 
if (isset($_POST['showblue'])) {
	$nameblue = mysql_query("SELECT ID, IMIE, NAZWISKO FROM OSOBY WHERE ID = '$_POST[BLUE]'");
	echo "<div class='panel panel-primary'>
		  <div class='panel-heading'><h3><span class='glyphicon glyphicon-search'>
		  </span> "; while ($selectnameb = mysql_fetch_assoc($nameblue)){echo $selectnameb['IMIE']. " " .$selectnameb['NAZWISKO'];}
	echo "</h3></div>";
	echo "<div class='panel-body'>";
		  
	$inforecb = mysql_query("SELECT ID, ID_OSOBA, DATA_ZAPYTANIA, DATA_ODPOWIEDZI, WSPOLPRACA FROM RECENZENCI WHERE ID_OSOBA = '$_POST[BLUE]'");	  
		while($showinforecb = mysql_fetch_assoc($inforecb)){
			echo "<h4>Data zapytania: <b>" .$showinforecb['DATA_ZAPYTANIA']. "</b><hr />";
			echo "Data odpowiedzi: <b>" .$showinforecb['DATA_ODPOWIEDZI']. "</b><hr />";
			echo "Udana współpraca: <b>";
			if ($showinforecb['WSPOLPRACA'] == "0")
			{
				echo "Tak</h4></b>";
			}
			if ($showinforecb['WSPOLPRACA'] == "1")
			{
				echo "Nie</h4></b>";
			}
			if ($showinforecb['WSPOLPRACA'] == "2")
			{
				echo "Oczekujący</h4></b>";
			}
		}
		
	echo "</div>";
	echo "</div>";
}
?>

<!-- EDYCJA Z LISTYCH CZERWONYCH -->
<?php 
if (isset($_POST['editred'])) {
	$namerededit = mysql_query("SELECT ID, IMIE, NAZWISKO FROM OSOBY WHERE ID = '$_POST[CZERW]'");
	echo "<div class='panel panel-danger'>
		  <div class='panel-heading'><h3><span class='glyphicon glyphicon-pencil'>
		  </span> "; while ($selectred = mysql_fetch_assoc($namerededit)){echo $selectred['IMIE']. " " .$selectred['NAZWISKO'];}
	echo "</h3></div>";
	echo "<div class='panel-body'>";
	
	echo "<form role='form' method='post' action='inforec.php'>";
	$infored = mysql_query("SELECT ID, ID_OSOBA, DATA_ZAPYTANIA, DATA_ODPOWIEDZI, WSPOLPRACA FROM RECENZENCI WHERE ID_OSOBA = '$_POST[CZERW]'");
		while ($editinfo = mysql_fetch_array($infored)){
			
			echo "<input type='hidden' name='ID' value='$editinfo[ID]'>";
			
			echo "<input type='hidden' name='ID_OSOBA' value='$editinfo[ID_OSOBA]'>";
			
			echo "<div class='form-group'>
				  <label for='DATAZAP'>Data zapytania: </label>
				  <input type='text' class='form-control' name='DATA_ZAPYTANIA' value='$editinfo[DATA_ZAPYTANIA]'>
				  </div>";
				  
			echo "<div class='form-group'>
				  <label for='DATAODP'>Data odpowiedzi: </label>
				  <input type='text' class='form-control' name='DATA_ODPOWIEDZI' value='$editinfo[DATA_ODPOWIEDZI]'>
				  </div>";
			
			echo "<div class='form-group'>
				 <label for='WSPOLPRACA'>Udana współpraca:</label><br/>";
				 if ($editinfo['WSPOLPRACA'] == "0"){
					echo "<label class='radio-inline'><input type='radio' name='WSPOLPRACA' value='0' checked>Tak</label><br />";
					echo "<label class='radio-inline'><input type='radio' name='WSPOLPRACA' value='1'>Nie</label><br />";
					echo "<label class='radio-inline'><input type='radio' name='WSPOLPRACA' value='2'>Oczekujący</label>";
				 }
				 if ($editinfo['WSPOLPRACA'] == "1"){
					echo "<label class='radio-inline'><input type='radio' name='WSPOLPRACA' value='0'>Tak</label><br />";
					echo "<label class='radio-inline'><input type='radio' name='WSPOLPRACA' value='1' checked>Nie</label><br />";
					echo "<label class='radio-inline'><input type='radio' name='WSPOLPRACA' value='2'>Oczekujący</label>";
				 }
				 if ($editinfo['WSPOLPRACA'] == "2"){
					echo "<label class='radio-inline'><input type='radio' name='WSPOLPRACA' value='0'>Tak</label><br />";
					echo "<label class='radio-inline'><input type='radio' name='WSPOLPRACA' value='1'>Nie</label><br />";
					echo "<label class='radio-inline'><input type='radio' name='WSPOLPRACA' value='2' checked>Oczekujący</label>";
				 }
			echo "</div>";
			
			echo "<button type='submit' name='savered' class='btn btn-danger'><span class='glyphicon glyphicon-thumbs-up'></span> Zapisz zmiany</button>
				  <button type='submit' class='btn btn-info'><span class='glyphicon glyphicon-thumbs-down'></span> Anuluj</button>";
				  
		}
	echo "</form>";	
	echo "</div>";	
	echo "</div>";	
}

if (isset($_POST['savered'])) {
	$DATA_ZAPYTANIA = strip_tags($_POST['DATA_ZAPYTANIA']);
	$DATA_ODPOWIEDZI = strip_tags($_POST['DATA_ODPOWIEDZI']);
	$WSPOLPRACA = strip_tags($_POST['WSPOLPRACA']);
	$ID = strip_tags($_POST['ID']);
	
	$saveziel = mysql_query("UPDATE RECENZENCI SET DATA_ZAPYTANIA = '$DATA_ZAPYTANIA', DATA_ODPOWIEDZI = '$DATA_ODPOWIEDZI', WSPOLPRACA='$WSPOLPRACA' WHERE ID = '$ID'");
		echo "<br><div class='alert alert-danger'>
		<a href='/inforec.php' class='close' data-dismiss='alert' aria-label='close'><span class='glyphicon glyphicon-ok'></span> OK</a>
		<strong>Sukces!</strong> Wpis został pomyślnie zaktualizowany!</div>";
	
}
?>

<!-- EDYCJA Z LISTYCH NIEBIESKICH -->
<?php 
if (isset($_POST['editblue'])) {
	$nameblueedit = mysql_query("SELECT ID, IMIE, NAZWISKO FROM OSOBY WHERE ID = '$_POST[BLUE]'");
	echo "<div class='panel panel-primary'>
		  <div class='panel-heading'><h3><span class='glyphicon glyphicon-pencil'>
		  </span> "; while ($selectblue = mysql_fetch_assoc($nameblueedit)){echo $selectblue['IMIE']. " " .$selectblue['NAZWISKO'];}
	echo "</h3></div>";
	echo "<div class='panel-body'>";
	
	echo "<form role='form' method='post' action='inforec.php'>";
	$infoblue = mysql_query("SELECT ID, ID_OSOBA, DATA_ZAPYTANIA, DATA_ODPOWIEDZI, WSPOLPRACA FROM RECENZENCI WHERE ID_OSOBA = '$_POST[BLUE]'");
		while ($editinfob = mysql_fetch_array($infoblue)){
			
			echo "<input type='hidden' name='ID' value='$editinfob[ID]'>";
			
			echo "<input type='hidden' name='ID_OSOBA' value='$editinfob[ID_OSOBA]'>";
			
			echo "<div class='form-group'>
				  <label for='DATAZAP'>Data zapytania: </label>
				  <input type='text' class='form-control' name='DATA_ZAPYTANIA' value='$editinfob[DATA_ZAPYTANIA]'>
				  </div>";
				  
			echo "<div class='form-group'>
				  <label for='DATAODP'>Data odpowiedzi: </label>
				  <input type='text' class='form-control' name='DATA_ODPOWIEDZI' value='$editinfob[DATA_ODPOWIEDZI]'>
				  </div>";
			
			echo "<div class='form-group'>
				 <label for='WSPOLPRACA'>Udana współpraca:</label><br/>";
				 if ($editinfob['WSPOLPRACA'] == "0"){
					echo "<label class='radio-inline'><input type='radio' name='WSPOLPRACA' value='0' checked>Tak</label><br />";
					echo "<label class='radio-inline'><input type='radio' name='WSPOLPRACA' value='1'>Nie</label><br />";
					echo "<label class='radio-inline'><input type='radio' name='WSPOLPRACA' value='2'>Oczekujący</label>";
				 }
				 if ($editinfob['WSPOLPRACA'] == "1"){
					echo "<label class='radio-inline'><input type='radio' name='WSPOLPRACA' value='0'>Tak</label><br />";
					echo "<label class='radio-inline'><input type='radio' name='WSPOLPRACA' value='1' checked>Nie</label><br />";
					echo "<label class='radio-inline'><input type='radio' name='WSPOLPRACA' value='2'>Oczekujący</label>";
				 }
				 if ($editinfob['WSPOLPRACA'] == "2"){
					echo "<label class='radio-inline'><input type='radio' name='WSPOLPRACA' value='0'>Tak</label><br />";
					echo "<label class='radio-inline'><input type='radio' name='WSPOLPRACA' value='1'>Nie</label><br />";
					echo "<label class='radio-inline'><input type='radio' name='WSPOLPRACA' value='2' checked>Oczekujący</label>";
				 }
			echo "</div>";
			
			echo "<button type='submit' name='saveblues' class='btn btn-primary'><span class='glyphicon glyphicon-thumbs-up'></span> Zapisz zmiany</button>
				  <button type='submit' class='btn btn-info'><span class='glyphicon glyphicon-thumbs-down'></span> Anuluj</button>";
				  
		}
	echo "</form>";	
	echo "</div>";	
	echo "</div>";	
}

if (isset($_POST['saveblues'])) {
	$DATA_ZAPYTANIA = strip_tags($_POST['DATA_ZAPYTANIA']);
	$DATA_ODPOWIEDZI = strip_tags($_POST['DATA_ODPOWIEDZI']);
	$WSPOLPRACA = strip_tags($_POST['WSPOLPRACA']);
	$ID = strip_tags($_POST['ID']);
	
	$saveblues = mysql_query("UPDATE RECENZENCI SET DATA_ZAPYTANIA = '$DATA_ZAPYTANIA', DATA_ODPOWIEDZI = '$DATA_ODPOWIEDZI', WSPOLPRACA='$WSPOLPRACA' WHERE ID = '$ID'");
		echo "<br><div class='alert alert-info'>
		<a href='/inforec.php' class='close' data-dismiss='alert' aria-label='close'><span class='glyphicon glyphicon-ok'></span> OK</a>
		<strong>Sukces!</strong> Wpis został pomyślnie zaktualizowany!</div>";
	
}
?>

<!-- PORZĄDEK W LISTACH -->
<?php
if (isset($_POST['delforziel'])){
	$delforziel = mysql_query("DELETE FROM RECENZENCI WHERE ID_OSOBA = '$_POST[ZIEL]'");
	echo "<hr />";
		echo "<br><div class='alert alert-success'>
		<a href='/inforec.php' class='close' data-dismiss='alert' aria-label='close'><span class='glyphicon glyphicon-ok'></span> OK</a>
		<strong>Sukces!</strong> Wpis został pomyślnie usunięty!</div>";
}
?>
<?php
if (isset($_POST['delforred'])){
	$delforziel = mysql_query("DELETE FROM RECENZENCI WHERE ID_OSOBA = '$_POST[CZERW]'");
	echo "<hr />";
		echo "<br><div class='alert alert-danger'>
		<a href='/inforec.php' class='close' data-dismiss='alert' aria-label='close'><span class='glyphicon glyphicon-ok'></span> OK</a>
		<strong>Sukces!</strong> Wpis został pomyślnie usunięty!</div>";
}
?>
<?php
if (isset($_POST['delforblue'])){
	$delforziel = mysql_query("DELETE FROM RECENZENCI WHERE ID_OSOBA = '$_POST[BLUE]'");
	echo "<hr />";
		echo "<br><div class='alert alert-info'>
		<a href='/inforec.php' class='close' data-dismiss='alert' aria-label='close'><span class='glyphicon glyphicon-ok'></span> OK</a>
		<strong>Sukces!</strong> Wpis został pomyślnie usunięty!</div>";
}
?>
</form>
</body>
</html>