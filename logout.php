<?php
session_start();
if(session_destroy()) // Zamknięcie istniejących sesji
{
header("Location: index.php"); // Przekierowanie
}
?>