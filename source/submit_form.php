<?php

// vérifie que les données proviennent bien d'un formulaire 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //variables du formulaire
    $name = trim(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING));
    $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $confirm_password = filter_input(INPUT_POST, 'confirm_password', FILTER_SANITIZE_STRING);
    /* "trim" pour enlever les espaces en début et fin de chaîne de caractères*/
    
     //identifiants mysql
     $host = "database"; 
     $username = "root"; 
     $userpassword = "root"; 
     $database = "form_db"; 
    /* $host = getenv("MYSQL_HOST");
     $username = getenv("MYSQL_ROOT_USER");
     $userpassword = getenv("MYSQL_ROOT_PASSWORD");
     $database = getenv("MYSQL_DATABASE");*/

     //La fonction die() arrête l'exécution du code PHP et affiche le message d'erreur.
     if (!$name) {
        die("Please enter your name");
        }
        if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Please enter a valid email address");
        }
        if (!$password) {
        die("Please enter a password");
        }
        if (!$confirm_password || $password !== $confirm_password) {
        die("Passwords do not match");
        }

    //password_hash() pour hasher le mot de passe avant de l'insérer dans la base de données.
    //$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    //Ouvrir une nouvelle connexion au serveur MySQL
    $mysqli = new mysqli($host, $username, $userpassword, $database);
    //"mysqli" est une extension de PHP qui permet de travailler avec des bases de données MySQL.

    //Afficher toute erreur de connexion
      //La méthode connect_error de l'objet $mysqli est utilisée pour vérifier s'il y a une erreur de connexion.
    if ($mysqli->connect_error) {
        die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
        //Le message d'erreur final aura un format similaire à ceci: Error : (nombre) message d'erreur
    } 

    //préparer la requête d'insertion SQL
        //La méthode prepare() de l'objet $mysqli est utilisée pour préparer la requête SQL
    $statement = $mysqli->prepare("INSERT INTO users (name, email, password) VALUES(?, ?, ?)");
        /*Le caractère "?" est un paramètre à ligaturer. 
        Ils sont utilisés pour insérer les valeurs dans la requête SQL. 
        Cela aide à protéger contre les attaques par injection SQL en échappant les données entrées par l'utilisateur. */

    //Associer les valeurs
    $statement->bind_param('sss', $name, $email, $password );//$hashedPassword
        // "bind_param" permet d'associer des valeurs à des marqueurs( c les ?) dans une requête préparée (ici "INSERT INTO").
        // 's' est un type de données qui indique que les ? sont des chaînes de caractères.

    //la méthode execute() est utilisée pour exécuter la requête d'insertion avec les valeurs associées.
    if($statement->execute()){
        echo "<div class='sucess'>
            <h3>Hello $name</h3>
            <h3> You are successfully registered.</h3>
            <p>Click here to <a href='login.php'>log in</a></p>
       </div>";
        }else{
            print $mysqli->error; 
        } 

  }

?>
