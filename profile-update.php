<?php

 include 'includes/session.inc.php';

 include 'includes/bdd.inc.php';

 if(isset($_SESSION['user-id']) || isset($_SESSION['user_id'])){

 if(isset($_SESSION['user-id'])){
    //RECUPERATION DES DONNEES VIA ID
    $req = $bdd->prepare('SELECT * FROM users WHERE id = :id');
    $id = $_SESSION['user-id'];
    $req->bindParam(":id",$id);
    $req->execute();

    $data = $req->fetch();


}elseif(isset($_SESSION['user_id'])){
    //RECUPERATION DES DONNEES VIA DISCORD ID
    $req = $bdd->prepare('SELECT * FROM users WHERE discord_id = :id');
    $id = $_SESSION['user_id'];
    $req->bindParam(":id",$id);
    $req->execute();

    $data = $req->fetch();
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <title>Update</title>
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
            <div class="col-lg-3 col-md-2"></div>
            <div class="col-lg-6 col-md-8 login-box">
                <div class="col-lg-12 login-icon">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                </div>
                <div class="col-lg-12 login-title">
                    Modification de votre profil
                </div>

                <div class="col-lg-12 login-form">
                    <div class="col-lg-12 login-form">
                        <form action='treatment.php' method='post' enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="form-control-label">Pseudo</label>
                                <input type="text" class="form-control" name="pseudo" id="pseudo" value="<?= $data['pseudo']?>" placeholder="Votre pseudonyme">
                            </div>

                            <div class="form-group">
                                <label class="form-control-label">Email</label>
                                <input type="text" class="form-control" name="mail" id="mail" value="<?= $data['mail']?>" placeholder="Votre email"/>
                            </div>

                            <div class="form-group">
                                <label class="form-control-label">Age</label>
                                <input type="text" class="form-control" name="age" id="age" value="<?= $data['age']?>" placeholder="Votre âge"/>
                            </div>

                            <div class="form-group">
                                <label class="form-control-label">Description</label>
                                <input type="text" class="form-control" name="description" id="description" value="<?php if(isset($data['description'])){ echo $data['description'];}?>" placeholder="Votre description"/>
                            </div>

                            <div class="form-group">
                                <label class="form-control-label">Choisir une équipe:</label>
                                <select name="team" id="team" class="form-control">
                                    <option value="Aucune">Aucune</option>
                                    <option <?php if($data['team'] == 'G2 Esports') { echo 'selected';}?> value="G2 Esports">G2 Esports</option>
                                    <option <?php if($data['team'] == 'Team Vitality') { echo 'selected';}?> value="Team Vitality">Team Vitality</option>
                                    <option <?php if($data['team'] == 'Team Liquid') { echo 'selected';}?> value="Team Liquid">Team Liquid</option>
                                    <option <?php if($data['team'] == 'Fnatic') { echo 'selected';}?> value="Fnatic">Fnatic</option>
                                </select>
                            </div>

                            <div class="col-lg-12 loginbttm text-center mt-15">
                                <div class="col-lg-6 login-btm login-button">
                                    <a href="profile.php" class="btn btn-outline-danger w-80">RETOUR</a>
                                </div>
                                <div class="col-lg-6 login-btm login-button">
                                    <button type="submit" name="update_profile" class="btn btn-outline-danger w-80">SAUVEGARDER</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
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

<?php }else{ ?>

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



<h2 class="text-center teams-title">PAGE NON ACCESSIBLE</h2>

<div class="container">
<div class="row">

    <div class="col-lg-12 loginbttm text-center mt-15">
        <div class="col-lg-6 login-btm login-button">
            <a href="profile.php" class="btn btn-outline-danger w-80">RETOUR</a>
        </div>
        <div class="col-lg-6 login-btm login-button">
            <a href="login.php" class="btn btn-outline-danger w-80">SE CONNECTER</a>
        </div>
    </div>

</div>
</div>

    <?php 
        $_SESSION['notification'] = NULL ;
    ?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script type="text/javascript" src="assets/js/jquery.slicknav.min.js"></script>
<script src="assets/js/main.js"></script>

</body>
</html>




<?php } ?>