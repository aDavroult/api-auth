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
include 'includes/functions.php';
include 'includes/discord.php';


 
# Initializing all the required values for the script to work
init ("http://localhost/api-auth/link-discord.php", "801009477456756737", "KgbLPvz4DwxH4Z8WBvalCb9xy1WvJ_Q4");
 


# Fetching user details | (identify scope)
get_user();



$bdd = new PDO('mysql:host=localhost;dbname=api_auth;charset=utf8', 'root', '');


$req = $bdd->prepare('SELECT * FROM users WHERE id = :id');
$id=$_SESSION['user-id'];
$req->bindParam(":id",$id);
$req->execute();

$data=$req->fetch();



	$discordid=$_SESSION['user_id'];
	$req = $bdd->prepare('UPDATE users SET discord_id=:discord_id WHERE id = :userid');
	$id=$_SESSION['user-id'];
	$req->bindParam(":userid",$id);
	$req->bindParam(":discord_id",$discordid);
	$req->execute();

// SI NOUVEAU TAG ALORS L'UPDATE
if($data['discord_tag'] == $_SESSION['discrim']){
}else {
	$tag=$_SESSION['discrim'];
	$req = $bdd->prepare('UPDATE users SET discord_tag=:discord_tag WHERE id = :userid');
	$id=$_SESSION['user-id'];
	$req->bindParam(":userid",$id);
	$req->bindParam(":discord_tag",$tag);
	$req->execute();
}
		
		$linked = "linked";
		$req = $bdd->prepare('UPDATE users SET discord_status=:discord_status WHERE id = :userid');
		$id=$_SESSION['user-id'];
		$req->bindParam(":userid",$id);
		$req->bindParam(":discord_status",$linked);
		$req->execute();

// SI NOUVEAU AVATAR ALORS L'UPDATE
if($data['discord_avatar'] == $_SESSION['user_avatar']){
}else {
	$avatar=$_SESSION['user_avatar'];
	$req = $bdd->prepare('UPDATE users SET discord_avatar=:discord_avatar WHERE id = :userid');
	$id=$_SESSION['user-id'];
	$req->bindParam(":userid",$id);
	$req->bindParam(":discord_avatar",$avatar);
	$req->execute();
}

// SI NOUVEAU PSEUDO ALORS L'UPDATE
if($data['discord_username'] == $_SESSION['username']){
}else {
	$name=$_SESSION['username'];
	$req = $bdd->prepare('UPDATE users SET discord_username=:discord_username WHERE id = :userid');
	$id=$_SESSION['user-id'];
	$req->bindParam(":userid",$id);
	$req->bindParam(":discord_username",$name);
	$req->execute();
}

 
# Fetching user guild details | (guilds scope)
$_SESSION['guilds'] = get_guilds();
 
# Redirecting to home page once all data has been fetched
$_SESSION['notification'] = '
		<div class="notificationDiscord" role="alert">Modifications Discord enregistrées !</div>';
		
redirect("profile.php");
?>
 
 
