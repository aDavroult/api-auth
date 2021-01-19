<?php

//INCLUSION SESSION
include 'includes/session.inc.php';

//INCLUSION BASE DE DONNÉE
include 'includes/bdd.inc.php';

    

    
        //CREATION DU COMPTE
        if(isset($_POST['submit_inscription'])){

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

                    $req = $bdd->prepare('SELECT * FROM users WHERE mail = :mail AND pass = :pass');
                    $req->execute(array(
                        ':mail' => $_POST['mail'],
                        ':pass' => $_POST['pass'],
                        ));

                    $resultat = $req->fetch();

                    session_start();
                    $_SESSION['user-id'] = $resultat['id'];

                    $_SESSION['notification'] = '
                    <div class="succes" role="alert">Votre compte vient est créé !</div>';
                    header("Location: login.php");

                }
                // ERREUR MAIL EXISTE DEJA
                else {
                    $_SESSION['notification'] = '
                    <div class="erreur" role="alert">Le mail existe deja!</div>';
                    header("Location: register.php");
                }

            }else{
                $_SESSION['notification'] = '
                <div class="erreur" role="alert">Les mots de passes ne correspondes pas !</div>';
    
                header("Location: register.php");
            }
        }

	// CONNEXION
	if(isset($_POST['submit_connexion'])){

		$requete = $bdd -> prepare('SELECT * FROM users WHERE pseudo = :pseudo ');
		$requete -> execute(array(
			'pseudo'=>$_POST['pseudo'],
		));

        $donnees = $requete -> fetch();


		if($_POST['pass'] == $donnees['password']){
            
           session_start();
            $_SESSION['user-id'] = $donnees['id'];
			$_SESSION['notification'] = '
			<div class="notification" role="alert">Connexion réussie !</div>';

			header("Location: profile.php");
		}else{
			$_SESSION['notification'] = '
			<div class="erreur" role="alert">Mot de passe incorrect !</div>';
			header("Location: login.php");
		}
		
	}


	// MISE A JOUR DES DONNEES
	if(isset($_POST['update_profile'])){

			$pseudo = $_POST['pseudo'];
			$mail = $_POST['mail'];
			$age = $_POST['age'];
			$description = $_POST['description'];
			$team = $_POST['team'];
			$req = $bdd->prepare('UPDATE users SET pseudo=:pseudo, mail=:mail, age=:age, description=:description ,team=:team WHERE id=:id');
			$id = $_SESSION['user-id'];
			$req->bindParam(":id",$id);
			$req->bindParam(":pseudo",$pseudo);
			$req->bindParam(":mail",$mail);
			$req->bindParam(":age",$age);
			$req->bindParam(":description",$description);
			$req->bindParam(":team",$team);
			$req->execute();

			$_SESSION['notification'] = "
			<div class='succes' role='alert'>Profil mis à jour !</div>";
			
			header("Location: profile.php");

	}
	
    
    // DECONNEXION
    if(isset($_GET['disconnection'])){

		$_SESSION = array();
		
		if (ini_get("session.use_cookies")) {
			$params = session_get_cookie_params();
			setcookie(session_name(), '', time() - 42000,
				$params["path"], $params["domain"],
				$params["secure"], $params["httponly"]
			);
		}

        session_destroy();
		
        $_SESSION['notification'] = '
        <div class="notification" role="alert">A+ !</div>';

        header("Location: index.php");
    }

?>