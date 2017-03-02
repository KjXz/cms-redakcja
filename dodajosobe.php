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

<script>
$(document).ready(function () {
    $('#submit').click(function() {
      checked = $("input[type=checkbox]:checked").length;

      if(!checked) {
        alert("Proszę wybrać rolę!");
        return false;
      }

    });
});
</script>

</head>

<?php include_once('body.php'); ?>

<div class="well"><h2>Dodawanie nowej osoby</h2></div>
<div class="container">
  <form role="form" action="dodajosobe.php" method="post">
    <div class="form-group">
      <label for="IMIE">Imię:</label>
      <input type="text" class="form-control" name="IMIE" placeholder="Podaj imię" required>
    </div>
    <div class="form-group">
      <label for="NAZWISKO">Nazwisko:</label>
      <input type="text" class="form-control" name="NAZWISKO" placeholder="Podaj nazwisko" required>
    </div>
	<div class="form-group">
      <label for="EMAIL">E-mail:</label>
      <input type="email" class="form-control" name="EMAIL" placeholder="Podaj e-mail" required>
    </div>
	<div class="form-group">
	   <label for="ROLA">Rola:</label><br/>
	   <label class="checkbox-inline"><input type="checkbox" name="ROLA[]" value="A">Autor</label>
	   <label class="checkbox-inline"><input type="checkbox" name="ROLA[]" value="R">Recenzent</label>
	</div>
	<div class="form-group">
      <label for="MIASTO">Miasto:</label>
      <input type="text" class="form-control" name="MIASTO" placeholder="Podaj miasto" required>
    </div>
    <button type="submit" id="submit" name="submit" class="btn btn-primary"><span class="glyphicon glyphicon-check"></span> Dodaj</button>
	<button type="reset" name="reset" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Wyczyść</button>
  </form>
  
<?php
	if (isset($_POST['submit'])){
			$IMIE = strip_tags($_POST['IMIE']);
			$NAZWISKO = strip_tags($_POST['NAZWISKO']);
			$EMAIL = strip_tags($_POST['EMAIL']);
			$ROLA = strip_tags(implode("",$_POST['ROLA']));
			$MIASTO = strip_tags($_POST['MIASTO']);
			
			$ins = @mysql_query("INSERT INTO OSOBY SET IMIE = '$IMIE', NAZWISKO = '$NAZWISKO', EMAIL='$EMAIL', ROLA='$ROLA', MIASTO='$MIASTO'");
			echo "<br><div class='alert alert-success'>
			<a href='/profile.php' class='close' data-dismiss='alert' aria-label='close'><span class='glyphicon glyphicon-ok'></span> OK</a>
			<strong>Sukces!</strong> Wpis został pomyślnie dodany!</div>";
			mysql_close($connection);
	}
?>
</div>