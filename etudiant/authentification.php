<?php

session_start();
// on initialise l'email et le mot de passe 
$email = "";
$password = "";

//on verifier que les inputs ne sont pas vides 
$email_vide_error = "";
$password_vide_error = "";

//erreur
$erreur_a_afficher = "";

// on verifier si la methode du form est "post" 
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // on verifie que tout les input sont bien rempli
    if ( empty ($_POST["email"]) ){
        $email_vide_error = "veuillez insérer l'email de l'utilisateur";
    } else {
        $email = $_POST['email'];
    }

    if ( empty ($_POST["password"]) ){
        $password_vide_error = "veuillez insérer le mot de passe";
    } else {
        $password = $_POST['password'];
    }

    // si il n'y a pas d'erreur 
    if(empty($email_vide_error) AND empty($password_vide_error)){
        //connexion à la base de donnees 
        $bdd = new PDO('mysql:host=webetu.univ-st-etienne.fr;dbname=mg06866u;charset=utf8', 'mg06866u', 'I89APVN5');
        $reponse = $bdd->query("SELECT * FROM etudiant");
        $donnees = $reponse->fetchAll();
        
        foreach($donnees as $donnee){
            // on verifie l'existance de l'email et son password
            if($email == $donnee['email'] AND $password == $donnee['password_etudiant']){
                $_SESSION['email'] = $donnee['email'];
                $_SESSION['id_etudiant'] = $donnee['id_etudiant'];
                header("Location: ./liste_quiz.php", true, 301);
            } else {
                $erreur_a_afficher = " email ou mot de passe sont erronés";
            }
        }        
    }
    else {
        $erreur_a_afficher = " veuillez vérifier que tout les champs sont remplis";
    }
}

else{
    $erreur_a_afficher = "veuillez entrer vos identifiants ";
}

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/log_auth.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>s'authentifier en tant qu'etudiant</title>
</head>
<body>
    <!-- navbar -->
    <div class="navbar-section">
        <a href="./inscrire.php">S'inscrire</a>
        <a href="../acceuil.php">Acceuil</a>
        <div class="logo">
        <a href="#form-section"><img src="../images/logo_transp.png" class='logo'></a>
    </div>
    </div>
    </br>
    <h2>Espace de connexion - Étudiant</h2>
    <div id="form-section" class="container">
        <form action="./authentification.php" method="POST">
            <label for="email">Email : </label><br><input type="email" name="email" placeholder="email"><br>
            <label for="password">Mot de passe : </label><br><input type="password" name="password" placeholder="mot de passe">
            <input type="submit" value="s'authentifier"/>
        </form>
        <div class="alert alert-warning" role="alert">
            <?php echo $erreur_a_afficher ?>
            </div>
    </div>
</body>
</html>