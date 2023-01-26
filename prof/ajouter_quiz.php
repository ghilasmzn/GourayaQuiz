<?php 

include('home.php');
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ajouter quiz</title>
    <link rel="stylesheet" href="../css/ajouter.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
    .ajouter-quiz{
        border-bottom: 4px solid green;
    }
    </style>
    
</head>
<body>
    <div class="container">
    <form action="./ajouter_question.php" method="POST">
       <div id="init-section">
           <p class="h1">Ajouter Quiz</p>
           <p class="h3">titre du quiz :</p>
           <input name="titre" type="text" id="titre_quiz" placeholder="veuillez introduire le titre du quiz."/>
           <p>appuyez sur suivant pour ajouter des questions.</p> 
        </div>
        <button type="submit" id="init-btn">Suivant</button>
    <form action="" method="post">   
       
    </div>

    
</body>
</html>