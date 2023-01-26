<?php 

/*
ici on va faire deux taches :
1) afficher les question du quiz selon l'id passé en parametre de l'url
2) storer la reponse de l'etudiant dans la table reponse
*/

include('home.php'); // on inclut la page home.php pour recupere la barre de navigation.

/* 
 ça concerne la 1ère etape :
*/
$id_quiz = $_GET['id_quiz']; // on récupere l'id du quiz

/* 
 ça concerne la 2ème etape :
 -ici on va faire un petit test pour voir que l'etudiant a bien soumis sa reponse en utilisant la fonction isset()
 -la fonction isset() sert à verifier que la variable est bien defini, rempli et pas vide
*/
if(isset($_POST['score'])){

    $con = new PDO('mysql:host=webetu.univ-st-etienne.fr;dbname=mg06866u;charset=utf8', 'mg06866u', 'I89APVN5'); // etablir la connexion avec la base de donnée.
    // on recupere le score et l'option juste de la question ainsi que d'autres variable pour faire le calcul du score
    $score = $_POST['score'];
    $option_juste = $_POST['option_juste'];
    $option_selectionnee = $_POST['option_choisi'];
    $id_quiz = $_POST['id_quiz'];
    $id_question = $_POST['id_question'];
    $id_etudiant = $_POST['id_etudiant'];
    /*
    maintenant on va calculer le score de la reponse de l'etudiant à cette question
    1) on va initialiser une variable $scoreAttribuer à 0 par default
    2) si l'option choisi par l'etudiant  == à l'option juste définit par le prof on change la valeur de $scoreAttribuer, sinon non.
    */
    $scoreAttribuer = 0;
    if($option_selectionnee == $option_juste){
        $scoreAttribuer = $score;
    }
    //on enregistre dans la table reponse les données suivantes : id_quiz, id_question, id_etudiant, scoreAttribuer
    $sql = "INSERT INTO reponse VALUES ('$id_quiz', '$id_question', '$id_etudiant', '$scoreAttribuer')";
    $con->exec($sql);    
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/ajouter.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>repondre au quiz</title>
    
</head>
<body>


    <div id="big-title">
        <p>Questions du quiz <?php echo $id_quiz ?></p>
    </div>
    
    <!-- affichage questions du quiz -->
    <div class="show-questions">
        <table class="table table-dark table-striped table-hover">
            <thead>
                <th>id_question</th> 
                <th>titre</th>
                <th>liste_options</th>
                <th>score</th>
                <th>Action</th>
                <th>repondu ?</th>
            </thead>
            <tbody>
                <?php
                    $conn3 = new PDO('mysql:host=webetu.univ-st-etienne.fr;dbname=mg06866u;charset=utf8', 'mg06866u', 'I89APVN5');
                    $sql = "SELECT * FROM question where id_quiz = $id_quiz"; //une requete pour recuperer toutes les questions du quiz
                    $resultat = $conn3->query($sql);
                        while($row = $resultat->fetch()){
                            ?>
                        <tr>
                            <td><?php echo $row["id_question"]; $id_question = $row["id_question"]?></td>
                            <td><?php echo $row["titre_question"] ?></td>
                            <td><?php print_r($row["liste_options"]) ?></td>
                            <td><?php echo $row["score"] ?></td>
                            <td><a href="./repondre_question.php?id_question=<?php echo $row["id_question"];?>&id_quiz=<?php echo $id_quiz; ?>" type="button">repondre à la question</a></td>
                            <?php
                                $id_etudiant = $_SESSION['id_etudiant'];
                                $affichage =""; //cette variable va nous afficher oui si l'utilisateur a deja repondu à la question, non sinon
                                // verifier si cet utilisateur a déja repondu à cette question 
                                $conn = new PDO('mysql:host=webetu.univ-st-etienne.fr;dbname=mg06866u;charset=utf8', 'mg06866u', 'I89APVN5');
                                $sql = "SELECT count(*) as occurrence FROM reponse where id_quiz =$id_quiz and id_question=$id_question and id_etudiant=$id_etudiant";
                                $resultat1 = $conn->prepare($sql);
                                $resultat1->execute();
                                $donnees = $resultat1->fetch();
                                if ($donnees[0]>0){
                                    $affichage ="<i class='fa fa-toggle-on' style='color:green'></i>";
                                }else{
                                    $affichage="<i class='fa fa-toggle-off' style='color:red'>";
                                }

                            ?>
                            <td>
                            <?php echo $affichage;?>
                            </td>
                        </tr>
                            <?php
                        }
                ?>
            </tbody>
        </table>
    </div>
    
</div>

</body>
</html>
