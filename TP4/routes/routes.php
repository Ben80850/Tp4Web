<?php

Flight::route('./', function(){
    Flight::render("index.tpl",array());
});

Flight::route('GET /register', function(){

    Flight::render("register.tpl",array());

});

Flight::route('POST /register', function() // Formulaire
{

    $messages=array();
    //Recup des donnees
    $data = Flight::request()->data;
    
    if(empty($data->nom)) //On regarde si la case nom est bien remplie
    {
        $messages['nom'] = "le nom doit être rempli";
    }
    if(empty($data->email))
    
    {
        $messages['email'] = "l'email doit être rempli";
    }
    if(strlen($data->psw) < 8) // On cache le mdp et celui-ci doit faire plus de 8 caracteres
    {
        $messages['psw'] = "le password doit être rempli avec plus de 8 catactères";
    }
   
    if(!(filter_var($data->email, FILTER_VALIDATE_EMAIL))) // On vérifie si l'addresse mail est bien valide
    {
        $messages['email'] = "l'email n'est pas correct";
    }

    if(empty($data->ville))
    {
        $messages['ville'] = "la ville doit être rempli";
    }

    if(empty($data->pays))
    {
        $messages['pays'] = "le pays doit être rempli";
    }
    

    require('../../includes/pdo.php');
    $db = new PDO("mysql:host=$dbHost;port=$dbPort;dbname=$dbName;charset=utf8", "$dbUser", "$dbPassword"); //Appel de la base

    $stmt = $db -> prepare("SELECT email FROM utilisateur WHERE utilisateur.email = :email"); // Requete SQL ou on sélectionne que l'email dans la table
    $stmt -> execute(array(':email'=>$data->email)); // On execute la requete

    
    if($stmt->rowCount() > 0) // On regarde si l'email entree par l'utilisateur existe dans la base
    {
        $messages['email'] = "l'email est déjà utilise";
    }

    if(empty($messages)) // Si aucun message d'erreur
    {
        $stmt = $db -> prepare("insert into utilisateur values(:nom,:email,:psw,:ville,:pays)"); // Requete pour entrer les donnees saisie dans la base
        $stmt -> execute(array(':nom'=>$data->nom,':email'=>$data->email,':psw'=>password_hash($data->psw, PASSWORD_BCRYPT),':ville'=>$data->ville,':pays'=>$data->pays)); // On execute
        Flight::redirect('/success');
    }
    else
    {
        Flight::render("register.tpl", array('messages'=>$messages, 'data'=>$data)); // Si messages d'erreur quand on clique sur le butoon on renvoie vers la meme pages et on affiche les erreurs
    }  
});



Flight::route('GET /fichier', function(){
    Flight::render("fichier.tpl",array());
});

Flight::route('GET /login', function(){
    Flight::render("login.tpl",array());
});

Flight::route('POST /login', function() // Connexion

{

    $messages=array();
    // Recup des donnees saisies
    $data = Flight::request()->data;

    if(empty($data->email))
    {
        $messages['email'] = "l'email doit être rempli";
    }

    if(strlen($data->psw) < 8)
    {
        $messages['psw'] = "le password doit être rempli avec plus de 8 catactères";
    }

    require('../../includes/pdo.php');

    $db = new PDO("mysql:host=$dbHost;port=$dbPort;dbname=$dbName;charset=utf8", "$dbUser", "$dbPassword");

    $reponse = $db -> prepare("SELECT email FROM utilisateur WHERE utilisateur.email = :email");
    $reponse -> execute(array(':email'=>$data->email));

    if ($reponse->rowCount()> 0) //On regarde si l'email saisie est dans la bdd
    {
        $mdp = $db->prepare("SELECT * FROM utilisateur WHERE utilisateur.email = :email"); //Requete ou on sélectionne toute les donnes par rapport à l'email saisie
        $mdp -> execute(array(':email' => $data ->email));
        $log = $mdp -> fetch(); // Permet de chercher le mdp par rapport à l'email de l'utilisateur

        if(password_verify($data->psw,$log['motdepasse']))// On vérifie si le mdp est le meme
        {
            $_SESSION['user'] = array(
                'nom' => $log['nom']); // On donne le nom de l'utilisateur à la session
            Flight::redirect('/');
        }
        else
        {
            $messages['psw'] = "Mauvais mot de passe";

        }

    }
    else
    {
        $messages['email'] = "L'adresse mail n'existe pas";

    }


    if(!empty($messages)) // Si message d'erreur renvoie vers la meme page et affiche les erreurs
    {
        Flight::render("login.tpl", array('messages'=>$messages, 'data'=>$data));
    }
});

Flight::route('GET /profil', function()
{
    if (isset($_SESSION['user'])) // Vérifie si l'utilisateur est bien connecte
    {

        $messages=array();
        //Recup des donnees
        $data = Flight::request()->data;
        $test = $_SESSION['user']; // On donne une variable à la session pour pouvoir l'utiliser

        require('../../includes/pdo.php');
        $db = new PDO("mysql:host=$dbHost;port=$dbPort;dbname=$dbName;charset=utf8", "$dbUser", "$dbPassword");//Appel de la base

        $info = $db -> prepare("SELECT * FROM utilisateur WHERE utilisateur.nom = :nom"); // On sélectionne tout les donnees par rapport au nom de l'utilisateur
        $info -> execute(array(':nom'=>$test['nom'])); //On execute la requete par rapport au nom de l'utilisateur
        $information = $info->fetch(); // On cherchee les donnes par rapport au nom et on les donnes à la variable information
        Flight::render("profil.tpl",array('info' => $information)); // On envoie les donnes de la variable sur la page
    }
    else
        Flight::redirect("/login");

});

Flight::route('GET /success', function(){
    Flight::render("success.tpl",array());
});

Flight::route('GET /logout', function(){
    unset($_SESSION['user']);// Permet de détruire la variable session[User]
    Flight::redirect('/');
});





?>
