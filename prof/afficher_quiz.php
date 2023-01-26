<?php 
/*
afficher un quiz pour le prof à fin qu'il puisse le modifier en supprimant des question, ajouter des quesitons
*/
include('home.php');
$id_quiz = $_GET['id_quiz'];
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/ajouter.css">
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
                <th>options_juste</th>
                <th>Action</th>
            </thead>
            <tbody>
                <?php
                    $conn3 = new PDO('mysql:host=webetu.univ-st-etienne.fr;dbname=mg06866u;charset=utf8', 'mg06866u', 'I89APVN5');
                    $sql = "SELECT * FROM question where id_quiz = $id_quiz";
                    $resultat = $conn3->query($sql);
                        while($row = $resultat->fetch()){
                            ?>
                        <tr>
                            <td><?php echo $row["id_question"] ?></td>
                            <td><?php echo $row["titre_question"] ?></td>
                            <td><?php print_r($row["liste_options"]) ?></td>
                            <td><?php echo $row["options_juste"] ?></td>
                            <td><a href="./delete_question_from_quiz.php?id_question=<?php echo $row["id_question"];?>&id_quiz=<?php echo $id_quiz ?>" type="button">supprimer</a></td>
                            
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
        <input id="titre_question" type="text" placeholder="veuillez insérer la question.">
        
        <!-- add options section -->
        <div id="add-options-section" class="container">
            <p class="h3">Ajouter les options : </p>
            <ul id="options" name="liste_options" class="list-group">
        
            </ul>
            <input  id="addOption" type="text" name="add_option" placeholder="ajouter une option" /><br>
            <button type="button" id="btn-addOption" class="btn btn-primary">inserer option</button>
        </div>
        
        <p class="h3">Séléctionner l'option juste : </p>

        <select name="option_juste" id="select_option_juste" class="form-select" aria-label="Default select example">
               
        </select>
        <!-- add the right option title -->
        <p class="h3">Définir le score : </p>
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

        var select = document.getElementById("select_option_juste");
        var option = document.createElement("option");
        option.appendChild(document.createTextNode(document.getElementById("addOption").value));
        option.value = document.getElementById("addOption").value;
        select.appendChild(option);
        document.getElementById("addOption").value=""; 
        post_options(options); 
    });   

    /*
       une petite fonction asynchrone en utilisant du ajax en jQuery pour 
       poster (ajouter) une question, son traitement est fait au niveau de  
       la page ajouter_question_helper.php
    */
    
    $("#init-btn").click(function(e){
            $.post("./ajouter_question_helper.php", {
                titre_question: $("#titre_question").val(),
                liste_options: options,
                options_juste: $("#select_option_juste").val(),
                score: $("#score").val(),
                id_quiz: <?php echo $id_quiz?>
                }, function(d, s){
                    alert('question ajoutée avec succées');
                    location.reload();
                    //location.reload(true);
                });
      
    });
    </script>
</div>

</body>
</html>
