<?php

 include 'includes/session.inc.php';

 include 'includes/bdd.inc.php';

 require __DIR__ . "/includes/functions-login.php";
 require __DIR__ . "/includes/discord-login.php";


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
    <title>Connexion</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i&display=swap" rel="stylesheet">
 
	<link rel="stylesheet" href="assets/css/bootstrap.min.css"/>
	<link rel="stylesheet" href="assets/css/font-awesome.min.css"/>
	<link rel="stylesheet" href="assets/css/slicknav.min.css"/>

	<link rel="stylesheet" href="assets/css/style.css"/>


</head>
<body>
	
<?php include 'includes/header.inc.php'; ?>


    <div class="container">
        <div class="row">
            <div class="col-md-7 col-sm-12 col-xs-12 login-box">
                <div class="col-lg-12 login-icon">
                    <i class="fa fa-key" aria-hidden="true"></i>
                </div>
                <div class="col-lg-12 login-title">
                    CONNEXION
                </div>

                <div class="col-lg-12 login-form">
                    <div class="col-lg-12 login-form">
                    <?php echo $notif;?>
                        <form action='treatment.php' method='post'>
                            <div class="form-group">
                                <label class="form-control-label">PSEUDO</label>
                                <input type="text" class="form-control" name="pseudo" placeholder="Votre pseudonyme">
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">MOT DE PASSE</label>
                                <input type="password" class="form-control" name="pass" placeholder="Votre mot de passe">
                            </div>

                            <div class="col-lg-12 loginbttm" style="text-align:center">
                                <div class="col-lg-12 login-btm login-button">
                                    <button type="submit" name="submit_connexion" class="btn btn-outline-danger">CONNEXION</button>
                                </div>
                                
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="offset-md-1 col-md-4 col-sm-12 col-xs-12 login-box">
                <a href="<?php echo url("801009477456756737", "http://localhost/api-auth/login-discord.php", "identify email guilds"); ?>" class="btn btn-discord w-80 mt-15">Connexion via Discord</a>
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