<?php 
//on supprime les variables de session
session_unset(); 
//on detruit la session
session_destroy();
//une redirection vers acceuil.php
header('location: ../acceuil.php');
?>