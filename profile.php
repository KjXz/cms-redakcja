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
</head>

<?php include_once('body.php'); ?>

<div class="panel panel-default">
<div class="panel-heading"><h2><span class="glyphicon glyphicon-list-alt"></span> Wyświetl zawartość</h2></div>
<div class="panel-body">
<div class="container">
<form role="form" method="post">
<div class="form-group">

	<button type="button" class="btn btn-info btn-block" data-toggle="collapse" data-target="#cos"><b>Wybierz dostępne tomy</b></button>
	<div id="cos" class="panel-collapse collapse">
	<br />
	<label for="listatomy">Wyszukaj tom: </label>
	<select class="form-control" name="TOM">
		<?php
			$zapytanie = mysql_query("SELECT ID, NUMER, ROK FROM TOM ORDER BY ROK");
			while ($wynik = mysql_fetch_assoc($zapytanie)){
				echo "<option value=" .$wynik['ID']. ">" .$wynik['NUMER'].  " / " .$wynik['ROK']. "</option>";
			}
		?>
	</select>
	<br />
	<button type="submit" name="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span> Szukaj</button>
	<br />
	</div>
	
	<?php
	if (isset($_POST['submit'])) {
	
	$test = @mysql_query("SELECT TYTUL, NUMER, ROK FROM TOM WHERE ID = '$_POST[TOM]'");
		while ($row = mysql_fetch_array($test)){
			echo "<div class='form-group'>";
			echo "<br>";
			echo "<div class='panel panel-info'>";
			echo "<div class='panel-heading'>
			<h3><span class='glyphicon glyphicon-option-vertical'></span> Tytuł: ".$row['TYTUL']. "</h3> 
			</div>";
			
			echo "<div class='panel-body'><h4><span class='glyphicon glyphicon-menu-right'></span><b> Numer:</b> " .$row['NUMER'].	"</h4>";
			echo "<h4><span class='glyphicon glyphicon-menu-right'></span><b> Rok: </b> " .$row['ROK']."</h4>";
			}
	
		echo "<hr />";
		### Dostępne artykuły:
		echo "<div class='panel-body'><h5><span class='glyphicon glyphicon-menu-right'></span> Dostępne artykuły: </h5>";
		echo "<select class='form-control' name='ARTYKULY'>";
				$zapytanie2 = mysql_query("SELECT ID, TYTUL FROM ARTYKULY WHERE ID_TOM = '$_POST[TOM]'");
				while ($wynik2 = mysql_fetch_assoc($zapytanie2)){
					echo "<option value=" .$wynik2['ID']. ">" .$wynik2['TYTUL']. "</option>";
				}
				echo "</select>";
				echo "<br>";
				echo "<button type='submit' name='wyswietl' class='btn btn-primary'><span class='glyphicon glyphicon-search'></span> Wyświetl artykuł</button>";
				echo "</div>";
		}
		
		if (isset($_POST['wyswietl'])) {
				
			$test2 = @mysql_query("SELECT ID_AUTOR, ARTYKULY.TYTUL, OSOBY.IMIE, OSOBY.NAZWISKO FROM ARTYKULY INNER JOIN OSOBY ON ARTYKULY.ID_AUTOR = OSOBY.ID WHERE ARTYKULY.ID = '$_POST[ARTYKULY]'");
			while ($row2 = mysql_fetch_assoc($test2)){
					echo "<br>";
					echo "<div class='panel panel-info'>";
					
					echo "<div class='panel-heading'><h3><span class='glyphicon glyphicon-option-vertical'></span> Tytuł: ".$row2['TYTUL']. "</h3>
					</div>";
					
					echo "<h4><span class='glyphicon glyphicon-list-alt'></span> <b>Autorzy:</b> </h4>";
					$IDAutora = explode(", ", $row2['ID_AUTOR']);
					foreach ($IDAutora as $val){
						$autorzy = @mysql_query ("SELECT IMIE, NAZWISKO FROM OSOBY WHERE ID = '$val'");
						while ($IDA = mysql_fetch_array($autorzy)){
							echo "<div class='panel-info'><h4><span class='glyphicon glyphicon glyphicon-menu-right'></span>".$IDA['IMIE']. " " .$IDA['NAZWISKO']. "</h4></div>";
						}
					}
		echo "<hr />";
		echo "<h4><span class='glyphicon glyphicon-list-alt'></span> <b>Recenzenci:</b> </h4>";
				
				$test3 = mysql_query ("SELECT ID_RECENZENTA, OSOBY.IMIE, OSOBY.NAZWISKO FROM ARTYKULY INNER JOIN OSOBY ON ARTYKULY.ID_RECENZENTA = OSOBY.ID WHERE ARTYKULY.ID = '$_POST[ARTYKULY]'");
				while ($row3 = mysql_fetch_array($test3)){
					$IDRecenzenta = explode(", ", $row3['ID_RECENZENTA']);
					foreach ($IDRecenzenta as $value){
						$test4 = @mysql_query ("SELECT IMIE, NAZWISKO FROM OSOBY WHERE ID = '$value'");
						while ($row4 = mysql_fetch_array($test4)){
							echo "<div class='panel-info'><h4><span class='glyphicon glyphicon glyphicon-menu-right'></span>".$row4['IMIE']. " " .$row4['NAZWISKO']. "</h4></div>";
						}
					}
				}
		echo "<hr />";
		echo "<h4><span class='glyphicon glyphicon-list-alt'></span> <b>Informacje:</b> <br />";
		
				$wszelkiedaty = mysql_query ("SELECT WYSLANA_DO_RECENZJI, DATA_PRZYJECIA, DATA_RECENZJI, DATA_PUBLIKACJI, PRZYJETE_DO_DRUKU FROM ARTYKULY WHERE ARTYKULY.ID = '$_POST[ARTYKULY]'");
				while ($daty = mysql_fetch_assoc($wszelkiedaty)){
					echo "<span class='glyphicon glyphicon glyphicon-menu-right'></span> Wysłana do recenzji: <b>" .$daty['WYSLANA_DO_RECENZJI']. "</b><br />";
					echo "<span class='glyphicon glyphicon glyphicon-menu-right'></span> Data przyjęcia: <b>" .$daty['DATA_PRZYJECIA']. "</b><br />";
					echo "<span class='glyphicon glyphicon glyphicon-menu-right'></span> Data recenzji: <b>" .$daty['DATA_RECENZJI']. "</b><br />";
					echo "<span class='glyphicon glyphicon glyphicon-menu-right'></span> Przyjęte do druku: <b>" .$daty['PRZYJETE_DO_DRUKU']. "</b><br />";
					echo "<span class='glyphicon glyphicon glyphicon-menu-right'></span> Data publikacji: <b>" .$daty['DATA_PUBLIKACJI']. "</b><br /></h4>";
				}
		echo "<hr />";
		echo "<h4><span class='glyphicon glyphicon-list-alt'></span> <b>Uwagi do recenzentów:</b> <br />";
			
				$wszelkieuwagi = mysql_query ("SELECT ID_RECENZENTA, OSOBY.IMIE, OSOBY.NAZWISKO, OSOBY.UWAGI FROM ARTYKULY INNER JOIN OSOBY ON ARTYKULY.ID_RECENZENTA = OSOBY.ID WHERE ARTYKULY.ID = '$_POST[ARTYKULY]'");
				while ($row5 = mysql_fetch_assoc($wszelkieuwagi)){
					$IDRec = explode(", ", $row5['ID_RECENZENTA']);
					foreach ($IDRec as $IDR){
						$test5 = mysql_query ("SELECT IMIE, NAZWISKO, UWAGI FROM OSOBY WHERE ID = '$IDR'");
						while ($row6 = mysql_fetch_assoc($test5)){
							echo "<span class='glyphicon glyphicon glyphicon-menu-right'></span>" .$row6['IMIE']. " " .$row6['NAZWISKO']. "<br /> <span class='glyphicon glyphicon glyphicon-file'></span> Uwagi: " .$row6['UWAGI']. "<br /><br />";
						}
					}
				}
			}
			echo "</div>";
		}
	?>
</div>
</form>
</div>
</div>
</div>
</body>
</html>