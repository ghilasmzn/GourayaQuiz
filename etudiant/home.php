<?php 
session_start();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/acceuil.css">
    <link rel="stylesheet" href="../css/prof.css">
    <style>
    #owner{
        background-color: green;
        
    }
    </style>
</head>
<body>
    <!-- navbar -->
<div class="navbar-section">
    <a href="#" id="owner"><?php echo $_SESSION['email'] ?></a>
    <a href="./liste_quiz.php" class="liste-quiz">Liste des quiz</a>
    <a href="./classement.php" class="mon-classement">Consulter mon classement</a>
    <a href="../prof/deconnexion.php" class="deconnexion-btn">Se deconnecter</a>
</div>
</body>
</html>
