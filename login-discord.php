<?php

/* Discord Oauth v.4.0
 * Demo Login Script
 * @author : MarkisDev
 * @copyright : https://markis.dev
 */
 
# Enabling error display
error_reporting(E_ALL);
ini_set('display_errors', 1);
 
# Including all the required scripts for demo
include 'includes/session.inc.php';
include 'includes/functions-login.php';
include 'includes/discord-login.php';


 
# Initializing all the required values for the script to work
init ("http://localhost/api-auth/login-discord.php", "801009477456756737", "KgbLPvz4DwxH4Z8WBvalCb9xy1WvJ_Q4");
 


# Fetching user details | (identify scope)
get_user();



$bdd = new PDO('mysql:host=localhost;dbname=api_auth;charset=utf8', 'root', '');


$id=$_SESSION['user_id'];
$reqid = $bdd->prepare('SELECT * FROM users WHERE discord_id = ?');
$reqid -> execute(array($id));
$idexiste = $reqid -> rowCount();

if($idexiste == 1){

	$req = $bdd->prepare('SELECT * FROM users WHERE discord_id = :id');
	$id=$_SESSION['user_id'];
	$req->bindParam(":id",$id);
	$req->execute();

	$data = $req->fetch();


	$req = $bdd->prepare('SELECT * FROM users WHERE id = :id');
	$id=$data['id'];
	$req->bindParam(":id",$id);
	$req->execute();

	$data = $req->fetch();

	session_start();

	
	# Fetching user guild details | (guilds scope)
	$_SESSION['guilds'] = get_guilds();
	
	# Redirecting to home page once all data has been fetched
	$_SESSION['notification'] = '
			<div class="notificationDiscord" role="alert">Connexion réussie !</div>';
			
	redirect("profile.php");


}
// ERREUR DISCORD ID INTROUVABLE
else {
	$_SESSION['notification'] = '
	<div class="erreur" role="alert">Compte Discord non trouvé ! Veuillez lier votre compte via votre profil.</div>';
	header("Location: login.php");
}



?>
 
 
