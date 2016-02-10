<?php
session_start (); // Ouverture des sessions
include ('connexion.php');
if (! $_SESSION ['login']) {
	header ( 'Location:index.php' );
	exit ();
}

if (! isset ( $_GET ['valider'] ) && ! isset ( $_GET ['reservation'] )) {
	
	if (! isset ( $_POST ['ancienClient'] )) {
		$_SESSION ['nom'] = $_POST ['nom'];
		$_SESSION ['prenom'] = $_POST ['prenom'];
		$_SESSION ['tel'] = $_POST ['tel'];
		$_SESSION ['permis'] = $_POST ['permis'];
		$_SESSION ['numPermis'] = $_POST ['numPermis'];
		
		$_SESSION ['ii'] = 0;
		if (! empty ( $_FILES ['photo'] ['size'] )) {
			$maxsize = 100244; // Poid de l'image
			$maxwidth = 3500; // Largeur de l'image
			$maxheight = 3500; // Longueur de l'image
			$extensions_valides = array (
					'jpg',
					'png' 
			);
			if ($_FILES ['photo'] ['error'] > 0) {
				$_SESSION ['ii'] ++;
				$avatar_erreur1 = "Une erreur est survenu lors du transfert";
			}
			if ($_FILES ['photo'] ['error'] > $maxsize) {
				$_SESSION ['ii'] ++;
				$avatar_erreur1 = " votre fichier est trop grand " . $_FILES ['avatar'] ['error'] . " octets contre " . $maxsize . " octets";
			}
			$image_sizes = getimagesize ( $_FILES ['photo'] ['tmp_name'] );
			if ($image_sizes [0] > $maxwidth or $image_sizes [1] > $maxheight) {
				$_SESSION ['ii'] ++;
				$avatar_erreur3 = " vérifier la taille de votre fichier " . $image_sizes [0] . " x contre " . $maxwidth . " octets" . $image_sizes [1] . " x contre " . $maxheight . " octets";
			}
			$extension_upload = strtolower ( substr ( strrchr ( $_FILES ['photo'] ['name'], '.' ), 1 ) );
			if (! in_array ( $extension_upload, $extensions_valides )) {
				$_SESSION ['ii'] ++;
				$avatar_erreur4 = "Extension de l\'avatar non prise en charge";
			}
		} else
			$_FILES ['photo'] ['name'] = 'avatar.jpg';
			// pour ne pas perdre les info du fichier
		
		$infosfichier = pathinfo ( $_FILES ['photo'] ['name'] );
		$extension = $infosfichier ['extension'];
		if ($_FILES ['photo'] ['name'] != 'avatar.jpg') {
			
			$chai = 'abcdefghijklmnopqrstuvwz0123456789';
			$mo = str_shuffle ( $chai );
			$mi = str_shuffle ( $chai );
			$p = substr ( $mo, 0, 3 );
			$mu = substr ( $mi, 0, 3 );
			
			$_FILES ['photo'] ['name'] = $p . $mu . '.' . $extension;
		}
		
		$_SESSION ['photo'] = $_FILES ['photo'] ['name'];
		$_SESSION ['basename'] = basename ( $_FILES ['photo'] ['name'] );
		
		// reduire la taillede l'image
		
		if (! empty ( $_FILES ['photo'] ['tmp_name'] )) {
			if ($extension == 'jpg' || $extension == 'JPG' || $extension == 'jpeg' || $extension == 'JPEG')
				$source = imagecreatefromjpeg ( $_FILES ['photo'] ['tmp_name'] ); // La photo est la source
			else
				$source = imagecreatefrompng ( $_FILES ['photo'] ['tmp_name'] ); // La photo est la source
			
			$destination = imagecreatetruecolor ( 500, 500 ); // On crée la miniature vide
			                                               // Les fonctions imagesx et imagesy renvoient la largeur et la hauteur d'une image
			$largeur_source = imagesx ( $source );
			$hauteur_source = imagesy ( $source );
			$largeur_destination = imagesx ( $destination );
			$hauteur_destination = imagesy ( $destination );
			// On crée la miniature
			imagecopyresampled ( $destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source );
			// On enregistre la miniature sous le nom "mini_couchersoleil.jpg"
			if ($extension == 'jpg' || $extension == 'JPG' || $extension == 'jpeg' || $extension == 'JPEG')
				imagejpeg ( $destination, 'tmp/' . basename ( $_FILES ['photo'] ['name'] ), 72 );
			else
				imagepng ( $destination, 'tmp/' . basename ( $_FILES ['photo'] ['name'] ), 9 );
			
			// imagejpeg($destination, "mini_couchersoleil.jpg");
		}
		// move_uploaded_file($_FILES['photo']['tmp_name'], 'avatars/' . basename($_FILES['photo']['name']));
	} else // pour le choix de l ancien client
{
		$_SESSION ['ii'] = 0;
		$chffdz = $bdd->query ( 'SELECT * FROM client WHERE id=' . $_POST ['ancienClient'] . ';' );
		$chauffdz = $chffdz->fetch ();
		$_SESSION ['ancienClient'] = $_POST ['ancienClient'];
		$_SESSION ['nom'] = $chauffdz ['nom'];
		$_SESSION ['prenom'] = $chauffdz ['prenom'];
		$_SESSION ['tel'] = $chauffdz ['tel'];
		$_SESSION ['permis'] = $chauffdz ['permis'];
		$_SESSION ['numPermis'] = $chauffdz ['numPermis'];
	}
	/*
	 * change de format de la date
	 * $originalDate = "2010-03-21";
	 * $newDate = date("d-m-Y", strtotime($originalDate));
	 */
	// calcul le nomb de jour entre deux dates
	function nbJours($debut, $fin) {
		// 60 secondes X 60 minutes X 24 heures dans une journée
		$nbSecondes = 60 * 60 * 24;
		
		$debut_ts = strtotime ( $debut );
		$fin_ts = strtotime ( $fin );
		$diff = $fin_ts - $debut_ts;
		return round ( $diff / $nbSecondes );
	}
	$chii = $bdd->query ( 'SELECT * FROM vehicule WHERE id= ' . $_SESSION ['id_voit'] . '' );
	$chauii = $chii->fetch ();
	$nbrji = nbJours ( $_SESSION ['datel'], $_SESSION ['dater'] );
	$prixli = ($chauii ['prix'] * $nbrji);
	if ($prixli < 0) {
		header ( 'Location:supprimer.php?erreur=erreur' );
		exit ();
	}
}

if (isset ( $_GET ['valider'] )) {
	
	// enregistrement du client
	/*
	 * select * from matable
	 * where monchamp = ( select max(monchamp) from matable);
	 */
	/*
	 * SELECT *
	 * FROM tatable
	 * WHERE colonnecleprimaire = MAX(colonnecleprimaire)
	 */
	
	if ($_SESSION ['ii'] == 0) {
		$date = new DateTime ( 'now Africa/Libreville' );
		$dat = date ( "d-m-Y" );
		$heur = $date->format ( 'H:i:s' );
		$_SESSION ['fait'] = $dat . ' a ' . $heur;
		
		// date pour num de factu
		$chffd = $bdd->query ( 'SELECT * FROM date WHERE id= (SELECT MAX(id) from date);' );
		$chauffd = $chffd->fetch ();
		
		$da = date ( "m" );
		if (empty ( $chauffd ['mois'] )) { // pour le déconte du num de facture
			
			$_SESSION ['num'] = 0;
			$moi = date ( "m" );
			$_SESSION ['num'] ++;
			
			$reqf = $bdd->prepare ( 'UPDATE date SET mois=:mois, num=:num WHERE id = :id' );
			$reqf->execute ( array (
					':mois' => $moi,
					':num' => $_SESSION ['num'],
					':id' => $chauffd ['id'] 
			) );
		} elseif ($da == $chauffd ['mois']) {
			
			$add = $chauffd ['num'];
			$add ++;
			$_SESSION ['num'] = $add;
			
			$reqf = $bdd->prepare ( 'UPDATE date SET num=:num WHERE id = :id' );
			$reqf->execute ( array (
					':num' => $_SESSION ['num'],
					':id' => $chauffd ['id'] 
			) );
		} elseif ($da != $chauffd ['mois']) {
			
			$_SESSION ['num'] = 0;
			$_SESSION ['num'] ++;
			$moi = date ( 'm' );
			
			$reqf = $bdd->prepare ( 'UPDATE date SET mois=:mois, num=:num WHERE id = :id' );
			$reqf->execute ( array (
					':mois' => $moi,
					':num' => $_SESSION ['num'],
					':id' => $chauffd ['id'] 
			) );
		}
		
		$numero = '#' . date ( "Ym" ) . '-' . $_SESSION ['num'];
		
		// enregistrement de la facture
		
		$req = $bdd->prepare ( 'INSERT INTO facture(datel, dater,
datef, prixl, nbrJ, num, fait, operateur) VALUES(:datel,
:dater, :datef, :prixl,:nbrJ, :num, :fait, :operateur )' );
		$req->execute ( array (
				'datel' => $_SESSION ['datel'],
				'dater' => $_SESSION ['dater'],
				// date
				'prixl' => $_SESSION ['prixl'],
				'nbrJ' => $_SESSION ['Nbrj'],
				'num' => $numero,
				'fait' => $_SESSION ['fait'],
				'operateur' => $_SESSION ['login'] 
		) );
		
		// recuperer id facture pour mettre dans client
		$ch = $bdd->query ( 'SELECT * FROM facture WHERE id= (SELECT MAX(id) from facture);' );
		$chau = $ch->fetch ();
		
		// enregistrement du client
		if (! isset ( $_SESSION ['ancienClient'] )) {
			$reqc = $bdd->prepare ( 'INSERT INTO client(nom, prenom,
tel, permis, numPermis,id_fact, photo) VALUES(UPPER(:nom),
UPPER(:prenom), :tel, :permis, :numPermis,:id_fact, :photo)' );
			$reqc->execute ( array (
					'nom' => $_SESSION ['nom'],
					'prenom' => $_SESSION ['prenom'],
					'tel' => $_SESSION ['tel'],
					'permis' => $_SESSION ['permis'],
					'numPermis' => $_SESSION ['numPermis'],
					'id_fact' => $chau ['id'],
					'photo' => $_SESSION ['photo'] 
			) );
			
			// deplacer un fichier
			$fil = 'tmp/' . $_SESSION ['basename'];
			$newfile = 'img/client/' . $_SESSION ['basename'];
			rename ( $fil, $newfile );
		}
		
		// ajout id du client pour mettre dans facture
		if (! isset ( $_SESSION ['ancienClient'] )) {
			$chc = $bdd->query ( 'SELECT * FROM client WHERE id= (SELECT MAX(id) from client);' ); // recuperer la derniere valeur ajouté
			$chauc = $chc->fetch ();
		} else {
			$chc = $bdd->query ( 'SELECT * FROM client WHERE id=' . $_SESSION ['ancienClient'] . ';' ); // recuperer la derniere valeur ajouté
			$chauc = $chc->fetch ();
			
			$req = $bdd->prepare ( 'UPDATE client SET id_fact=:id_fact WHERE id = :id' );
			$req->execute ( array (
					':id_fact' => $chau ['id'],
					':id' => $chauc ['id'] 
			) );
		}
		// pour client voiture rendu
		$cli = "voiture non rendue";
		$req = $bdd->prepare ( 'UPDATE client SET location=:location WHERE id = :id' );
		$req->execute ( array (
				':location' => $cli,
				':id' => $chauc ['id'] 
		) );
		
		// pour mettre le nom du chauffeur
		$chff = $bdd->query ( 'SELECT * FROM facture WHERE id= (SELECT MAX(id) from facture);' );
		$chauff = $chff->fetch ();
		
		if ($_SESSION ['id_cha'] == "client") {
			$_SESSION ['id_cha'] = $chauc ['id']; // id du client comme chauffeur
			$_SESSION ['client'] = 1;
			
			$reqf = $bdd->prepare ( 'UPDATE facture SET id_cli=:id_cli, id_voi=:id_voi, id_chacli=:id_chacli WHERE id = :id' );
			$reqf->execute ( array (
					':id_cli' => $chauc ['id'],
					':id_voi' => $_SESSION ['id_voit'],
					':id' => $chauff ['id'],
					'id_chacli' => $_SESSION ['id_cha'] 
			) );
		} else {
			$reqf = $bdd->prepare ( 'UPDATE facture SET id_cli=:id_cli, id_voi=:id_voi, id_cha=:id_cha WHERE id = :id' );
			$reqf->execute ( array (
					':id_cli' => $chauc ['id'],
					':id_voi' => $_SESSION ['id_voit'],
					':id' => $chauff ['id'],
					'id_cha' => $_SESSION ['id_cha'] 
			)
			 );
			
			$_SESSION ['client'] = 0;
			// statut du chauff passe a occupé
			$l = "occupe";
			$reqv = $bdd->prepare ( 'UPDATE chauffeur SET status=:status, id_fact=:id_fact WHERE id = :id' );
			$reqv->execute ( array (
					':status' => $l,
					':id_fact' => $chau ['id'],
					':id' => $_SESSION ['id_cha'] 
			) );
		}
		// id client dans voiture et statut location et facture
		$l = "location";
		$client_nom = $_SESSION ['nom'] . ' ' . $_SESSION ['prenom'];
		$reqv = $bdd->prepare ( 'UPDATE vehicule SET id_client=:id_client,status=:status, id_fact=:id_fact WHERE id = :id' );
		$reqv->execute ( array (
				':id_client' => $client_nom,
				':status' => $l,
				':id_fact' => $chau ['id'],
				':id' => $_SESSION ['id_voit'] 
		) );
		
		header ( 'Location:factu_2.php' );
	} else {
		header ( 'Location:accueil.php' );
		exit ();
	}
}

// reservation

if (isset ( $_GET ['reservation'] )) {
	
	// enregistrement du client
	/*
	 * select * from matable
	 * where monchamp = ( select max(monchamp) from matable);
	 */
	/*
	 * SELECT *
	 * FROM tatable
	 * WHERE colonnecleprimaire = MAX(colonnecleprimaire)
	 */
	
	if ($_SESSION ['ii'] == 0) {
		$date = new DateTime ( 'now Africa/Libreville' );
		$dat = date ( "d-m-Y" );
		$heur = $date->format ( 'H:i:s' );
		$_SESSION ['fait'] = $dat . ' a ' . $heur;
		
		// date pour num de factu
		$chffd = $bdd->query ( 'SELECT * FROM date WHERE id= (SELECT MAX(id) from date);' );
		$chauffd = $chffd->fetch ();
		
		$da = date ( "m" );
		if (empty ( $chauffd ['mois'] )) { // pour le déconte du num de facture
			
			$_SESSION ['num'] = 0;
			$moi = date ( "m" );
			$_SESSION ['num'] ++;
			
			$reqf = $bdd->prepare ( 'UPDATE date SET mois=:mois, num=:num WHERE id = :id' );
			$reqf->execute ( array (
					':mois' => $moi,
					':num' => $_SESSION ['num'],
					':id' => $chauffd ['id'] 
			) );
		} elseif ($da == $chauffd ['mois']) {
			
			$add = $chauffd ['num'];
			$add ++;
			$_SESSION ['num'] = $add;
			
			$reqf = $bdd->prepare ( 'UPDATE date SET num=:num WHERE id = :id' );
			$reqf->execute ( array (
					':num' => $_SESSION ['num'],
					':id' => $chauffd ['id'] 
			) );
		} elseif ($da != $chauffd ['mois']) {
			
			$_SESSION ['num'] = 0;
			$_SESSION ['num'] ++;
			$moi = date ( 'm' );
			
			$reqf = $bdd->prepare ( 'UPDATE date SET mois=:mois, num=:num WHERE id = :id' );
			$reqf->execute ( array (
					':mois' => $moi,
					':num' => $_SESSION ['num'],
					':id' => $chauffd ['id'] 
			) );
		}
		
		$numero = '#' . date ( "Ym" ) . '-' . $_SESSION ['num'];
		
		// enregistrement de la reservation
		$req = $bdd->prepare ( 'INSERT INTO reservations(datel, dater,
datef, prixl, nbrJ, num, fait, operateur) VALUES(:datel,
:dater, :datef, :prixl,:nbrJ, :num, :fait, :operateur )' );
		$req->execute ( array (
				'datel' => $_SESSION ['datel'],
				'dater' => $_SESSION ['dater'],
				'datef' => $_SESSION ['datef'],
				'prixl' => $_SESSION ['prixl'],
				'nbrJ' => $_SESSION ['Nbrj'],
				'num' => $numero,
				'fait' => $_SESSION ['fait'],
				'operateur' => $_SESSION ['login'] 
		) );
		
		// recuperer id reservation pour mettre dans client
		$ch = $bdd->query ( 'SELECT * FROM reservations WHERE id= (SELECT MAX(id) from reservations);' );
		$chau = $ch->fetch ();
		if (! isset ( $_SESSION ['ancienClient'] )) {
			// enregistrement du client
			$reqc = $bdd->prepare ( 'INSERT INTO client(nom, prenom,
tel, permis, numPermis,id_fact, photo) VALUES(UPPER(:nom),
UPPER(:prenom), :tel, :permis, :numPermis,:id_fact, :photo)' );
			$reqc->execute ( array (
					'nom' => $_SESSION ['nom'],
					'prenom' => $_SESSION ['prenom'],
					'tel' => $_SESSION ['tel'],
					'permis' => $_SESSION ['permis'],
					'numPermis' => $_SESSION ['numPermis'],
					'id_fact' => $chau ['id'],
					'photo' => $_SESSION ['photo'] 
			) );
			
			// deplacer un fichier
			$fil = 'tmp/' . $_SESSION ['basename'];
			$newfile = 'img/client/' . $_SESSION ['basename'];
			rename ( $fil, $newfile );
		}
		
		// ajout id du client pour mettre dans facture
		if (! isset ( $_SESSION ['ancienClient'] )) {
			$chc = $bdd->query ( 'SELECT * FROM client WHERE id= (SELECT MAX(id) from client);' ); // recuperer la derniere valeur ajouté
			$chauc = $chc->fetch ();
		} else {
			$chc = $bdd->query ( 'SELECT * FROM client WHERE id=' . $_SESSION ['ancienClient'] . ';' ); // recuperer la derniere valeur ajouté
			$chauc = $chc->fetch ();
		}
		
		$chff = $bdd->query ( 'SELECT * FROM reservations WHERE id= (SELECT MAX(id) from reservations);' );
		$chauff = $chff->fetch ();
		
		if ($_SESSION ['id_cha'] == "client") {
			$_SESSION ['id_cha'] = $chauc ['id']; // id du client comme chauffeur
			$_SESSION ['client'] = 1;
			
			$reqf = $bdd->prepare ( 'UPDATE reservations SET id_cli=:id_cli, id_voi=:id_voi, id_chacli=:id_chacli WHERE id = :id' );
			$reqf->execute ( array (
					':id_cli' => $chauc ['id'],
					':id_voi' => $_SESSION ['id_voit'],
					':id' => $chauff ['id'],
					'id_chacli' => $_SESSION ['id_cha'] 
			) );
		} else {
			$reqf = $bdd->prepare ( 'UPDATE reservations SET id_cli=:id_cli, id_voi=:id_voi, id_cha=:id_cha WHERE id = :id' );
			$reqf->execute ( array (
					':id_cli' => $chauc ['id'],
					':id_voi' => $_SESSION ['id_voit'],
					':id' => $chauff ['id'],
					'id_cha' => $_SESSION ['id_cha'] 
			) );
			$_SESSION ['client'] = 0;
		}
		
		header ( 'Location:l_res.php' );
	} else {
		header ( 'Location:accueil.php' );
		exit ();
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

</head>

<body>
	<!-- start: Header -->
	<div class="navbar">
		<div class="navbar-inner">
			<div
				<?php if($_SESSION['level']==1) echo'style="background: #90caf9"';?>
				class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse"
					data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse"> <span
					class="icon-bar"></span> <span class="icon-bar"></span> <span
					class="icon-bar"></span>
				</a>
				<?php
				if ($_SESSION ['level'] == 2)
					echo '
					<a class="brand" href="#"><span style="color: #bbdefb;" >Gestion Automatisée De Flotte Automobile</span></a>';
				else
					echo '<a class="brand" href="#"><span style="color: #ffffff;" >Gestion Automatisée De Flotte Automobile</span></a>';
				?>

				<!-- start: Header Menu -->
				<div class="nav-no-collapse header-nav">
					<ul class="nav pull-right">

						<!-- start: User Dropdown -->
						<li class="dropdown"><a class="btn dropdown-toggle"
							data-toggle="dropdown" href="#"> <i
								class="halflings-icon white user"></i> <?php echo " ".$_SESSION['login'];  ?>
								<span class="caret"></span>
						</a>
							<ul class="dropdown-menu">
								<li class="dropdown-menu-title"><span>Account Settings</span></li>
								<li><a href="#"><i class="halflings-icon user"></i> Profile</a></li>
								<li><a href="index.php?deco=deco"><i class="halflings-icon off"></i>
										Déconnexion</a></li>
							</ul></li>
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
						<li><a href="accueil.php"><i class="icon-home"></i><span
								class="hidden-tablet"> Accueil</span></a></li>
						<li><a class="dropmenu" href="#"><i class="icon-bookmark"></i><span
								class="hidden-tablet"> Location</span></a>
							<ul>
								<li><a class="submenu" href="ch_veh.php"><i class="icon-save"></i><span
										class="hidden-tablet"><h7> Nouvelle location</h7></span></a></li>
								<li><a class="submenu" href="l_res.php"><i class="icon-calendar"></i><span
										class="hidden-tablet"> Liste des réservations</span></a></li>
								<li><a class="submenu" href="l_loc.php"><i class="icon-road"></i><span
										class="hidden-tablet"> Liste des locations</span></a></li>
								<li><a class="submenu" href="a_fac.php"><i class="icon-book"></i><span
										class="hidden-tablet"> Anciennes factures</span></a></li>

							</ul></li>
						<li><a class="dropmenu" href="#"><i class="icon-user-md"></i><span
								class="hidden-tablet"> Administration</span></a>
							<ul>
								<li><a class="submenu" href="l_cli.php"><i class="icon-group"></i><span
										class="hidden-tablet"> Liste des clients</span></a></li>
								<li><a class="submenu" href="l_cha.php"><i class="icon-group"></i><span
										class="hidden-tablet"> Liste des chauffeurs</span></a></li>
								<li><a class="submenu" href="l_veh.php"><i class="icon-truck"></i><span
										class="hidden-tablet"> Liste des véhicules</span></a></li>
								<?php
								
								echo '<li><a class="submenu" href="l_user.php"><i class="icon-user-md"></i><span class="hidden-tablet"> Liste des utilisateurs</span></a></li>';
								if ($_SESSION ['level'] == 2)
									echo '<li><a class="submenu" href="setting.php"><i class="icon-cogs"></i><span class="hidden-tablet"> Paramètre</span></a></li>';
								
								?>
							</ul></li>
					</ul>
				</div>
			</div>
			<!-- end: Main Menu -->

			<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
					<p>
						You need to have <a href="http://en.wikipedia.org/wiki/JavaScript"
							target="_blank">JavaScript</a> enabled to use this site.
					</p>
				</div>
			</noscript>

			<!-- start: Content -->
			<div id="content" class="span10">


				<ul class="breadcrumb">
					<li><i class="icon-home"></i> <a href="accueil.php">Accueil</a> <i
						class="icon-angle-right"></i></li>
					<li><a href="#">information du client</a> <i
						class="icon-angle-right"></i></li>
					<li><a href="#">choix de la voiture</a> <i class="icon-angle-right"></i>
					</li>
					<li><a href="#">détail de la location</a> <i
						class="icon-angle-right"></i></li>
					<li><a href="#">Facturation</a> <i class="icon-angle-right"></i></li>
				</ul>
		<?php
		$chi = $bdd->query ( 'SELECT * FROM vehicule WHERE id= ' . $_SESSION ['id_voit'] . '' );
		$chaui = $chi->fetch ();
		$nbrj = nbJours ( $_SESSION ['datel'], $_SESSION ['dater'] );
		$prixl = ($chaui ['prix'] * $nbrj);
		
		$_SESSION ['prixl'] = $prixl;
		$dloc = date ( "d-m-Y", strtotime ( $_SESSION ['datel'] ) ); // inverse le format de la date
		$dret = date ( "d-m-Y", strtotime ( $_SESSION ['dater'] ) );
		$dfac = date ( "d-m-Y", strtotime ( $_SESSION ['datef'] ) );
		
		$_SESSION ['Nbrj'] = $nbrj;
		$_SESSION ['Dloc'] = $dloc;
		$_SESSION ['Dret'] = $dret;
		$_SESSION ['Dfac'] = $dfac;
		echo '
			<div class="row-fluid sortable">
				<div class="box span10">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon white edit"></i><span class="break"></span> </h2>

					</div>
					<div class="box-content">
						<form class="form-horizontal" method="post" action="factu.php" >
						  <fieldset>
							<div class="control-group">

							  <div class="alert alert-success">
							    <strong>Facturation</strong>
					        	</div>


								<div class="panel-body">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Nom</th>
                                        <th>Prenom</th>
                                        <th>Téléphone</th>
                                        <th>Marque</th>
                                        <th>Modèle</th>
                                        <th>Nombre de places</th>
                                        <th>Prix par jour(FCFA)</th>
                                        <th>Date de location</th>
                                        <th>Date de retour</th>
                                        <th>Date de facturation</th>
                                        <th>Prix de location(FCFA)</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>' . $_SESSION ['nom'] . '</td>
                                        <td>' . $_SESSION ['prenom'] . '</td>
                                        <td>' . $_SESSION ['tel'] . '</td>
                                        <td>' . $chaui ['marque'] . '</td>
                                        <td>' . $chaui ['modele'] . '</td>
                                        <td>' . $chaui ['nbrP'] . '</td>
                                        <td>' . $chaui ['prix'] . '</td>
                                        <td>' . $dloc . '</td>
                                        <td>' . $dret . '</td>
                                        <td>' . $dfac . '</td>
                                        <td>' . $prixl . '</td>

                                    </tr>


                                    </tbody>

                                </table>
                            </div>





							</div>


							<div class="form-actions">


							  <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#myModal" href="#">Location</button>
							  <a class="btn" href="accueil.php">Annuler</a>
							  <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#myModal2" href="#">Réservation</button>

							</div>
						  </fieldset>
						</form>

					</div>
				</div><!--/span-->

			</div><!--/row-->

			';
		
		?>

	   <!-- MODAL VOIR-->

				<div class="modal fade" id="myModal" tabindex="-1" role="dialog"
					aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content" id="div1">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal"
									aria-hidden="true">&times;</button>
								<h4 class="modal-title" id="myModalLabel">Confirmation Location</h4>

							</div>
							<div class="modal-body">

								<p>Voulez-vous vraiment enregistrer</p>
							</div>

							<div class="modal-footer">
								<div class="row no-print">
									<div class="col-xs-12">

										<a href="factu.php?valider=valider"><button
												class="btn btn-primary btn-xs">
												<i class="fa fa-pencil"></i>Oui
											</button></a>

										<button type="button" class="btn btn-danger"
											data-dismiss="modal">Non</button>


									</div>



								</div>
							</div>



						</div>
					</div>
				</div>



				<div class="modal fade" id="myModal2" tabindex="-1" role="dialog"
					aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content" id="div1">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal"
									aria-hidden="true">&times;</button>
								<h4 class="modal-title" id="myModalLabel">Confirmation
									Réservation</h4>

							</div>
							<div class="modal-body">

								<p>Voulez-vous vraiment enregistrer</p>
							</div>

							<div class="modal-footer">
								<div class="row no-print">
									<div class="col-xs-12">

										<a href="factu.php?reservation=reservation"><button
												class="btn btn-primary btn-xs">
												<i class="fa fa-pencil"></i>Oui
											</button></a>

										<button type="button" class="btn btn-danger"
											data-dismiss="modal">Non</button>


									</div>



								</div>
							</div>



						</div>
					</div>
				</div>














			</div>
			<!--/.fluid-container-->

			<!-- end: Content -->
		</div>
		<!--/#content.span10-->
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

	<div class="clearfix"></div>

	<footer>

		<p>
			<span style="text-align: left; float: left">&copy; 2015 <a href=""
				alt="Car Rental">Car Rental</a></span>

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
