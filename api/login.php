<?php 

header('Content-Type: application/json');

$bdd = new PDO('mysql:host=localhost;dbname=api_auth;charset=utf8', 'root' , '');

if(!empty($_POST['pseudo']) && !empty($_POST['pass'])){

    $requete = $bdd -> prepare('SELECT * FROM users WHERE pseudo = :pseudo ');
    $requete -> execute(array(
        'pseudo'=>$_POST['pseudo'],
    ));

    $donnees = $requete -> fetch();


    if($_POST['pass'] == $donnees['password']){
        
        session_start();
        $_SESSION['user-id'] = $donnees['id'];

        $retour['message'] = 'Connexion réussie !';
        echo json_encode($retour, JSON_PRETTY_PRINT);

    }else{
        $retour['message'] = 'Mot de passe incorrect !';
        echo json_encode($retour, JSON_PRETTY_PRINT);
    }
}else{
    $retour['message'] = 'Les deux champs sont requis !';
    echo json_encode($retour, JSON_PRETTY_PRINT);
}