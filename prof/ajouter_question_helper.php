<?php 
    
if(isset($_POST["titre_question"])){
    $titre_question = $_POST['titre_question'];
    $liste_options = json_encode($_POST['liste_options']);
    $options_juste = $_POST['options_juste']; 
    $score = $_POST['score'];
    $id_quiz = $_POST['id_quiz'];

    $conn2 = new PDO('mysql:host=webetu.univ-st-etienne.fr;dbname=mg06866u;charset=utf8', 'mg06866u', 'I89APVN5');
    $sql = "INSERT INTO question (titre_question, liste_options, options_juste, score, id_quiz) VALUES ('$titre_question', '$liste_options', '$options_juste', '$score', '$id_quiz')";
    $conn2->exec($sql);
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- une redirection vers la liste des questions du quiz précédent -->
    <meta http-equiv="refresh" content="0.2;URL='./afficher_quiz.php?id_quiz=<?php echo $id_quiz?>'"> 

</head>
<body>
    
</body>
</html>