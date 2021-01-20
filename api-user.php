<?php 

header('Content-Type: application/json');


$bdd = new PDO('mysql:host=localhost;dbname=api_auth;charset=utf8', 'root' , '');

$req = $bdd->prepare("SELECT pseudo, discord_id, discord_username, discord_tag, age, description,team  FROM users");
$req->execute();

$retour['message'] = "Liste des utilisateurs";
$retour['results'] ['users'] = $req->fetchAll();

echo json_encode($retour, JSON_PRETTY_PRINT);


?>