<header class="header-section clearfix">
		<a href="index.php" class="site-logo">
			<img src="http://calais.simplon.co/wp-content/uploads/2020/03/logo-simplon.png" style="max-height:40px" alt="">
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
			<li><a href="api/api-user.php" target="_blank">API USERS</a></li>
			<li><a href="api/api-team.php" target="_blank">API TEAMS</a></li>
			<li><a href="api/api.php" target="_blank">API</a></li>
		</ul>
	</header>