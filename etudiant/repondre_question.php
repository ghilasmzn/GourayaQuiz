<?php 

/*
ici on va afficher la question qu'on souhaitrait repondre 
*/
include('home.php');
$id_question = $_GET['id_question'];
$id_quiz = $_GET['id_quiz'];
//la connection à la bdd 
$con = new PDO('mysql:host=webetu.univ-st-etienne.fr;dbname=mg06866u;charset=utf8', 'mg06866u', 'I89APVN5');
$sql ="SELECT * from question";
$reponse = $con->query($sql);
$donnees = $reponse->fetchAll();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <title>repondre à la question <?php echo $id_question ?></title>
    <style>
    #init-section{
        margin-top:200px;
    }
    #options-section{
        margin-top: 60px;
    }
    #options-section .h3{
        font-weight : bold;
        font-size : 2em;
    }
    #options-section input[type=radio]{
        margin-top:50px;
    }

    #validation-btn{
        margin-top:80px;
        float:right;
        width: 20%;
        color:white;
        background-color: green;
        border-radius: 50px;
    }
    #retour-btn{
        margin-top:80px;
        float:left;
        width: 20%;
        color:white;
        background-color: red;
        border-radius: 50px;
    }
    </style>
</head>
<body>

    <div class="container">
        <div id="init-section">
        <form action="./afficher_quiz.php?id_quiz=<?php echo $id_quiz ?>" method="post">
        <input type="text" name="id_quiz" value="<?php echo $id_quiz ?>" hidden/>
        <input type="text" name="id_question" value="<?php echo $id_question ?>" hidden/>
        <input type="text" name="id_etudiant" value="<?php echo $_SESSION['id_etudiant'] ?>" hidden/>
        <?php
                foreach($donnees as $donnee){
                    if($donnee['id_quiz']==$id_quiz AND $donnee['id_question']==$id_question){
                        ?>
                            <input type="text" name="option_juste" value="<?php echo $donnee['options_juste'] ?>" hidden/>
                            <input type="text" name="score" value="<?php echo $donnee['score'] ?>" hidden/>
                            <p class="h1"><strong>la question : </strong> <span><?php echo $donnee['titre_question'] ?> </span></p>                            
                            <!-- options section -->
                            <div id="options-section">
                                <p class="h3">les options : </p>
                                    <?php 
                                        $options = json_decode($donnee['liste_options']);
                                        foreach($options as $option){
                                            ?>
                                            <input type="radio" id="option" name="option_choisi" value="<?php echo $option ?>">
                                            <?php echo $option ?>
                                            <br>
                                            <?php
                                        }
                                    ?>
                            </div>
                        <?php
                    }
                }
            ?>
        <button type="submit" id="validation-btn">valider la reponse</button>
        </form>
           
        <button onclick="location.href ='./afficher_quiz.php?id_quiz=<?php echo $id_quiz ?>'"  type="button"  id="retour-btn">retour à la liste des question</button>
        
    </div>
<script>
</script>
</body>
</html>