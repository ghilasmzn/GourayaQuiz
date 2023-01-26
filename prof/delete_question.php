<?php
// ici on va creer un script qui nous permet de supprimer une question d'un quiz
if(isset($_GET['id_question'])){
    
    $question_id = $_GET['id_question'];
    
    //on va creer une connection avec PDO
    $conn = new PDO('mysql:host=webetu.univ-st-etienne.fr;dbname=mg06866u;charset=utf8', 'mg06866u', 'I89APVN5');
    // on va ecrire une requete pour supprimer le quiz de la table des quiz
    $sql = "DELETE from question where id_question = $question_id";
    
   
    
    // on execute les 2 requettes sql 
    $conn->exec($sql);
  
    header('location: ./ajouter_question.php');
}
else{
    header('location: ./ajouter_question.php');
}

?>