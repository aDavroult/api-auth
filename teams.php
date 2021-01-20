<?php

 include 'includes/session.inc.php';

 include 'includes/bdd.inc.php';




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
	<title>Equipes</title>
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

    <h2 class="text-center teams-title">Les équipes</h2>

    <div class="container">
        <div class="row">

        <?php
            $reqteam = $bdd->prepare('SELECT * FROM teams');
            $reqteam->execute();
        
        
            while($datateam=$reqteam->fetch()) {

            $team = $datateam['name'];
            $reqnumber = $bdd->prepare('SELECT * FROM users WHERE team = ?');
            $reqnumber -> execute(array($team));
            $playernumber = $reqnumber -> rowCount();

            ?>

        
            <div class="col-md-3 col-sm-12">
                <div class="wpc-wrap-blog blog">
                    <div class="wrapperdash">
                        <center>
                            <div class="heading blog">
                                <img src="<?=$datateam['img']?>" height="100px">
                            </div>
                        </center>
                        <hr>
                        <div class="text-center">
                            <font color="white">
                                <?=$datateam['name']?>
                            </font>
                        </div>    
                        <hr>
                        <div class="text-center">
                            <font color="white">
                                <?php if($playernumber == 0){ ?>
                                    Aucun joueur
                                <?php }else{ ?>
                                    Nombre de joueurs : <?=$playernumber?>
                                <?php } ?>
                            </font>
                        </div>   
                    </div>
                </div>
            </div>

            <?php } ?>


            </div>
        </div>






<?php 
    $_SESSION['notification'] = NULL ;
?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script type="text/javascript" src="assets/js/jquery.slicknav.min.js"></script>
<script type="text/javascript" src="assets/js/main.js"></script>

</body>
</html>