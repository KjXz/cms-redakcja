<?php
include('login.php'); // Dodanie zawartości login.php

if(isset($_SESSION['login_user'])){
header("location: profile.php");
}
?>

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

<body>
<div class="ourbody">
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="index.php">System zarządzania redakcją czasopism</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
      </ul>
    </div>
  </div>
</nav>
</div>

<div class="container">
  <form role="form" action="" method="post">
    <div class="form-group">
      <label for="login">Login:</label>
      <input type="text" class="form-control" id="name" name="username" placeholder="Nazwa użytkownika">
    </div>
    <div class="form-group">
      <label for="password">Hasło:</label>
      <input type="password" class="form-control" id="password" name="password" placeholder="Hasło">
    </div>
    <button type="submit" name="submit" class="btn btn-default">Zaloguj</button>
		<br><br>
	<?php echo $error; ?>
  </form>
</div>

</body>
</html>