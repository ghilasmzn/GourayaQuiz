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
    // on verifie que tout les input sont bien remplis 
    if ( empty ($_POST["email-professeur"]) ){
        $email_vide_error = "veuillez inserer l'email de l'utilisateur";
    } else {
        $email = $_POST['email-professeur'];
    }

    if ( empty ($_POST["password-professeur"]) ){
        $password_vide_error = "veuillez inserer le mot de passe";
    } else {
        $password = $_POST['password-professeur'];
    }

    // si il n'y a pas d'erreur 
    if(empty($email_vide_error) AND empty($password_vide_error)){
        //connexion à la base de donnee 
        $bdd = new PDO('mysql:host=webetu.univ-st-etienne.fr;dbname=mg06866u;charset=utf8', 'mg06866u', 'I89APVN5');
        $reponse = $bdd->query('SELECT * FROM prof_auth');
        $donnees = $reponse->fetch();

        // on verifie l'existance de l'email et son password
        if($email == $donnees['email'] AND $password == $donnees['password']){
            $_SESSION['email'] = $donnees['email'];
            echo "bienvenue";
            header("Location: ./prof/liste_quiz.php", true, 301);
        } else {
            $erreur_a_afficher = " email ou mot de passe sont erronés";
        }
    }
    else {
        $erreur_a_afficher = " veuillez verifier que tout les input sont rempli";
    }
}

else{
    $erreur_a_afficher = " Introduisez votre mail ainsi que votre mot de passe enseignant.";
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/acceuil.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <title>acceuil</title>
    <style>
        .logo{
            float:left;
        }
    </style>
</head>
<body>
<!-- navbar -->
<div class="navbar-section">
    <div class="logo">
        <a href="#footer"><img src="./images/logo_transp.png" class='logo'></a>
    </div>
    <a href="./etudiant/inscrire.php">S'inscrire</a>
    <a href="#about-section">A propos</a>
    <a href="#acceuil">Acceuil</a>
</div>

<!-- background image -->
<div class="background-section">
    <img src="./images/background1.jpg" alt="" class="img-fluid">
    <div class="background-text">
        <p>Créez ou participez à un questionnaire facilement ! </p>
        <a href="#about-section">Authentification</a>
    </div>
</div>
<!-- about section (admin auth, quizz creation, show ranks) cards-->
<div class="about-section" id="about-section">
    <h1>Interfaces de connexion</h1>
    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <img src="./images/interface-etud.png" class="card_image" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Coté étudiant</h5>
                    <p class="card-text">Chaque etudiant pourra s'enregistrer, s'authentifier, <br/> et repondre aux quiz,avoir accès à sa note et son classement. </p>
                    <a href="./etudiant/authentification.php"><button type="submit">s'authentifier en tant qu'étudiant</button></a>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <img src="./images/interface-prof.png" class="card_image" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Coté professeur</h5>
                    <p class="card-text">un professeur pourra se connecter et créer des quiz pour ses étudiants, <br> et voir leurs classement.</p>
                    <a href="#prof-auth"><button type="submit">s'authentifier en tant que professeur</button></a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- admin authentification section  -->
<div class="professor-auth-section" id="prof-auth">
    <h1>se connecter en tant que professeur :</h1>
    <form action="./acceuil.php" method="POST">
        <div class="container">
            <label for="email-professeur"> Adresse mail</label>
            <input type="email" placeholder="Email" name="email-professeur" required>

            <label for="password-professeur"> Mot de passe </label>
            <input type="password" placeholder="Mot de passe" name="password-professeur" required>

            <button type="submit">se connecter</button>
            <div class="alert alert-warning" role="alert">
            <?php echo $erreur_a_afficher ?>
            </div>
            
        </div>
    </form>     
</div>

<!-- footer -->
<footer id="footer">
    <div class="footer-item footer-logo">
        <img src="./images/logo_transp.png">
    </div>
    <div class="footer-item footer-note">
        <h6>Note</h6>
        <p>Créez / Participez facilement à des questionnaires de type QCM avec Gouraya Quiz.
        Nos deux interfaces: Étudiant - Enseignant vous garantissent une expérience optimisée. </p>   
    </div>
    <div class="footer-item footer-rights">
        <p>MEZIANE Ghilas MENAA Abderrezak</p>            
    </div>
    <div class="footer-item footer-contact">
        <h6>Contact</h6>
        <p>email : bizak132@gmail.com </br> mezianeghilas3@gmail.com</p>
        <p>tel : 000000</p>
        <p>adresse : Université Jean Monnet Saint Etienne </p>                    
    </div>
</footer>

</body>
</html>