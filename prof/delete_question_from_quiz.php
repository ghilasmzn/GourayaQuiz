<?php
// ici on va creer un script qui nous permet de supprimer une question d'un quiz
if(isset($_GET['id_question'])){
    $question_id = $_GET['id_question'];
    $quiz_id = $_GET['id_quiz'];
    
    //on va creer une connection avec PDO
    $conn = new PDO('mysql:host=webetu.univ-st-etienne.fr;dbname=mg06866u;charset=utf8', 'mg06866u', 'I89APVN5');
    // on va ecrire une requete pour supprimer le quiz de la table des quiz
    $sql = "DELETE from question where id_question = $question_id";
    
   
    
    // on execute les 2 requettes sql 
    $conn->exec($sql);
  
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="refresh" content="0.2;URL='./afficher_quiz.php?id_quiz=<?php echo $quiz_id?>'">
</head>
<body>
    
</body>
</html>