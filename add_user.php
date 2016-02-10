<?php
session_start(); # Ouverture des sessions
include('connexion.php');
if(!$_SESSION['login']){
header('Location:index.php');
exit();
}
if($_SESSION['level']==1){
header('Location:index.php');
exit();
}

?>


<?php
$i=0;
$p='';
if(isset($_POST['submit']))
{
	
    if(!empty($_FILES['photo']['size']))
    {
    $maxsize = 100244; //Poid de l'image
    $maxwidth = 3500; //Largeur de l'image
    $maxheight = 3500; //Longueur de l'image
    $extensions_valides = array('jpg','png');
            if($_FILES['photo']['error'] > 0)
            {
                $i++;
            $avatar_erreur1 = "Une erreur est survenu lors du transfert";
            }
            if($_FILES['photo']['error'] > $maxsize)
            {
                $i++;
            $avatar_erreur1 = " votre fichier est trop grand ".$_FILES['avatar']['error']." octets contre ".$maxsize." octets";
            }
            $image_sizes = getimagesize($_FILES['photo']['tmp_name']);
            if ($image_sizes[0] > $maxwidth OR $image_sizes[1] > $maxheight)
            {
               $i++;
            $avatar_erreur3 = " vérifier la taille de votre fichier ".$image_sizes[0]." x contre ".$maxwidth." octets".$image_sizes[1]." x contre ".$maxheight." octets";
            }
            $extension_upload = strtolower(substr(strrchr($_FILES['photo']['name'],'.') ,1));
            if(!in_array($extension_upload,$extensions_valides))
            {
                $i++;
            $avatar_erreur4 = "Extension de l\'avatar non prise en charge";
            }
        }
        else
            $_FILES['photo']['name'] = 'avatar.jpg';
		
       if ($_POST['mdp']==$_POST['mdp2']){
	   if($i == 0)
        {  
	
$infosfichier = pathinfo($_FILES['photo']['name']);
			$extension = $infosfichier['extension'];
if($_FILES['photo']['name'] !='avatar.jpg'){
			
			
			$chai='abcdefghijklmnopqrstuvwz0123456789';
			$mo= str_shuffle($chai);
			$mi= str_shuffle($chai);
			$p=substr($mo,0,3);		
			$mu=substr($mi,0,3);
			
			
			$_FILES['photo']['name']= $p.$mu.'.'.$extension;
		}
//grain de sel
/*
<?php $pass = sha1($pseudo.$pass);
*/	

/*
 Notez que le salt est généré aléatoirement.
 * Ne jamais utiliser un salt statique, ou un qui ne serait pas généré aléatoirement.
 *
 * Pour la grande majorité des cas, laissez la fonction password_hash générer le salt
 * aléatoirement à votre place
 
 $options = [
    'cost' => 11,
    'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
];
echo password_hash("rasmuslerdorf", PASSWORD_BCRYPT, $options)."\n";
  afiche: $2y$11$q5MkhSBtlsJcNEVsYh64a.aCluzHnGog7TQAKVmQwO9C8xb.t89F.
 
 
 
 
 Ce code va tester votre serveur pour déterminer quel serait le meilleur "cost".
 * Vous souhaitez définir le "cost" le plus élevé possible sans trop ralentir votre serveur.
 * 8-10 est une bonne base, mais une valeur plus élevée est aussi un bon choix à partir
 * du moment où votre serveur est suffisament rapide ! Le code suivant espère un temps
 * ≤ à 50 millisecondes, ce qui est une bonne base pour les systèmes gérants les identifications
 * intéractivement.
 
 $timeTarget = 0.05; // 50 millisecondes

$cost = 8;
do {
    $cost++;
    $start = microtime(true);
    password_hash("test", PASSWORD_BCRYPT, ["cost" => $cost]);
    $end = microtime(true);
} while (($end - $start) < $timeTarget);

echo "Valeur de 'cost' la plus appropriée : " . $cost . "\n";
afiche: Valeur de 'cost' la plus appropriée : 10

//pour verifier
$password = '@zErt|123';
$hash = '$2y$10$0XPjx7G0kX1OxopwGQbsIehW/D1X95vajb45APWz5EZx.aJpXEdli';

if (password_verify($password, $hash)) {
    echo "OK";
}
else {
    echo "KO";
}



*/



$timeTarget = 0.05; // 50 millisecondes

$cost = 8;
do {
    $cost++;
    $start = microtime(true);
    password_hash("test", PASSWORD_BCRYPT, ["cost" => $cost]);
    $end = microtime(true);
} while (($end - $start) < $timeTarget);

$options = [
    'cost' => $cost,
    'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
];
$hash= password_hash($_POST['mdp'], PASSWORD_BCRYPT, $options);


//pour verifier
/*
$password = 'rasmuslerdorf';

if (password_verify($password, $hash)) {
    echo "OK";
}
else {
    echo "KO";
}
*/


$req = $bdd->prepare('INSERT INTO admin(nom, prenom,
tel, login, photo,mdp,mail,level) VALUES(UPPER(:nom),
UPPER(:prenom), :tel, :login, :photo, :mdp, :mail, :level)');
$req->execute(array(
'nom' => $_POST['nom'],
'prenom' => $_POST['prenom'],
'tel' => $_POST['tel'],
'login' => $_POST['login'],
'photo' => $_FILES['photo']['name'],
'mdp' => $hash,
'mail' => $_POST['email'],
'level' => $_POST['status']
));

//reduire la taillede l'image
if(!empty($_FILES['photo']['tmp_name'])){
if($extension=='jpg' || $extension=='JPG' || $extension=='jpeg' || $extension=='JPEG'    )	
    $source = imagecreatefromjpeg($_FILES['photo']['tmp_name']); // La photo est la source
else 
	$source = imagecreatefrompng($_FILES['photo']['tmp_name']); // La photo est la source


$destination = imagecreatetruecolor(500, 500); // On crée la miniature vide
// Les fonctions imagesx et imagesy renvoient la largeur et la hauteur d'une image
$largeur_source = imagesx($source);
$hauteur_source = imagesy($source);
$largeur_destination = imagesx($destination);
$hauteur_destination = imagesy($destination);
// On crée la miniature
imagecopyresampled($destination, $source, 0, 0, 0, 0,
$largeur_destination, $hauteur_destination, $largeur_source,
$hauteur_source);
// On enregistre la miniature sous le nom "mini_couchersoleil.jpg"
if($extension=='jpg' || $extension=='JPG' || $extension=='jpeg' || $extension=='JPEG'    )
	imagejpeg($destination, 'img/user/'. basename($_FILES['photo']['name']),72);
else
	imagepng($destination, 'img/user/'. basename($_FILES['photo']['name']),9);

//imagejpeg($destination, "mini_couchersoleil.jpg");
}
//$id = $connexion -> id() ;

//sms
 //system('echo Bienvenu '.$_POST['nom'].' '.$prenom.' vous êtes le nouveaux gestionnaire voici votre mot de passe: azertyuiop  | "C:\Program Files (x86)\Gammu 1.33.0\bin\gammu.exe" --sendsms TEXT +24106127676');  //il fo que le fichier de configuration gammurc se trouve avec le fichier sms.php
 //system('echo Bienvenue '.$_POST['nom'].' '.$_POST['prenom'].' vous etes le nouveaux gestionnaire de l application de parc automobile de BANGA Romaric voici votre login: '.$_POST['login'].', mot de passe: azertyuiop | "C:\Program Files (x86)\Gammu 1.33.0\bin\gammu.exe" --sendsms TEXT +24104399599');  //il fo que le fichier de configuration gammurc se trouve avec le fichier sms.php
system('echo Bienvenue '.$_POST['nom'].' '.$_POST['prenom'].' sur l application GAFA voici votre login: '.$_POST['login'].', mot de passe:'.$_POST['mdp'].' | "C:\Program Files (x86)\Gammu 1.33.0\bin\gammu.exe" --sendsms TEXT '.$_POST['tel'].'');  //il fo que le fichier de configuration gammurc se trouve avec le fichier sms.php

 //mail
 
 $sujet = 'Inscription';
$message = 'Bonjour '.$_POST['nom'].',<br />
<strong>Bienvenue sur l application de gestion de parc automobile GAFA. voici votre login: '.$_POST['login'].' et votre mot de passe: '.$_POST['mdp'].' .</strong><br />
merci :)';
$destinataire = $_POST['email'];
$headers = "From: \"GAFA\"<bangaromaric@gmail.com>\n";
$headers .= "Reply-To: bangaromaric@gmail.com\n";
$headers .= "Content-Type: text/html; charset=\"iso-8859-1\"";
if(mail($destinataire,$sujet,$message,$headers))
{
        echo "L'email a bien été envoyé.";
}
else
{
        echo "Une erreur c'est produite lors de l'envois de l'email.";
}




	?>	
		
		 
	<script>	
		
		window.onload = function () { 
		 
		$.gritter.add({
			// (string | mandatory) the heading of the notification
			title: '',
			// (string | mandatory) the text inside the notification
			text: '<h3>Enregistrement reussit</h3>'
		});

		 }


</script>		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
	<?php										
        }
        else
        {
            header('Location:accueil.php') ;
            exit();
        }

}
else{
	?>
	


<script>	
		
			window.onload = function () { 
		 
		$.gritter.add({
			// (string | mandatory) the heading of the notification
			title: '',
			// (string | mandatory) the text inside the notification
			text: '<h3>Mot de passe incorrect<h3>'
		});

		 }


</script>		 
		 



<?php

}
}




?>





<!DOCTYPE html>
<html lang="en">
<head>
	
	<!-- start: Meta -->
	<meta charset="utf-8">
	<title>Bootstrap Metro Dashboard by Dennis Ji for ARM demo</title>
	<meta name="description" content="Bootstrap Metro Dashboard">
	<meta name="author" content="Dennis Ji">
	<meta name="keyword" content="Metro, Metro UI, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
	<!-- end: Meta -->
	
	<!-- start: Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- end: Mobile Specific -->
	
	<!-- start: CSS -->
	<link id="bootstrap-style" href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
	<link id="base-style" href="css/style.css" rel="stylesheet">
	<link id="base-style-responsive" href="css/style-responsive.css" rel="stylesheet">
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
	
		
		
		
</head>

<body>
		<!-- start: Header -->
	<div class="navbar">
		<div class="navbar-inner">
			<div <?php if($_SESSION['level']==1) echo'style="background: #90caf9"';?> class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<?php
				if($_SESSION['level']==2)
				echo '
					<a class="brand" href="#"><span style="color: #bbdefb;" >Gestion Automatisée De Flotte Automobile</span></a>';
				else
				echo '<a class="brand" href="#"><span style="color: #ffffff;" >Gestion Automatisée De Flotte Automobile</span></a>';
				?>
								
				<!-- start: Header Menu -->
				<div class="nav-no-collapse header-nav">
					<ul class="nav pull-right">
						
						<!-- start: User Dropdown -->
						<li class="dropdown">
							<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
								<i class="halflings-icon white user"></i> <?php echo " ".$_SESSION['login'];  ?>
								<span class="caret"></span>
							</a>
							<ul class="dropdown-menu">
								<li class="dropdown-menu-title">
 									<span>Account Settings</span>
								</li>
								<li><a href="#"><i class="halflings-icon user"></i> Profile</a></li>
								<li><a href="index.php?deco=deco"><i class="halflings-icon off"></i> Déconnexion</a></li>
							</ul>
						</li>
						<!-- end: User Dropdown -->
					</ul>
				</div>
				<!-- end: Header Menu -->
				
			</div>
		</div>
	</div>
	<!-- start: Header -->
	
		<div class="container-fluid-full">
		<div class="row-fluid">
				
			<!-- start: Main Menu -->
			<div id="sidebar-left" class="span2">
				<div class="nav-collapse sidebar-nav">
					<ul class="nav nav-tabs nav-stacked main-menu">
						<li><a href="accueil.php"><i class="icon-home"></i><span class="hidden-tablet"> Accueil</span></a></li>
						<li>
							<a class="dropmenu" href="#"><i class="icon-bookmark"></i><span class="hidden-tablet"> Location</span></a>
							<ul>				
								<li><a class="submenu" href="ch_veh.php"><i class="icon-save"></i><span class="hidden-tablet"><h7> Nouvelle location</h7></span></a></li>
								<li><a class="submenu" href="l_res.php"><i class="icon-calendar"></i><span class="hidden-tablet"> Liste des réservations</span></a></li>
								<li><a class="submenu" href="l_loc.php"><i class="icon-road"></i><span class="hidden-tablet"> Liste des locations</span></a></li>
								<li><a class="submenu" href="a_fac.php"><i class="icon-book"></i><span class="hidden-tablet"> Anciennes factures</span></a></li>
								
							</ul>	
						</li>
						<li>    
							<a class="dropmenu" href="#"><i class="icon-user-md"></i><span class="hidden-tablet"> Administration</span></a>
							<ul>
								<li><a class="submenu" href="l_cli.php"><i class="icon-group"></i><span class="hidden-tablet"> Liste des clients</span></a></li>
								<li><a class="submenu" href="l_cha.php"><i class="icon-group"></i><span class="hidden-tablet"> Liste des chauffeurs</span></a></li>
								<li><a class="submenu" href="l_veh.php"><i class="icon-truck"></i><span class="hidden-tablet"> Liste des véhicules</span></a></li>
								<?php
								
								echo '<li><a class="submenu" href="l_user.php"><i class="icon-user-md"></i><span class="hidden-tablet"> Liste des utilisateurs</span></a></li>';
								if($_SESSION['level']==2)
								echo '<li><a class="submenu" href="setting.php"><i class="icon-cogs"></i><span class="hidden-tablet"> Paramètre</span></a></li>';

								?>
							</ul>	
						</li>
						</ul>
				</div>
			</div>
			<!-- end: Main Menu -->
			
				
			
			
			<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
					<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
				</div>
			</noscript>
			
			<!-- start: Content -->
			<div id="content" class="span10">
			
			
			<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="accueil.php">Accueil</a> 
					<i class="icon-angle-right"></i>
				</li>
				<li><a href="#">Ajout utilisateur</a></li>
			</ul>		
			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon white edit"></i><span class="break"></span> </h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal" method="post" action="add_user.php" enctype = "multipart/form-data">
						  <fieldset>
							<div class="control-group">
							  
							  <div class="alert alert-success">	
							    <strong>Nouveau utilisateur</strong> 
					        	</div>
								<div class="control-group success">
								<label class="control-label" for="inputSuccess">Login </label>
								<div class="controls">
								  <input required type="text" id="inputSuccess required"   name="login" >
								  <span class="help-inline"></span>
								</div>							 
							  </div>
								<div class="control-group success">
                                        <label class="control-label" for="inputSuccess">Mot de passe</label>

                                        <div class="controls">
                                            <input required type="password" id="password2" name="mdp" class="form-control" />
                                        </div>
                                </div>
                                <div class="control-group success">
                                        <label class="control-label" for="inputSuccess">Confirmer Mot de passe</label>

                                        <div class="controls">
                                            <input required type="password" id="password2" name="mdp2" class="form-control" />
                                        </div>
                                </div>
                                
							  <div class="control-group success">
								<label class="control-label" for="inputSuccess">Nom </label>
								<div class="controls">
								  <input required type="text" id="inputSuccess" name="nom">
								  <span class="help-inline"></span>
								</div>
							  </div>
							  <div class="control-group success">
								<label class="control-label" for="inputSuccess">Prénom </label>
								<div class="controls">
								  <input required type="text" id="inputSuccess" name="prenom">
								  <span class="help-inline"></span>
								</div>
							  </div>
							  <div class="control-group success">
								<label class="control-label" for="inputSuccess">Téléphone </label>
								<div class="controls">
								  <input required type="text" id="inputSuccess" name="tel">
								  <span class="help-inline"></span>
								</div>
							  </div>
							  <div class="control-group success">
                                            <label class="control-label">E-mail</label>

                                            <div class="controls">
                                                <input type="email" id="email2" name="email" class="form-control" />
                                            </div>
                               </div>
							  <div class="control-group">
							  <label class="control-label" for="fileInput">Photo</label>
							  <div class="controls">
								<input class="input-file uniform_on" id="fileInput" name="photo" type="file">
							  </div>
							</div>
							<div class="control-group success">
								<label class="control-label">Status</label>
								<div class="controls">
								  <label class="radio">
									<input type="radio" name="status" id="optionsRadios1" value=1 checked="">Gestionnaire
								  </label>
								  <div style="clear:both"></div>
								  <label class="radio">
									<input type="radio" name="status" id="optionsRadios2" value=2 >Administrateur
								  </label>
								</div>
							  </div>

							 							  
							</div>
							<div class="">
                                            <a class="btn " href="l_user.php">retour
											 										
											</a>
                                            <button  type="submit" name="submit" class="btn btn-primary">valider</button>
											
                             </div>	
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			</div><!--/row-->
			
			
			
	
			
       

	</div><!--/.fluid-container-->
	
			<!-- end: Content -->
		</div><!--/#content.span10-->
		</div><!--/fluid-row-->
		
	<div class="modal hide fade" id="myModal">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<h3>Settings</h3>
		</div>
		<div class="modal-body">
			<p>Here settings can be configured...</p>
		</div>
		<div class="modal-footer">
			<a href="#" class="btn" data-dismiss="modal">Close</a>
			<a href="#" class="btn btn-primary">Save changes</a>
		</div>
	</div>
	
	<div class="common-modal modal fade" id="common-Modal1" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-content">
			<ul class="list-inline item-details">
				<li><a href="http://themifycloud.com">Admin templates</a></li>
				<li><a href="http://themescloud.org">Bootstrap themes</a></li>
			</ul>
		</div>
	</div>
	
	<div class="clearfix"></div>
	
	<footer>

		<p>
			<span style="text-align:left;float:left">&copy; 2015 <a href="" alt="Car Rental">Car Rental</a></span>
			
		</p>
	</footer>
	
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
