<?php
session_start(); // Rozpoczęcie sesji
$error=''; // zmienna do przechowywania treści błędu
if (isset($_POST['submit'])) {
if (empty($_POST['username']) || empty($_POST['password'])) {
$error = "<div class='alert alert-danger'>
	<a href='/index.php' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
	<strong>Uwaga!</strong> Nie podano loginu lub hasła!</div>";
}
else
{
// Zdefiniowanie $username oraz $password
$username=$_POST['username'];
$password=$_POST['password'];
// Nawiązanie połączenia z serwerem przez podanie: server_name, user_id oraz password jako parametry
$connection = mysql_connect("localhost", "x", "x");
// Dodatkowe zabezpieczenia MySQL
$username = stripslashes($username);
$password = stripslashes($password);
$username = mysql_real_escape_string($username);
$password = mysql_real_escape_string($password);
// Wybór bazy danych
$db = mysql_select_db("kjeziorowskiprojekt_cba_pl", $connection);
// Sprawdzenie czy podany użytkownik istnieje w bazie danych
$query = mysql_query("select * from login where password=md5('$password') AND username='$username'", $connection);
$rows = mysql_num_rows($query);
if ($rows == 1) {
$_SESSION['login_user']=$username; // Rozpoczęcie sesji
header("location: profile.php"); // Przekierowanie
} else {
$error = "<div class='alert alert-danger'>
	<a href='/index.php' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
	<strong>Uwaga!</strong> Podano błędny login lub hasło!</div>";
}
mysql_close($connection); // Zakończenie połączenia
}
}
?>