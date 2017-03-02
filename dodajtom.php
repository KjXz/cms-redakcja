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
</head>

<?php include_once('body.php'); ?>

<div class="well"><h2>Dodawanie nowego tomu</h2></div>
<div class="container">
  <form role="form" data-toggle="validator" action="dodajtom.php" method="post">
    <div class="form-group">
      <label for="TYTUL">Tytuł:</label>
      <input type="text" class="form-control" name="TYTUL" value="Annales Mathematicae Silesianae" required>
    </div>
    <div class="form-group">
      <label for="NUMER">Numer:</label>
      <input type="number" id="number" min="1" class="form-control" name="NUMER" placeholder="Podaj numer" required>
    </div>
	<div class="form-group">
      <label for="ROK">Rok:</label>
	  <input type="text" class="form-control" name="ROK" placeholder="Podaj rok" required>
	</div>
    <button type="submit" name="submit" class="btn btn-primary"><span class="glyphicon glyphicon-check"></span> Dodaj</button>
	<button type="reset" name="reset" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Wyczyść</button>
  </form>


<?php

if (isset($_POST['submit'])) {

// odbieramy dane z formularza
$TYTUL = strip_tags($_POST['TYTUL']);
$NUMER = strip_tags($_POST['NUMER']);
$ROK = strip_tags($_POST['ROK']);

	// dodajemy rekord do bazy
    $ins = mysql_query("INSERT INTO TOM SET TYTUL='$TYTUL', NUMER='$NUMER', ROK='$ROK'");
	echo "<br><div class='alert alert-info'>
		<a href='/profile.php' class='close' data-dismiss='alert' aria-label='close'>
		<span class='glyphicon glyphicon-ok'></span> OK</a>
		<strong>Sukces!</strong> Wpis został pomyślnie dodany!</div>";
    mysql_close($connection);
}
?>
</div>
</body>
</html>