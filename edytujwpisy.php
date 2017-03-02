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
<div class="panel-heading"><h2><span class="glyphicon glyphicon-list-alt"></span> Wybierz wśród dostępnych: </h2></div>
<div class="panel-body">
<div class="container">
<form role="form" method="post" action="edytujwpisy.php">
<div class="form-group">

	<button type="button" class="btn btn-info btn-block" data-toggle="collapse" data-target="#cos"><b>Tomy</b></button>
	<div id="cos" class="panel-collapse collapse">
	<br />
	<label for="listatomy">Wybierz tom: </label>
	<select class="form-control" name="TOM">
		<?php
			$zapytanie = mysql_query("SELECT ID, NUMER, ROK FROM TOM");
			while ($wynik = mysql_fetch_assoc($zapytanie)){
				echo "<option value=" .$wynik['ID']. ">" .$wynik['NUMER'].  " / " .$wynik['ROK']. "</option>";
			}
		?>
	</select>
	<br />
	<button type="submit" name="editomlist" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-edit"></span> Edytuj</button>
	<button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#checkT"><span class="glyphicon glyphicon-trash"></span> Usuń</button>
	<br />
	</div>
	
	<br />
	
	<button type="button" class="btn btn-warning btn-block" data-toggle="collapse" data-target="#col"><b>Artykuły</b></button>
	<div id="col" class="panel-collapse collapse">
	<br />
	<label for="listaartykuly">Wybierz artykuł: </label>
	<select class="form-control" name="ARTYKULY">
		<?php
			$zapytanie2 = mysql_query("SELECT ID, TYTUL FROM ARTYKULY");
				while ($wynik2 = mysql_fetch_assoc($zapytanie2)){
					echo "<option value=" .$wynik2['ID']. ">" .$wynik2['TYTUL']. "</option>";
				}
		?>
	</select>
	<br />
	<button type="submit" name="editarticlelist" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-edit"></span> Edytuj</button>
	<button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#checkArt"><span class="glyphicon glyphicon-trash"></span> Usuń</button>
	<br />
	</div>
	<br />
	
	<button type="button" class="btn btn-primary btn-block" data-toggle="collapse" data-target="#coa"><b>Autorzy</b></button>
	<div id="coa" class="panel-collapse collapse">
	<br />
	<label for="listaosobA">Wybierz osobę:</label>
	<select class="form-control" name="OSOBYA">
		<?php
			$zapytanie3 = mysql_query("SELECT ID, IMIE, NAZWISKO FROM OSOBY WHERE ROLA LIKE 'A%'");
				while ($wynik3 = mysql_fetch_assoc($zapytanie3)){
					echo "<option value=" .$wynik3['ID']. ">" .$wynik3['IMIE']. " " .$wynik3['NAZWISKO']. "</option>";
						}
		?>
	</select>
	<br />
	<button type="submit" name="editaurlist" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-edit"></span> Edytuj</button>
	<button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#checkA"><span class="glyphicon glyphicon-trash"></span> Usuń</button>
	<br />
	</div>
	<br />
	
	<button type="button" class="btn btn-success btn-block" data-toggle="collapse" data-target="#cor"><b>Recenzenci</b></button>
	<div id="cor" class="panel-collapse collapse">
	<br />
	<label for="listaosobR">Wybierz osobę:</label>
	<select class="form-control" name="OSOBYR">
		<?php
			$zapytanie4 = mysql_query("SELECT ID, IMIE, NAZWISKO FROM OSOBY WHERE ROLA LIKE '%R'");
				while ($wynik4 = mysql_fetch_assoc($zapytanie4)){
					echo "<option value=" .$wynik4['ID']. ">" .$wynik4['IMIE']. " " .$wynik4['NAZWISKO']. "</option>";
						}
		?>
	</select>
	<br />
	<button type="submit" name="editreclist" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-edit"></span> Edytuj</button>
	<button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#checkR"><span class="glyphicon glyphicon-trash"></span> Usuń</button>
	<br />
	</div>
	
</div>

<!-- WSZYSTKIE DOSTĘPNE MODALE -->
<div class="modal fade" id="checkT" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" style="background-color: #5bc0de;">
          <h4 class="modal-title"><b><font color="white">Potwierdzenie</b></font></h4>
        </div>
        <div class="modal-body">
          <p><b>Czy na pewno chcesz usunąć ten wpis?</b></p>
        </div>
        <div class="modal-footer">
		  <button type="submit" class="btn btn-danger pull-left" name="deltomlist"><span class="glyphicon glyphicon-ok"></span> Tak</button>
          <button type="button" class="btn btn-info pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Anuluj</button>
		  <p><span class="glyphicon glyphicon-warning-sign"></span> Pamiętaj, że usunięcie wpisu jest nieodwracalne!</p>
        </div>
      </div>
    </div>
</div>

<div class="modal fade" id="checkArt" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" style="background-color: #f0ad4e;">
          <h4 class="modal-title"><b><font color="white">Potwierdzenie</b></font></h4>
        </div>
        <div class="modal-body">
          <p><b>Czy na pewno chcesz usunąć ten wpis?</b></p>
        </div>
        <div class="modal-footer">
		  <button type="submit" class="btn btn-danger pull-left" name="delartlist">
		  <span class="glyphicon glyphicon-ok"></span> Tak</button>
          <button type="button" class="btn btn-warning pull-left" data-dismiss="modal">
		  <span class="glyphicon glyphicon-remove"></span> Anuluj</button>
		  <p><span class="glyphicon glyphicon-warning-sign"></span> 
		  Pamiętaj, że usunięcie wpisu jest nieodwracalne!</p>
        </div>
      </div>
    </div>
</div>

<div class="modal fade" id="checkA" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" style="background-color: #337ab7;">
          <h4 class="modal-title"><b><font color="white">Potwierdzenie</b></font></h4>
        </div>
        <div class="modal-body">
          <p><b>Czy na pewno chcesz usunąć ten wpis?</b></p>
        </div>
        <div class="modal-footer">
		  <button type="submit" class="btn btn-danger pull-left" name="delaurlist"><span class="glyphicon glyphicon-ok"></span> Tak</button>
          <button type="button" class="btn btn-primary pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Anuluj</button>
		  <p><span class="glyphicon glyphicon-warning-sign"></span> Pamiętaj, że usunięcie wpisu jest nieodwracalne!</p>
        </div>
      </div>
    </div>
</div>

<div class="modal fade" id="checkR" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" style="background-color: #5cb85c;">
          <h4 class="modal-title"><b><font color="white">Potwierdzenie</b></font></h4>
        </div>
        <div class="modal-body">
          <p><b>Czy na pewno chcesz usunąć ten wpis?</b></p>
        </div>
        <div class="modal-footer">
		  <button type="submit" class="btn btn-danger pull-left" name="delreclist"><span class="glyphicon glyphicon-ok"></span> Tak</button>
          <button type="button" class="btn btn-success pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Anuluj</button>
		  <p><span class="glyphicon glyphicon-warning-sign"></span> Pamiętaj, że usunięcie wpisu jest nieodwracalne!</p>
        </div>
      </div>
    </div>
</div>
</form>

<!-- SEKCJA USUWANIA -->
<?php
	if (isset($_POST['deltomlist'])) {
		$deltomlist = mysql_query ("DELETE FROM TOM WHERE ID = '$_POST[TOM]'");
		echo "<hr />";
		echo "<br><div class='alert alert-info'>
		<a href='/edytujwpisy.php' class='close' data-dismiss='alert' aria-label='close'><span class='glyphicon glyphicon-ok'></span> OK</a>
		<strong>Sukces!</strong> Wpis został pomyślnie usunięty!</div>";
	}

	if (isset($_POST['delartlist'])) {
		$delartlist = mysql_query ("DELETE FROM ARTYKULY WHERE ID = '$_POST[ARTYKULY]'");
		echo "<hr />";
		echo "<br><div class='alert alert-warning'>
		<a href='/edytujwpisy.php' class='close' data-dismiss='alert' aria-label='close'><span class='glyphicon glyphicon-ok'></span> OK</a>
		<strong>Sukces!</strong> Wpis został pomyślnie usunięty!</div>";
	}

	if (isset($_POST['delaurlist'])) {
		$delaurlist = mysql_query ("DELETE FROM OSOBY WHERE ID = '$_POST[OSOBYA]'");
		echo "<hr />";
		echo "<br><div class='alert alert-info'>
		<a href='/edytujwpisy.php' class='close' data-dismiss='alert' aria-label='close'><span class='glyphicon glyphicon-ok'></span> OK</a>
		<strong>Sukces!</strong> Wpis został pomyślnie usunięty!</div>";
	}

	if (isset($_POST['delreclist'])) {
		$delreclist = mysql_query ("DELETE FROM OSOBY WHERE ID = '$_POST[OSOBYR]'");
		echo "<hr />";
		echo "<br><div class='alert alert-success'>
		<a href='/edytujwpisy.php' class='close' data-dismiss='alert' aria-label='close'><span class='glyphicon glyphicon-ok'></span> OK</a>
		<strong>Sukces!</strong> Wpis został pomyślnie usunięty!</div>";
	}
?>
</div>
</div>
</div>

<!-- SEKCJA EDYCJI -->
<?php
	###### TOMY #####
	if (isset($_POST['editomlist'])){
		
		$editshowT = mysql_query("SELECT ID, TYTUL, ROK, NUMER FROM TOM WHERE ID = '$_POST[TOM]'");
		
		echo "<hr />";
		echo "<div class='panel panel-info'>
			 <div class='panel-heading'><h3><span class='glyphicon glyphicon-edit'>
			 </span> Edycja - "; while ($showT = mysql_fetch_assoc($editshowT)){echo $showT['NUMER'] . " / " .$showT['ROK'];}
		echo "</h3></div>
			 <div class='panel-body'>
			 <form role='form' method='post' action='edytujwpisy.php'>";
		$editomlist = mysql_query("SELECT ID, TYTUL, ROK, NUMER FROM TOM WHERE ID = '$_POST[TOM]'");
			while ($editom = mysql_fetch_assoc($editomlist)){
					
					echo "<input type='hidden' name='ID' value='$editom[ID]'>";
					
				    echo "<div class='form-group'>
					<label for='TYTUL'>Tytuł:</label>
					<input type='text' class='form-control' name='TYTUL' value='$editom[TYTUL]' required>
					</div>";
					
					echo "<div class='form-group'>
					<label for='NUMER'>Numer:</label>
					<input type='number' id='number' min='1' class='form-control' name='NUMER' value='$editom[NUMER]' required>
					</div>";
					
					echo "<div class='form-group'>
					<label for='ROK'>Rok:</label>
					<input type='text' class='form-control' name='ROK' value='$editom[ROK]' required>
					</div>";

					echo "<button type='submit' name='savetom' class='btn btn-info'><span class='glyphicon glyphicon-thumbs-up'></span> Zapisz zmiany</button>
					<button type='submit' class='btn btn-danger'><span class='glyphicon glyphicon-thumbs-down'></span> Anuluj</button>";
			}
				echo "</form>";
				echo "</div>";
				echo "</div>";
	}
	
	if (isset($_POST['savetom'])){
		
		$TYTUL = strip_tags($_POST['TYTUL']);
		$NUMER = strip_tags($_POST['NUMER']);
		$ROK = strip_tags($_POST['ROK']);
		$ID = strip_tags($_POST['ID']);
		
		$savetom = mysql_query("UPDATE TOM SET TYTUL='$TYTUL', NUMER='$NUMER', ROK='$ROK' WHERE ID = '$ID'");
		echo "<br><div class='alert alert-info'>
		<a href='/profile.php' class='close' data-dismiss='alert' aria-label='close'><span class='glyphicon glyphicon-ok'></span> OK</a>
		<strong>Sukces!</strong> Wpis został pomyślnie zaktualizowany!</div>";
	}
	
	###### ARTYKUŁY #####
		if (isset($_POST['editarticlelist'])){
		
		$editshowA = mysql_query("SELECT ARTYKULY.ID, ID_TOM, ID_RECENZENTA, ID_AUTOR, ARTYKULY.TYTUL, OSOBY.IMIE, OSOBY.NAZWISKO FROM ARTYKULY INNER JOIN OSOBY ON ARTYKULY.ID_AUTOR = OSOBY.ID WHERE ARTYKULY.ID = '$_POST[ARTYKULY]'");
			
		echo "<hr />";
		echo "<div class='panel panel-warning'>
			 <div class='panel-heading'><h3><span class='glyphicon glyphicon-edit'>
			 </span> Edycja - "; while ($showA = mysql_fetch_assoc($editshowA)){echo $showA['TYTUL'];}
		echo "</h3></div>
			 <div class='panel-body'>
			 <form role='form' method='post' action='edytujwpisy.php'>";
		$editarticlelist = mysql_query("SELECT ARTYKULY.ID, ID_TOM, ID_RECENZENTA, ID_AUTOR, ARTYKULY.TYTUL, OSOBY.IMIE, OSOBY.NAZWISKO FROM ARTYKULY INNER JOIN OSOBY ON ARTYKULY.ID_AUTOR = OSOBY.ID WHERE ARTYKULY.ID = '$_POST[ARTYKULY]'");	 
			while ($editarticle = mysql_fetch_assoc($editarticlelist)){
				echo "<input type='hidden' name='ID' value='$editarticle[ID]'>";
				
				echo "<div class='form-group'>
				<label for='TYTUL'>Tytuł: </label>
				<input type='text' class='form-control' name='TYTUL' value='$editarticle[TYTUL]' required>
				</div>";
				
				
				// AUTORZY
				echo "<hr />";
				echo "<div class='form-group'>
				<label for='AUTORZY'>Wybierz autorów: </label>
				<br />
				<select id='listaA' name='AUTORZY[]' multiple='multiple'>";
				$zapytanie = mysql_query("SELECT ID, IMIE, NAZWISKO from OSOBY where ROLA='A' OR ROLA='AR' order by IMIE");
				while ($option = mysql_fetch_assoc($zapytanie)){
					echo "<option value=" .$option['ID']. ">" .$option['IMIE']." ".$option['NAZWISKO']. "</option>";
				}
				echo "</select>";
				echo "</div>";
				
				echo "<b>Obecnie wybrani autorzy: </b>";
				$showtom = explode(", ", $editarticle['ID_AUTOR']);
					foreach ($showtom as $val){
						$autorzy = @mysql_query ("SELECT IMIE, NAZWISKO FROM OSOBY WHERE ID = '$val'");
						while ($IDA = mysql_fetch_array($autorzy)){
							echo "<br /> <span class='glyphicon glyphicon-menu-right'></span> " .$IDA['IMIE']. " " .$IDA['NAZWISKO']. "<br>";
						}
					}
				
				// RECENZENCI
				echo "<hr />";
				echo "<div class='form-group'>
				<label for='RECENZENCI'>Wybierz recezentów: </label>
				<br />
				<select id='listaR' name='RECENZENCI[]' multiple='multiple'>";
				$zapytanie = mysql_query("SELECT ID, IMIE, NAZWISKO from OSOBY where ROLA='R' OR ROLA='AR' order by IMIE");
				while ($option2 = mysql_fetch_assoc($zapytanie)){
					echo "<option value=" .$option2['ID']. ">" .$option2['IMIE']." ".$option2['NAZWISKO']. "</option>";
				}
				echo "</select>";
				echo "</div>";
				
				echo "<b>Obecnie wybrani recenzenci: </b>";
				$showtom2 = explode(", ", $editarticle['ID_RECENZENTA']);
					foreach ($showtom2 as $val){
						$recent = @mysql_query ("SELECT IMIE, NAZWISKO FROM OSOBY WHERE ID = '$val'");
						while ($IDR = mysql_fetch_array($recent)){
							echo "<br /> <span class='glyphicon glyphicon-menu-right'></span> " .$IDR['IMIE']. " " .$IDR['NAZWISKO'];
						}
					}
					
				echo "<script id='example'>
				$('#listaA').multiselect({
				enableClickableOptGroups: true,
				enableFiltering: true
				});
			
				$('#listaR').multiselect({
				enableClickableOptGroups: true,
				enableFiltering: true
				});
				</script>";	
				
				// TOMY
				echo "<hr />";
				echo "<div class='form-group'>
				<label for='TOM'>Wybór tomu: </label>
				<br />
				<select class='form-control' name='TOM'>";
				$zapytanie2 = mysql_query("SELECT ID, NUMER, ROK FROM TOM ORDER BY ROK");
				while ($wynik3 = mysql_fetch_assoc($zapytanie2)){
				echo "<option value=" .$wynik3['ID']. ">" .$wynik3['NUMER']." / ".$wynik3['ROK']. "</option>";
				}
				echo "</select>";
				
				echo "<br /><b>Obecnie wybrany tom: </b>";
				$ART = $editarticle['ID_TOM'];
					$zapytanie3 = mysql_query("SELECT ID, NUMER, ROK FROM TOM WHERE ID = '$ART'");
					while ($IDT = mysql_fetch_assoc($zapytanie3)){
						echo "<br /> <span class='glyphicon glyphicon-menu-right'></span> " .$IDT['NUMER']. " / " .$IDT['ROK'];
					}
				echo "</div>";
				echo "<hr />";
				
				// SEKCJA DAT
				$ARTID = $editarticle['ID'];
				$datydaty = mysql_query("SELECT WYSLANA_DO_RECENZJI, DATA_PRZYJECIA, DATA_RECENZJI, DATA_PUBLIKACJI, PRZYJETE_DO_DRUKU FROM ARTYKULY WHERE ID = '$ARTID'");
			
				while ($daty = mysql_fetch_assoc($datydaty)){
					echo "<div class='form-group'>
					<label for='WYSLANA_DO_RECENZJI'>Wysłana do recenzji:</label><br/>";
					if ($daty['WYSLANA_DO_RECENZJI'] == "Tak" )
					{
						echo "<label class='radio-inline'><input type='radio' name='WYSLANA_DO_RECENZJI' value='Tak' checked>Tak</label><br />";
						echo "<label class='radio-inline'><input type='radio' name='WYSLANA_DO_RECENZJI' value='Nie'>Nie</label><br />";
					}
					
					if ($daty['WYSLANA_DO_RECENZJI'] == "Nie" )
					{
						echo "<label class='radio-inline'><input type='radio' name='WYSLANA_DO_RECENZJI' value='Tak'>Tak</label><br />";
						echo "<label class='radio-inline'><input type='radio' name='WYSLANA_DO_RECENZJI' value='Nie' checked>Nie</label><br />";
					}
					
					if ($daty['WYSLANA_DO_RECENZJI'] == "" )
					{
						echo "<label class='radio-inline'><input type='radio' name='WYSLANA_DO_RECENZJI' value='Tak'>Tak</label><br />";
						echo "<label class='radio-inline'><input type='radio' name='WYSLANA_DO_RECENZJI' value='Nie'>Nie</label><br />";
					}
					echo "</div>";

					echo "<div class='form-group'>
					<label for='DATA_PRZYJECIA'>Data wpłynięcia:</label>
					<input type='date' class='form-control' name='DATA_PRZYJECIA' value='$daty[DATA_PRZYJECIA]'>
					</div>";
					
					echo "<div class='form-group'>
					<label for='DATA_PRZYJECIA'>Data wpłynięcia ostatecznej wersji:</label>
					<input type='date' class='form-control' name='DATA_PRZYJECIA_OST' value='$daty[DATA_PRZYJECIA_OST]'>
					</div>";
					
					echo "<div class='form-group'>
					<label for='DATA_RECENZJI'>Data recenzji:</label>
					<input type='date' class='form-control' name='DATA_RECENZJI' value='$daty[DATA_RECENZJI]'>
					</div>";
					
					echo "<div class='form-group'>
					<label for='PRZYJETE_DO_DRUKU'>Przyjęte do druku:</label><br/>";
					if ($daty['PRZYJETE_DO_DRUKU'] == "Tak" )
					{
						echo "<label class='radio-inline'><input type='radio' name='PRZYJETE_DO_DRUKU' value='Tak' checked>Tak</label><br />";
						echo "<label class='radio-inline'><input type='radio' name='PRZYJETE_DO_DRUKU' value='Nie'>Nie</label><br />";
					}
					
					if ($daty['PRZYJETE_DO_DRUKU'] == "Nie" )
					{
						echo "<label class='radio-inline'><input type='radio' name='PRZYJETE_DO_DRUKU' value='Tak'>Tak</label><br />";
						echo "<label class='radio-inline'><input type='radio' name='PRZYJETE_DO_DRUKU' value='Nie' checked>Nie</label><br />";
					}
					
					if ($daty['PRZYJETE_DO_DRUKU'] == "" )
					{
						echo "<label class='radio-inline'><input type='radio' name='PRZYJETE_DO_DRUKU' value='Tak'>Tak</label><br />";
						echo "<label class='radio-inline'><input type='radio' name='PRZYJETE_DO_DRUKU' value='Nie'>Nie</label><br />";
					}
					echo "</div>";
					
					echo "<div class='form-group'>
					<label for='DATA_PRZYJECIA_DRUK'>Data przyjęcia do druku:</label>
					<input type='date' class='form-control' name='DATA_PRZYJECIA_DRUK' value='$daty[DATA_PRZYJECIA_DRUK]'>
					</div>";
					
					echo "<div class='form-group'>
					<label for='DATA_PUBLIKACJI'>Data publikacji online:</label>
					<input type='date' class='form-control' name='DATA_PUBLIKACJI' value='$daty[DATA_PUBLIKACJI]'>
					</div>";
					
					
				}
				echo "</div>";
				echo "<hr />";
				
				echo "<button type='submit' name='saveart' class='btn btn-warning'><span class='glyphicon glyphicon-thumbs-up'></span> Zapisz zmiany</button>
				<button type='submit' class='btn btn-danger'><span class='glyphicon glyphicon-thumbs-down'></span> Anuluj</button>";
				echo "<hr />";
			}
				echo "</form>";
				echo "</div>";
				echo "</div>";
	}		
		
	if (isset($_POST['saveart'])){
		
		$TYTUL = strip_tags($_POST['TYTUL']);
		$AUTORZY = strip_tags(implode(", ", $_POST['AUTORZY']));
		$RECENZENCI = strip_tags(implode(", ", $_POST['RECENZENCI']));
		$TOM = strip_tags($_POST['TOM']);
		$WYSLANA_DO_RECENZJI = strip_tags($_POST['WYSLANA_DO_RECENZJI']);
		$DATA_PRZYJECIA = strip_tags($_POST['DATA_PRZYJECIA']);
		$DATA_RECENZJI = strip_tags($_POST['DATA_RECENZJI']);
		$PRZYJETE_DO_DRUKU = strip_tags($_POST['PRZYJETE_DO_DRUKU']);
		$DATA_PUBLIKACJI = strip_tags($_POST['DATA_PUBLIKACJI']);
		$ID = strip_tags($_POST['ID']);
		
		$saveart = mysql_query("UPDATE ARTYKULY SET TYTUL = '$TYTUL', ID_TOM = '$TOM', ID_AUTOR = '$AUTORZY', 
		ID_RECENZENTA = '$RECENZENCI', WYSLANA_DO_RECENZJI = '$WYSLANA_DO_RECENZJI', 
		DATA_PRZYJECIA = '$DATA_PRZYJECIA', DATA_RECENZJI = '$DATA_RECENZJI', 
		PRZYJETE_DO_DRUKU = '$PRZYJETE_DO_DRUKU', DATA_PUBLIKACJI = '$DATA_PUBLIKACJI' WHERE ID = '$ID'");
		echo "<br><div class='alert alert-warning'>
		<a href='/profile.php' class='close' data-dismiss='alert' aria-label='close'><span class='glyphicon glyphicon-ok'></span> OK</a>
		<strong>Sukces!</strong> Wpis został pomyślnie zaktualizowany!</div>";
	}
	
	
	
	###### OSOBY - AUTORZY #####
	
		if (isset($_POST['editaurlist'])){
			
		$editshowOA = mysql_query("SELECT ID, IMIE, NAZWISKO, EMAIL, ROLA, MIASTO FROM OSOBY WHERE ID = '$_POST[OSOBYA]'");
		
		echo "<hr />";
		echo "<div class='panel panel-primary'>
			 <div class='panel-heading'><h3><span class='glyphicon glyphicon-edit'>
			 </span> Edycja - "; while ($showOA = mysql_fetch_assoc($editshowOA)){echo $showOA['IMIE']. " " .$showOA['NAZWISKO'];}
		echo "</h3></div>
			 <div class='panel-body'>
			 <form role='form' method='post' action='edytujwpisy.php'>";
		$editaurlist = mysql_query("SELECT ID, IMIE, NAZWISKO, EMAIL, ROLA, MIASTO FROM OSOBY WHERE ID = '$_POST[OSOBYA]'");
			while ($editaur = mysql_fetch_assoc($editaurlist)){
					
					echo "<input type='hidden' name='ID' value='$editaur[ID]'>";
					
				    echo "<div class='form-group'>
					<label for='IMIE'>Imię:</label>
					<input type='text' class='form-control' name='IMIE' value='$editaur[IMIE]' required>
					</div>";
					
					echo "<div class='form-group'>
					<label for='NAZWISKO'>Nazwisko:</label>
					<input type='text' class='form-control' name='NAZWISKO' value='$editaur[NAZWISKO]' required>
					</div>";
					
					echo "<div class='form-group'>
					<label for='EMAIL'>E-mail:</label>
					<input type='text' class='form-control' name='EMAIL' value='$editaur[EMAIL]'>
					</div>";
					
					echo "<hr />";
					echo "<div class='form-group'>
					<label for='ROLA'>Rola:</label><br/>";
					if ($editaur["ROLA"] == "A")
					{
						echo "<label class='checkbox-inline'><input type='checkbox' name='ROLA[]' value='A' checked>Autor</label>";
						echo "<label class='checkbox-inline'><input type='checkbox' name='ROLA[]' value='R'>Recenzent</label>";
					}
					if ($editaur["ROLA"] == "R")
					{
						echo "<label class='checkbox-inline'><input type='checkbox' name='ROLA[]' value='A'>Autor</label>";
						echo "<label class='checkbox-inline'><input type='checkbox' name='ROLA[]' value='R' checked>Recenzent</label>";
					}
					if ($editaur["ROLA"] == "AR")
					{
						echo "<label class='checkbox-inline'><input type='checkbox' name='ROLA[]' value='A' checked>Autor</label>";
						echo "<label class='checkbox-inline'><input type='checkbox' name='ROLA[]' value='R' checked>Recenzent</label>";
					}	
					echo "</div>";
					echo "<hr />";
					
					echo "<script>
					$(document).ready(function () {
					$('#saveaur').click(function() {
					checked = $('input[type=checkbox]:checked').length;

					if(!checked) {
					alert('Proszę wybrać rolę!');
					return false;
					}

					});
					});
					</script>";
				
					
					echo "<div class='form-group'>
					<label for='MIASTO'>Miasto:</label>
					<input type='text' class='form-control' name='MIASTO' value='$editaur[MIASTO]'>
					</div>";
					
					echo "<button type='submit' id='saveaur' name='saveaur' class='btn btn-primary'><span class='glyphicon glyphicon-thumbs-up'></span> Zapisz zmiany</button>
					<button type='submit' class='btn btn-danger'><span class='glyphicon glyphicon-thumbs-down'></span> Anuluj</button>";
			}
				echo "</form>";
				echo "</div>";
				echo "</div>";
	}
	
	if (isset($_POST['saveaur'])){
		
		$IMIE = strip_tags($_POST['IMIE']);
		$NAZWISKO = strip_tags($_POST['NAZWISKO']);
		$EMAIL = strip_tags($_POST['EMAIL']);
		$ROLA = strip_tags(implode("",$_POST['ROLA']));
		$MIASTO = strip_tags($_POST['MIASTO']);
		$ID = strip_tags($_POST['ID']);
		
		$saveaur = mysql_query("UPDATE OSOBY SET IMIE = '$IMIE', NAZWISKO = '$NAZWISKO', EMAIL='$EMAIL', ROLA='$ROLA', MIASTO='$MIASTO' WHERE ID = '$ID'");
		echo "<br><div class='alert alert-info'>
		<a href='/profile.php' class='close' data-dismiss='alert' aria-label='close'><span class='glyphicon glyphicon-ok'></span> OK</a>
		<strong>Sukces!</strong> Wpis został pomyślnie zaktualizowany!</div>";
	}
	
	###### OSOBY - RECENZENCI #####
	
		if (isset($_POST['editreclist'])){
			
		$editshowOR = mysql_query("SELECT ID, IMIE, NAZWISKO, EMAIL, ROLA, MIASTO, UWAGI FROM OSOBY WHERE ID = '$_POST[OSOBYR]'");
		
		echo "<hr />";
		echo "<div class='panel panel-success'>
			 <div class='panel-heading'><h3><span class='glyphicon glyphicon-edit'>
			 </span> Edycja - "; while ($showOR = mysql_fetch_assoc($editshowOR)){echo $showOR['IMIE']. " " .$showOR['NAZWISKO'];}
		echo "</h3></div>
			 <div class='panel-body'>
			 <form role='form' method='post' action='edytujwpisy.php'>";
		$editrec = mysql_query("SELECT ID, IMIE, NAZWISKO, EMAIL, ROLA, MIASTO, UWAGI FROM OSOBY WHERE ID = '$_POST[OSOBYR]'");
			while ($editreclist = mysql_fetch_assoc($editrec)){
					
					echo "<input type='hidden' name='ID' value='$editreclist[ID]'>";
					
				    echo "<div class='form-group'>
					<label for='IMIE'>Imię:</label>
					<input type='text' class='form-control' name='IMIE' value='$editreclist[IMIE]' required>
					</div>";
					
					echo "<div class='form-group'>
					<label for='NAZWISKO'>Nazwisko:</label>
					<input type='text' class='form-control' name='NAZWISKO' value='$editreclist[NAZWISKO]' required>
					</div>";
					
					echo "<div class='form-group'>
					<label for='EMAIL'>E-mail:</label>
					<input type='text' class='form-control' name='EMAIL' value='$editreclist[EMAIL]'>
					</div>";
					
					echo "<hr />";
					echo "<div class='form-group'>
					<label for='ROLA'>Rola:</label><br/>";
					if ($editreclist["ROLA"] == "A")
					{
						echo "<label class='checkbox-inline'><input type='checkbox' name='ROLA[]' value='A' checked>Autor</label>";
						echo "<label class='checkbox-inline'><input type='checkbox' name='ROLA[]' value='R'>Recenzent</label>";
					}
					if ($editreclist["ROLA"] == "R")
					{
						echo "<label class='checkbox-inline'><input type='checkbox' name='ROLA[]' value='A'>Autor</label>";
						echo "<label class='checkbox-inline'><input type='checkbox' name='ROLA[]' value='R' checked>Recenzent</label>";
					}
					if ($editreclist["ROLA"] == "AR")
					{
						echo "<label class='checkbox-inline'><input type='checkbox' name='ROLA[]' value='A' checked>Autor</label>";
						echo "<label class='checkbox-inline'><input type='checkbox' name='ROLA[]' value='R' checked>Recenzent</label>";
					}
					echo "</div>";
					echo "<hr />";
					
					echo "<script>
					$(document).ready(function () {
					$('#saverec').click(function() {
					checked = $('input[type=checkbox]:checked').length;

					if(!checked) {
					alert('Proszę wybrać rolę!');
					return false;
					}

					});
					});
					</script>";
					
					echo "<div class='form-group'>
					<label for='MIASTO'>Miasto:</label>
					<input type='text' class='form-control' name='MIASTO' value='$editreclist[MIASTO]'>
					</div><hr />";
					
					echo "<div class='form-group'>
					<label for='UWAGI'>Uwagi:</label>
					<textarea class='form-control' rows='5' name='UWAGI'>$editreclist[UWAGI]</textarea>
					</div>";
					
					echo "<button type='submit' id='saverec' name='saverec' class='btn btn-success'><span class='glyphicon glyphicon-thumbs-up'></span> Zapisz zmiany</button>
					<button type='submit' class='btn btn-danger'><span class='glyphicon glyphicon-thumbs-down'></span> Anuluj</button>";
			}
				echo "</form>";
				echo "</div>";
				echo "</div>";
	}
	
	if (isset($_POST['saverec'])){
		
		$IMIE = strip_tags($_POST['IMIE']);
		$NAZWISKO = strip_tags($_POST['NAZWISKO']);
		$EMAIL = strip_tags($_POST['EMAIL']);
		$ROLA = strip_tags(implode("",$_POST['ROLA']));
		$MIASTO = strip_tags($_POST['MIASTO']);
		$UWAGI = strip_tags(mysql_real_escape_string($_POST['UWAGI']));
		$ID = strip_tags($_POST['ID']);
		
		$saveaur = mysql_query("UPDATE OSOBY SET IMIE = '$IMIE', NAZWISKO = '$NAZWISKO', EMAIL='$EMAIL', ROLA='$ROLA', MIASTO='$MIASTO', UWAGI='$UWAGI' WHERE ID = '$ID'"); 
		echo "<br><div class='alert alert-success'>
		<a href='/profile.php' class='close' data-dismiss='alert' aria-label='close'><span class='glyphicon glyphicon-ok'></span> OK</a>
		<strong>Sukces!</strong> Wpis został pomyślnie zaktualizowany!</div>";
	}
	?>
</div>	
</body>
</html>