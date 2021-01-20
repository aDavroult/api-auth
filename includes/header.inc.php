<header class="header-section clearfix">
		<a href="index.html" class="site-logo">
			<img src="img/logo.png" alt="">
		</a>
		<div class="header-right">
		<?php if(isset($_SESSION['user-id'])  || (isset($_SESSION['user_id']))){ ?>
			<div class="user-panel">
				<a href="profile.php" class="login">Mon profil</a>
				<span>|</span>
				<a href="treatment.php?disconnection" class="register">Deconnexion</a>
			</div> 
		<?php }else{?>
			<div class="user-panel">
				<a href="login.php" class="login">Connexion</a>
				<span>|</span>
				<a href="register.php" class="register">Inscription</a>
			</div> 
		<?php }?>
		</div>
		<ul class="main-menu">
			<li><a href="index.php">Accueil</a></li>
			<li><a href="teams.php">Equipes</a></li>
		</ul>
	</header>