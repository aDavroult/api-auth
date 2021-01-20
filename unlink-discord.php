<?php

    include 'includes/session.inc.php';

    include 'includes/bdd.inc.php';

    require __DIR__ . "/includes/functions.php";
    require __DIR__ . "/includes/discord.php";


    $requete = $bdd -> prepare('SELECT * FROM users WHERE discord_id = :id ');
    $requete -> execute(array(
        'id'=>$_SESSION['user_id'],
    ));

    $donnees = $requete -> fetch();



    $notlinked = "not";
    $req = $bdd->prepare('UPDATE users SET discord_id = null, discord_username = null, discord_tag = null, discord_avatar = null, discord_status=:discord_status WHERE discord_id = :userid');
    $id=$_SESSION['user_id'];
    $req->bindParam(":userid",$id);
    $req->bindParam(":discord_status",$notlinked);
    $req->execute();


    session_start();
    $_SESSION['user-id'] = $donnees['id'];

    $_SESSION['notification'] = '
    <div class="notificationDiscord" role="alert">Discord supprimé !</div>';
    
    redirect("profile.php");

?>