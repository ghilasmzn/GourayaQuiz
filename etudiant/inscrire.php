<?php 

/*
ce script sert à inscrire un etudiant .
les etapes :
1) on recupere les données des inputs du form  
2) on verifie s'ils ne sont pas empty en utilisant la fonction empty()
3) on initialise leurs score initial à 0 
4) enregistrer l'etudiant.
*/
if($_SERVER["REQUEST_METHOD"]==="POST"){
    if(!empty($_POST['nom_etudiant']) AND !empty($_POST['email_etudiant']) AND !empty($_POST['password_etudiant'])){
        // initialisation des donnees
        $nom = $_POST['nom_etudiant'];
        $email = $_POST['email_etudiant'];
        $password = $_POST['password_etudiant'];
        $score = 0; // son score au debut est à 0
        echo"<script>alert(\"Félicitations votre compte a bien été crée, Nous vous redirigeons vers la page de connexion\");
         document.location.href = './authentification.php';</script>";
        // creation de la conn 
        try{
            $conn = new PDO('mysql:host=webetu.univ-st-etienne.fr;dbname=mg06866u;charset=utf8', 'mg06866u', 'I89APVN5');
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);            
            $sql = "INSERT INTO etudiant (nom, email, password_etudiant, score) VALUES ('$nom', '$email', '$password', '$score')";
            $conn->exec($sql);
        }catch(PDOException $error){
            echo $error->getMessage(); // afficher le message d'erreur 
        }
    }
}

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/log_auth.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>s'inscrire en tant que étudiant</title>        
</head>
<body>
    <!-- navbar -->
    <div class="navbar-section">
        <a href="./authentification.php">Se connecter</a>
        <a href="../acceuil.php">Acceuil</a>
        <a href="#form-section"><img src="../images/logo_transp.png" class='logo'></a>
    </div>
</br>
    <h2> Espace d'inscription - Étudiant </h2>
    <div id="form-section" class="container">
        <form action="./inscrire.php" method="POST">
            <label for="nom">Nom complet : </label><br><input type="text" id="nom_etudiant" name="nom_etudiant" placeholder="nom complet"><br>
            <label for="email">Email : </label><br><input type="email" id="email_etudiant" name="email_etudiant" placeholder="email"><br>
            <label for="password">Mot de passe : </label><br><input type="password" id="password_etudiant" name="password_etudiant" placeholder="mot de passe">
            <input type="submit" value="s'inscrire" >
        </form>
    </div>

</body>
</html>