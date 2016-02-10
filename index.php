//romaric
<?php
session_start (); // Ouverture des sessions
include ('connexion.php');

?>
// mode commit

<?php

if (isset ( $_GET ['deco'] ) && isset ( $_SESSION ['cliid'] )) {
	
	$date = new DateTime ( 'now Africa/Libreville' );
	$dat = date ( "d-m-Y" );
	$heur = $date->format ( 'H:i:s' );
	$dote = $dat . ' a ' . $heur; // commin
	
	$reqe = $bdd->prepare ( 'UPDATE admin SET heurde=:heurde WHERE id = :id' );
	$reqe->execute ( array (
			':heurde' => $dote,
			':id' => $_SESSION ['cliid'] 
	) );
	
	$_SESSION = array ();
	@session_destroy ();
}

?>

<?php

if (isset ( $_POST ['login'], $_POST ['mdp'] )) // Si le formulaire est soumis
{
	if (! empty ( $_POST ['login'] ) && ! empty ( $_POST ['mdp'] )) {
		
		$login = htmlspecialchars ( $_POST ['login'] );
		$mdp = htmlspecialchars ( $_POST ['mdp'] );
		
		$login_q = $bdd->prepare ( "SELECT * FROM admin WHERE login = :login ;" );
		$login_q->execute ( array (
				'login' => $login 
		) );
		
		$data = $login_q->fetch ();
		
		if (password_verify ( $mdp, $data ['mdp'] )) {
			$_SESSION ['login'] = $data ['login'];
			$_SESSION ['level'] = $data ['level'];
			$_SESSION ['cliid'] = $data ['id'];
			
			$date = new DateTime ( 'now Africa/Libreville' );
			$dat = date ( "d-m-Y" );
			$heur = $date->format ( 'H:i:s' );
			$dotey = $dat . ' a ' . $heur;
			
			$reqef = $bdd->prepare ( 'UPDATE admin SET heurco=:heurco WHERE id = :id' );
			$reqef->execute ( array (
					':heurco' => $dotey,
					':id' => $data ['id'] 
			) );
			
			header ( 'Location:accueil.php' ); // Redirection
		} else {
			?>
<script>

			window.onload = function () {

		$.gritter.add({
			// (string | mandatory) the heading of the notification
			title: '',
			// (string | mandatory) the text inside the notification
			text: '<h3>Login ou Mot de passe incorrecte</h3>'
		});

		 }


</script>
<?php
		}
		/*
		 * if(($mdp) == $data['mdp'])
		 * {
		 * $_SESSION['login'] = $data['login'];
		 * $_SESSION['level']= $data['level'];
		 * header('Location:accueil.php');# Redirection
		 * }
		 * else
		 * {
		 * echo "mot de passe ou login incorrect";
		 * }
		 */
	}
}

/*
 * if($login_q->fetchColumn() > 0) # Si login pass et valid ok
 * {
 * $user = $login_q->fetch(PDO::FETCH_OBJ);
 *
 * $token = sha1(uniqid().$user->id.sha1(uniqid()));
 * setcookie('token', $token, time()+3600); # Création des cookies
 * $user_id = $user->id;
 * $setToken_q = $bdd->prepare("UPDATE admin SET token = :token, token_date = NOW() WHERE id = :user_id");
 * $setToken_q->execute(array(
 * 'token' => $token,
 * 'user_id' => $user_id
 * ));
 * $token = null;
 * $_SESSION['login'] = $user->login; # Création des sessions
 *
 * header('Location: accueil.php'); # Redirection
 *
 * exit();
 * }
 * else # Sinon
 * {
 * # Login ou Mot de passe incorrect
 * echo "mot de passe ou login incorrect";
 * }
 *
 */

?>

























<!DOCTYPE html>
<html lang="en">
<head>

<!-- start: Meta -->
<meta charset="utf-8">
<title>Auto</title>
<meta name="description" content="Bootstrap Metro Dashboard">
<meta name="author" content="JetDConsulting">
<meta name="keyword"
	content="Metro, Metro UI, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
<!-- end: Meta -->

<!-- start: Mobile Specific -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- end: Mobile Specific -->

<!-- start: CSS -->
<link id="bootstrap-style" href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
<link id="base-style" href="css/style.css" rel="stylesheet">
<link id="base-style-responsive" href="css/style-responsive.css"
	rel="stylesheet">
<!-- end: CSS -->


<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
	  	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<link id="ie-style" href="css/ie.css" rel="stylesheet">
	<![endif]-->

<!--[if IE 9]>
		<link id="ie9style" href="css/ie9.css" rel="stylesheet">
	<![endif]-->

<!-- start: Favicon -->
<link rel="shortcut icon" href="img/favicon.ico">
<!-- end: Favicon -->

<style type="text/css">
body {
	background: url(img/fond.jpg) top fixed;
	width: 100%;
	height: 100%;
	position: relative;
	opacity: 1;
	background-color: rgba(0, 0, 0, 0);
	background-size: cover;
	background-position: 50% 50%;
	background-repeat: no-repeat;
	"
}
</style>



</head>

<body>
	<div class="container-fluid-full">
		<div class="row-fluid">

			<div class="row-fluid">
				<div class="login-box">
					<div class="icons">
						<a href="index.php"><i class="halflings-icon home"></i></a> <a
							href="#"><i class="halflings-icon cog"></i></a>
					</div>
					<h2>Login et mot de passe</h2>
					<form class="form-horizontal" action="index.php" method="post">
						<fieldset>

							<div class="input-prepend" title="Username">
								<span class="add-on"><i class="halflings-icon user"></i></span>
								<input class="input-large span10" name="login" id="username"
									type="text" placeholder="login" />
							</div>
							<div class="clearfix"></div>

							<div class="input-prepend" title="Password">
								<span class="add-on"><i class="halflings-icon lock"></i></span>
								<input class="input-large span10" name="mdp" id="password"
									type="password" placeholder="mot de passe" />
							</div>
							<div class="clearfix"></div>

							<!--	<label class="remember" for="remember"><input type="checkbox" id="remember" />Remember me</label>-->

							<div class="button-login">
								<button type="submit" class="btn btn-primary">Envoyer</button>
							</div>
							<div class="clearfix"></div>
					
					</form>
					<hr>
					<h3></h3>
					<!--
					<p>
						No problem, <a href="#">click here</a> to get a new password.
					</p>
					-->
				</div>
				<!--/span-->
			</div>
			<!--/row-->


		</div>
		<!--/.fluid-container-->

	</div>
	<!--/fluid-row-->
	<div class="common-modal modal fade" id="common-Modal1" tabindex="-1"
		role="dialog" aria-hidden="true">
		<div class="modal-content">
			<ul class="list-inline item-details">
				<li><a href="http://themifycloud.com">Admin templates</a></li>
				<li><a href="http://themescloud.org">Bootstrap themes</a></li>
			</ul>
		</div>
	</div>
	<!-- start: JavaScript-->

	<script src="js/jquery-1.9.1.min.js"></script>
	<script src="js/jquery-migrate-1.0.0.min.js"></script>

	<script src="js/jquery-ui-1.10.0.custom.min.js"></script>

	<script src="js/jquery.ui.touch-punch.js"></script>

	<script src="js/modernizr.js"></script>

	<script src="js/bootstrap.min.js"></script>

	<script src="js/jquery.cookie.js"></script>

	<script src='js/fullcalendar.min.js'></script>

	<script src='js/jquery.dataTables.min.js'></script>

	<script src="js/excanvas.js"></script>
	<script src="js/jquery.flot.js"></script>
	<script src="js/jquery.flot.pie.js"></script>
	<script src="js/jquery.flot.stack.js"></script>
	<script src="js/jquery.flot.resize.min.js"></script>

	<script src="js/jquery.chosen.min.js"></script>

	<script src="js/jquery.uniform.min.js"></script>

	<script src="js/jquery.cleditor.min.js"></script>

	<script src="js/jquery.noty.js"></script>

	<script src="js/jquery.elfinder.min.js"></script>

	<script src="js/jquery.raty.min.js"></script>

	<script src="js/jquery.iphone.toggle.js"></script>

	<script src="js/jquery.uploadify-3.1.min.js"></script>

	<script src="js/jquery.gritter.min.js"></script>

	<script src="js/jquery.imagesloaded.js"></script>

	<script src="js/jquery.masonry.min.js"></script>

	<script src="js/jquery.knob.modified.js"></script>

	<script src="js/jquery.sparkline.min.js"></script>

	<script src="js/counter.js"></script>

	<script src="js/retina.js"></script>

	<script src="js/custom.js"></script>
	<!-- end: JavaScript-->

</body>
</html>
