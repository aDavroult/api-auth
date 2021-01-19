<?php

 include 'includes/session.inc.php';

 include 'includes/bdd.inc.php';

 require __DIR__ . "/includes/functions.php";
 require __DIR__ . "/includes/discord.php";

	if(isset($_SESSION['user-id'])){
    //RECUPERATION DES DONNEES
    $req = $bdd->prepare('SELECT * FROM users WHERE id = :id');
    $id = $_SESSION['user-id'];
    $req->bindParam(":id",$id);
    $req->execute();

	$data = $req->fetch();
	
	}

?>



<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <title>Profil de <?=$data['pseudo']?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Overpass:wght@600&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css"/>
	<link rel="stylesheet" href="assets/css/font-awesome.min.css"/>
	<link rel="stylesheet" href="assets/css/slicknav.min.css"/>

	<link rel="stylesheet" href="assets/css/style.css"/>


</head>
<body>
	
<?php include 'includes/header.inc.php'; ?>

<?php echo $notif;?>




<div class="container">
    <div class="row">
        <div class="col-md-12 text-center mt-5 mb-5">
            <i class="fa fa-user-circle fa-5x pink-icon" aria-hidden="true"></i>
            <h1 style="text-transform:uppercase">PROFIL DE <?=$data['pseudo']?></h1>
        </div>    

        <div class="col-md-7 col-sm-12 col-xs-12 profile-box">
            <h4>Mes informations :</h4>
            <hr>
            <p><span class="profile-label">Mon pseudo :</span> <?=$data['pseudo']?></p>
            <p><span class="profile-label">Mon adresse mail :</span> <?=$data['mail']?></p>

            <?php if(isset($data['age'])){ ?>
                <p><span class="profile-label">Mon âge :</span> <?=$data['age']?></p>
            <?php }else{ ?>
                <p><span class="profile-label">Mon âge :</span> Non défini</p>
            <?php } ?>

            <?php if(isset($data['team'])){ ?>
                <p><span class="profile-label">Mon équipe :</span> <?=$data['team']?></p>
            <?php }else{ ?>
                <p><span class="profile-label">Mon équipe :</span> Aucune</p>
            <?php } ?>

            <?php if(isset($data['description'])){ ?>
                <p><span class="profile-label">Description :</span> <?=$data['description']?></p>
            <?php }else{ ?>
                <p><span class="profile-label">Description :</span> Aucune</p>
            <?php } ?>
            <hr>

            <?php if($data['discord_status'] == 'linked'){?>
                <p><span class="profile-label">Discord lié</span> <span class="green-text"><i class="fa fa-check" aria-hidden="true"></i></span></p>
                <p><span class="profile-label">ID discord :</span> <?=$data['discord_id']?></p>
                <p><span class="profile-label">Pseudo discord :</span> <?=$data['discord_username']?></p>
                <div class="col-lg-6 text-center discord-button">
                    <a href="<?php echo url("801009477456756737", "http://localhost/api-auth/link-discord.php", "identify email guilds"); ?>" class="btn btn-discord w-80">Mettre à jour Discord</a>
                </div>
            <?php }else{ ?>
                <p><span class="profile-label">Discord lié :</span> <span class="red-text"><i class="fa fa-times" aria-hidden="true"></i></span></p>
                <div class="col-lg-6 text-center discord-button">
                    <a href="<?php echo url("801009477456756737", "http://localhost/api-auth/link-discord.php", "identify email guilds"); ?>" class="btn btn-discord w-80">Lier mon compte Discord</a>
                </div>
            <?php } ?>
            
        </div>


        <div class="offset-md-1 col-md-4 col-sm-12 col-xs-12 profile-box text-center">
            <?php if(isset($data['discord_avatar'])){ ?>
                <img src="https://cdn.discordapp.com/avatars/<?php $extention = is_animated($data['discord_avatar']); echo $data['discord_id'] . "/" . $data['discord_avatar'] . $extention; ?>">
            <?php }else{ ?>
                <img src="assets/img/default_avatar.png">
            <?php } ?>
        </div>
        
        <?php if($data['role'] == 'admin'){ ?>
            <div class="col-md-7 col-sm-12 col-xs-12 padding-0">
                <a href="profile-update.php">
                    <div class="profile-box text-center red-hover">
                            <h4>Modifier mon profil</h4>
                    </div>
                </a>
            </div>
            <div class="offset-md-1 col-md-4 col-sm-12 col-xs-12 padding-0">
                <a href="admin/index.php">
                    <div class="profile-box text-center red-hover">
                            <h4>Administration</h4>
                    </div>
                </a>
            </div>
        <?php }else{ ?>
            <div class="col-md-12 col-sm-12 col-xs-12 padding-0">
                <a href="profile-update.php">
                    <div class="profile-box text-center red-hover">
                            <h4>Modifier mon profil</h4>
                    </div>
                </a>
            </div>
        <?php } ?>
    </div>
</div>

        <?php 
            $_SESSION['notification'] = NULL ;
        ?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script src="assets/js/main.js"></script>

</body>
</html>