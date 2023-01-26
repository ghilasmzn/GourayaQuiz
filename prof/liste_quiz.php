<?php 
include('home.php');
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <title>liste quiz</title>
    <style>
    .liste-quiz{
        border-bottom: 4px solid green;
    }
    .show-quiz{
        margin-top:100px;
    }
    </style>
</head>
<body>
     <!-- affichage questions du quiz -->
     <div class="show-quiz">
        <table class="table table-dark table-striped table-hover">
            <thead>
                <th>id_quiz</th> 
                <th>titre</th>
                <th>nombre_questions</th>
                <th>score maximal</th>
                <th>action</th>
            </thead>
            <tbody>
                <?php
                    $conn = new PDO('mysql:host=webetu.univ-st-etienne.fr;dbname=mg06866u;charset=utf8', 'mg06866u', 'I89APVN5');
                    $sql = "SELECT * FROM quiz";
                    $resultat = $conn->query($sql);
                    while($row = $resultat->fetch()){
                            ?>
                        <tr>
                            <td><?php echo $row["id_quiz"] ?></td>
                            <td><?php echo $row["titre_quiz"] ?></td>
                            <?php
                                $id_quiz = $row['id_quiz'];
                                $sql2 = "SELECT count(*) as count, SUM(score) as totalscore from question where id_quiz=$id_quiz";
                                $requete = $conn->query($sql2);
                                $donnees = $requete->fetch();
                            ?>
                            <td><?php echo $donnees["count"]; ?></td>
                            <td><?php echo $donnees["totalscore"]; ?></td>
                            <td><a href="./delete_quiz.php?id_quiz=<?php echo $row["id_quiz"] ; ?>" type="button">supprimer</a><span> </span><a href="./afficher_quiz.php?id_quiz=<?php echo $row["id_quiz"] ; ?>" type="button">afficher</a></td>
                        </tr>
                            <?php
                        }
                    //}
                ?>
            </tbody>
        </table>
</body>
</html>