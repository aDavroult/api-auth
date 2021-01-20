<?php 

header('Content-Type: application/json');


$bdd = new PDO('mysql:host=localhost;dbname=api_auth;charset=utf8', 'root' , '');

$req = $bdd->prepare("SELECT * FROM teams");
$req->execute();

$retour['message'] = "Liste des equipes";
$retour['results'] ['teams'] = $req->fetchAll();

echo json_encode($retour, JSON_PRETTY_PRINT);


?>