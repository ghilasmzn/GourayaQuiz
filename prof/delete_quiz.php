<?php 
if(isset($_GET['id_quiz'])){
    //ici on va creer un script qui supprime un quiz et automatiquement on supprime aussi ses question en utilisant l'id 
    $quiz_id = $_GET['id_quiz'];
    
    //on va creer une connection avec PDO
    $conn = new PDO('mysql:host=webetu.univ-st-etienne.fr;dbname=mg06866u;charset=utf8', 'mg06866u', 'I89APVN5');
    // on va ecrire une requete pour supprimer le quiz de la table des quiz
    $sql_quiz = "DELETE from quiz where id_quiz = $quiz_id";
    // et une autre pour supprimer toutes les questions de ce quiz de la table des questions 
    $sql_questions_quiz = "DELETE from question where id_quiz=$quiz_id";
    
    // on execute les 2 requettes sql 
    $conn->exec($sql_quiz);
    $conn->exec($sql_questions_quiz);
    header('location: ./liste_quiz.php');
}
else{
    header('location: ./liste_quiz.php');
}


?>