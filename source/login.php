<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    //identifiants mysql
    $host = "database"; 
    $username = "root"; 
    $userpassword = "root"; 
    $database = "form_db"; 

    if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Please enter a valid email address");
    }
    if (!$password) {
        die("Please enter a password");
    }

    //Ouvrir une nouvelle connexion au serveur MySQL
    $mysqli = new mysqli($host, $username, $userpassword, $database);

    //Afficher toute erreur de connexion
    if ($mysqli->connect_error) {
        die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
    } 

    //préparer la requête SQL pour sélectionner l'utilisateur avec l'email et le mot de passe entrés
    $statement = $mysqli->prepare("SELECT * FROM users WHERE email=? AND password=?");
    /* La requête sélectionne toutes les colonnes ("SELECT *") de la table "users" 
    où la colonne "email" correspond à la valeur donnée (bindée plus tard avec "bind_param") 
    et la colonne "password" correspond également à la valeur donnée (bindée plus tard avec "bind_param"). 
    Les marqueurs "?" sont utilisés pour ligaturer les valeurs pour éviter les attaques d'injection SQL.*/
    $statement->bind_param('ss', $email, $password);

    //exécuter la requête
    $statement->execute();

    //récupérer les résultats
    $result = $statement->get_result();
    $user = $result->fetch_assoc();
    //récupère la première ligne du résultat de la requête SQL sous forme d'un tableau associatif et le stocke dans la variable $user.

    if ($user) {
        //utilisateur trouvé, démarrer une nouvelle session et rediriger vers une page
        //session_start(); a supprimer
        $_SESSION['user_id'] = $user['id'];
        header("Location: home.php");
      //  exit();
    } else {
        //utilisateur non trouvé, afficher un message d'erreur
        die("Incorrect email or password");
    }
    $mysqli->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">

  <title>Login</title>
</head>

<body>

  <div class="container my-5">

    <h1 class="bg-warning text-white text-center mb-5"> Login</h1>

    <div class="border rounded border-warning p-5">
      <form action="" method="POST" name="login">
     
        <div class="form-row">
          <div class="form-group col-12">
            <label for="email" class="text-warning font-weight-bold">Email</label>
            <input type="email" class="form-control" name="email" placeholder="email@exemple.com" required>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-12">
            <label for="password" class="text-warning font-weight-bold">Password</label>
            <input type="password" class="form-control" name="password" placeholder="****" required>
          </div>
        </div>
  
        <input type="submit" name="submit" value="Login" class="btn btn-warning" />
        <p class="box-register">Are you new here? <a href="index.php">Register</a></p>
       
      </form>
    </div>
  </div>
</body>

</html>