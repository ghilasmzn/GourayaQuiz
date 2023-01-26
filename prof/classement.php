<?php
//here
include('home.php');
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>classement des etudiant</title>
</head>
<body>
<div class="show-quiz">
        <table class="table table-dark table-striped table-hover">
            <thead>
                <th>id_etudiant</th> 
                <th>email</th>
                <th>nom</th>
                <th>score</th>
            </thead>
            <tbody>
                <?php
                    $conn = new PDO('mysql:host=webetu.univ-st-etienne.fr;dbname=mg06866u;charset=utf8', 'mg06866u', 'I89APVN5');
                    // cette requete nous permet de recuperer le classement des etudiants .
                    $sql = "SELECT etudiant.id_etudiant, etudiant.email, etudiant.nom, SUM(scoreAttribuer) as scoreTotal FROM etudiant left join reponse on etudiant.id_etudiant=reponse.id_etudiant group by id_etudiant order by scoreTotal desc";
                    $resultat = $conn->query($sql);
                            while($row = $resultat->fetch()){
                            ?>
                        <tr>
                            <td><?php echo $row["id_etudiant"] ?></td>
                            <td><?php echo $row["email"] ?></td>
                            <td><?php echo $row["nom"]; ?></td>
                            <td><?php echo $row["scoreTotal"]; ?></td>
                        </tr>
                            <?php
                        }
                    //}
                ?>
            </tbody>
        </table>
</body>
</html>