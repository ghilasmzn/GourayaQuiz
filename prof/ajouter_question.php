<?php 
/*
cette page nous permet d'ajouter des questions lors de la creation du quiz à la premiere fois !! 
*/
include('home.php');
if($_SERVER["REQUEST_METHOD"]==="POST"){
    // on recupere le nombre de quiz insérer
    if (empty($_POST['titre'])){
        //dans le cas ou le post est vide
        header('location: ./ajouter_quiz.php');
    }
    else {
        $titre_quiz = $_POST['titre'];
        // connexion a la bas de donnéees 
        try{
            $conn = new PDO('mysql:host=webetu.univ-st-etienne.fr;dbname=mg06866u;charset=utf8', 'mg06866u', 'I89APVN5');
            //detecter les erreurs du pdo
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO quiz (titre_quiz) VALUES ('$titre_quiz')";
            $conn->exec($sql);
            $_SESSION['quiz_number'] = $conn->lastInsertId();
           
        } catch (PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
        }
    }
}

if(isset($_POST["titre_question"])){
    //recuperation des données 
    $titre_question = $_POST['titre_question'];
    $liste_options = json_encode($_POST['liste_options']);
    $options_juste = $_POST['options_juste']; 
    $score = $_POST['score'];
    $id_quiz = $_SESSION['quiz_number'];

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/ajouter.css">
    <title>ajouter questions</title>
    
</head>
<body>


    <div id="big-title">
        <p>Questions du quiz <?php echo $_SESSION['quiz_number'] ?></p>
    </div>
    
    <!-- affichage questions du quiz -->
    <div class="show-questions">
        <table class="table table-dark table-striped table-hover">
            <thead>
                <th>id_question</th> 
                <th>titre</th>
                <th>liste_options</th>
                <th>option_juste</th>  
                <th>score</th>
                <th>Action</th>
            </thead>
            <tbody>
                <?php
                    // on va etablir notre connection à la bdd en utilisant PDO
                    $conn3 = new PDO('mysql:host=webetu.univ-st-etienne.fr;dbname=mg06866u;charset=utf8', 'mg06866u', 'I89APVN5');
                    // on recupere le id du quiz courrant à partir de la session 
                    $quiz_id = $_SESSION['quiz_number'];
                    // une requete qui recupere toutes les questions du quiz courrant
                    $sql = "SELECT * FROM question where id_quiz = $quiz_id";
                    // on execute la requete
                    $resultat = $conn3->query($sql);
                        while($row = $resultat->fetch()){
                            ?>
                        <tr>
                            <td><?php echo $row["id_question"] ?></td>
                            <td><?php echo $row["titre_question"] ?></td>
                            <td><?php print_r($row["liste_options"]) ?></td>
                            <td><?php echo $row["options_juste"] ?></td>
                            <td><?php echo $row["score"] ?></td>
                            <td><a href="./delete_question.php?id_question=<?php echo $row["id_question"];?>" type="button">delete</a></td>
                        </tr>
                            <?php
                        }
                ?>
            </tbody>
        </table>
    </div>
    <div class="container">
    <div id="init-section">
        <p class="h1">Ajouter question : </p>
        <input id="titre_question" type="text" placeholder="veuillez inserer la question.">
        
        <!-- add options section -->
        <div id="add-options-section" class="container">
            <p class="h3">Ajouter les options : </p>
            <ul id="options" name="liste_options" class="list-group">
        
            </ul>
            <input  id="addOption" type="text" name="add_option" placeholder="ajouter une option" /><br>
            <button type="button" id="btn-addOption" class="btn btn-primary">inserer option</button>
        </div>
        
        <p class="h3">Selectionner l'option juste : </p>

        <select name="option_juste" id="select_option_juste" class="form-select" aria-label="Default select example">
               
        </select>
        <!-- add the right option title -->
        <p class="h3">Definir le score : </p>
        <input id="score" type="number" min=1>
        <!-- button to submit the question -->
    </div>
    <button type="button" id="init-btn">Valider.</button>

</div>

<script>
    /*
     cette fonction javascript nous permettera de recuperer l'option de l'input id=addOption et :
     1) l'ajouter à l'element ol id=options
     2) l'ajouter à l'element select id=select_option_juste
     puis reinitialiser l'input id=addOption à ""
     */   
    var i=0;
    var options = [];
    document.getElementById("btn-addOption").addEventListener("click",function(){
        var ol = document.getElementById("options");
        var li = document.createElement("li");
        li.className="list-group-item";
        li.appendChild(document.createTextNode(document.getElementById("addOption").value));
        options[i]=document.getElementById("addOption").value;
        i++;
        ol.appendChild(li);

        // on attache chaque option ajouté a l'element <select>
        var select = document.getElementById("select_option_juste");
        var option = document.createElement("option");
        option.appendChild(document.createTextNode(document.getElementById("addOption").value));
        option.value = document.getElementById("addOption").value;
        select.appendChild(option);
        document.getElementById("addOption").value=""; 
        post_options(options); 
    });   


    /*
       une petit fonction asynchone en utilisant du ajax en jQuery pour 
       poster (ajouter) une question, son traitement est fait au niveau de  
       la page ajouter_question.php (i.e : meme page)
    */    
    $("#init-btn").click(function(e){
            $.post("./ajouter_question.php", {
                titre_question: $("#titre_question").val(),
                liste_options: options,
                options_juste: $("#select_option_juste").val(),
                score: $("#score").val(),
                }, function(d, s){
                    alert('question ajoutée avec succées');
                    location.href="./ajouter_question.php";
                });
      
    });
    
</script>


    
</body>
</html>