<?php
// Nawiązanie połączenia z serwerem przez podanie: server_name, user_id oraz password jako parametry
$connection = mysql_connect("localhost", "x", "x");
// Wybór bazy danych
$db = mysql_select_db("kjeziorowskiprojekt_cba_pl", $connection);
session_start();// Rozpoczęcie sesji
// Przechowywanie sesji
$user_check=$_SESSION['login_user'];
// Sprawdzenia nazwy zalogowanego użytkownika
$ses_sql=mysql_query("select username from login where username='$user_check'", $connection);
$row = mysql_fetch_assoc($ses_sql);
$login_session=$row['username'];
if(!isset($login_session)){
mysql_close($connection); // Zakończenie połączenia
header('Location: index.php'); // Przekierowanie na stronę główną
}
?>