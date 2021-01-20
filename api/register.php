<?php 

header('Content-Type: application/json');

$bdd = new PDO('mysql:host=localhost;dbname=api_auth;charset=utf8', 'root' , '');

//VERIFICATION CORRESPONDANCE DES DEUX MDP
if($_POST['pass'] == $_POST['passverif']){

    $mail=$_POST['mail'];
    $reqmail = $bdd->prepare('SELECT * FROM users WHERE mail = ?');
    $reqmail -> execute(array($mail));
    $mailexiste = $reqmail -> rowCount();

    if ($mailexiste == 0){

        $req=$bdd->prepare('INSERT INTO users (pseudo , mail , password) VALUES (:pseudo, :mail, :password)');
        $req->execute(array(
            'pseudo'=>$_POST['pseudo'],
            'mail'=>$_POST['mail'],
            'password'=>$_POST['pass'],
        ));

        $retour['message'] = 'Votre compte vient est créé !';
        echo json_encode($retour, JSON_PRETTY_PRINT);

    }
    // ERREUR MAIL EXISTE DEJA
    else {
        $retour['message'] = 'Le mail existe deja!';
        echo json_encode($retour, JSON_PRETTY_PRINT);
    }

}else{
    $retour['message'] = 'Les mots de passes ne correspondes pas !';
    echo json_encode($retour, JSON_PRETTY_PRINT);
}