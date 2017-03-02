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
<script src="http://code.jquery.com/jquery.min.js"></script>
<script type="text/javascript" src="szukajka.js"></script>
<link rel="stylesheet" href="multiselect.css" type="text/css"/>
</head>


<?php include_once('body.php'); ?>
<div class="well"><h2>Dodawanie nowego artykułu</h2></div>
<div class="container">
	<form role="form" action="dodajartykul.php" method="post">
		<div class="form-group">
			<label for="TYTUL">Tytuł:</label>
			<input type="text" class="form-control" name="TYTUL" placeholder="Podaj tytuł artykułu" required>
		</div>
		
		<div class="form-group">
			<label for="AUTORZY">Wybierz autorów:</label>
			<br/>
			<select id="listaA" name="AUTORZY[]" multiple="multiple">
			<?php
				$zapytanie = mysql_query("SELECT ID, IMIE, NAZWISKO from OSOBY where ROLA='A' OR ROLA='AR' order by IMIE");
				while ($option = mysql_fetch_assoc($zapytanie)){
					echo "<option value=" .$option['ID']. ">" .$option['IMIE']." ".$option['NAZWISKO']. "</option>";
				}
			?>
			</select>
		</div>
		
		<div class="form-group">
			<label for="RECENZENCI">Wybierz recezentów:</label>
			<br/>
			<select id="listaR" name="RECENZENCI[]" multiple="multiple">
			<?php
				$zapytanie = mysql_query('SELECT ID, IMIE, NAZWISKO from OSOBY where ROLA="R" OR ROLA="AR" order by IMIE');
				while ($option = mysql_fetch_assoc($zapytanie)){
					echo "<option value=" .$option['ID']. ">" .$option['IMIE']." ".$option['NAZWISKO']. "</option>";
				}
			?>
			</select>
			<script id="example">
				$('#listaA').multiselect({
				enableClickableOptGroups: true,
				enableFiltering: true
				});
			
				$('#listaR').multiselect({
				enableClickableOptGroups: true,
				enableFiltering: true
				});
			</script>
		</div>
		<div class="form-group">
			<label for="TOM">Wybór tomu:</label>
			<select class="form-control" name="TOM">
			<?php
				$zapytanie = mysql_query("SELECT ID, NUMER, ROK FROM TOM ORDER BY ROK");
				while ($wynik = mysql_fetch_assoc($zapytanie)){
				echo "<option value=" .$wynik['ID']. ">" .$wynik['NUMER']." / ".$wynik['ROK']. "</option>";
				}
			?>
			</select>
		</div>
		<div>
			<button type="submit" name="submit" class="btn btn-primary"><span class="glyphicon glyphicon-check"></span> Dodaj</button>
			<button type="reset" name="reset" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Wyczyść</button>
		</div>	
<?php
	if (isset($_POST['submit'])) {
	
		$TYTUL = $_POST['TYTUL'];
		$AUTORZY = implode(", ", $_POST['AUTORZY']);
		$RECENZENCI = implode(", ", $_POST['RECENZENCI']);
		$TOM = $_POST['TOM'];
		
		$ins = @mysql_query ("INSERT INTO ARTYKULY SET TYTUL = '$TYTUL', ID_TOM = '$TOM', ID_AUTOR = '$AUTORZY', ID_RECENZENTA = '$RECENZENCI'");
		echo "<br><div class='alert alert-success'>
		<a href='/profile.php' class='close' data-dismiss='alert' aria-label='close'><span class='glyphicon glyphicon-ok'></span> OK</a>
		<strong>Sukces!</strong> Wpis został pomyślnie dodany!</div>";
			mysql_close($connection);
	}
?>
	</form>
</div>
</body>
</html>	
		