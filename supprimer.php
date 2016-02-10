<?php
session_start(); # Ouverture des sessions
include('connexion.php');
if(!$_SESSION['login']){
header('Location:index.php');
exit();
}

?>		

<!DOCTYPE html>
<html lang="en">
<head>
	<body>
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
			<?php
			//pour supp la tof en recup les info
			
			
			if(isset($_GET['erreur'])){
				
				echo '
					<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon white edit"></i><span class="break"></span> </h2>
						<div class="box-icon">
							
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal" method="post" action="setting.php" enctype = "multipart/form-data">
						  <fieldset>
							<div class="control-group">
					
								<div class="alert alert-error">
							<button type="button" class="close" data-dismiss="alert">×</button>
							<strong><h3>Erreur!</h3></strong> <h1> le prix de la location est négatif, la date de location est supérieur à la de retour </h1>
						<br><br><br></div>
			  
							  ';
								
				echo '	
							 							  
							</div>
							<div class="">
                                            <a class="btn " href="accueil.php">retour
											 										
											</a>
											
                             </div>	
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			</div><!--/row-->
	
			';
				
			}
		
		if(isset($_GET['assurance'])){
				
				echo '
					<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon white edit"></i><span class="break"></span> </h2>
						<div class="box-icon">
							
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal" method="post" action="setting.php" enctype = "multipart/form-data">
						  <fieldset>
							<div class="control-group">
					
								<div class="alert alert-error">
							<button type="button" class="close" data-dismiss="alert">×</button>
							<strong><h3>Erreur!</h3></strong> <h1>la date de debut est supérieur à la date de fin </h1>
						<br><br><br></div>
			  
							  ';
								
				echo '	
							 							  
							</div>
							<div class="">
                                            <a class="btn " href="accueil.php">retour
											 										
											</a>
											
                             </div>	
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			</div><!--/row-->
	
			';
				
			}
		
		
if(isset($_GET['admin'])){
				
				echo '
					<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon white edit"></i><span class="break"></span> </h2>
						<div class="box-icon">
							
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal" method="post" action="setting.php" enctype = "multipart/form-data">
						  <fieldset>
							<div class="control-group">
					
								<div class="alert alert-error">
							<button type="button" class="close" data-dismiss="alert">×</button>
							<strong><h3>Erreur!</h3></strong> <h1>impossible de supprimer le seul administrateur </h1>
						<br><br><br></div>
			  
							  ';
								
				echo '	
							 							  
							</div>
							<div class="">
                                            <a class="btn " href="accueil.php">retour
											 										
											</a>
											
                             </div>	
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			</div><!--/row-->
	
			';
				
			}
		
		
		
	if (isset($_GET['action']) AND isset($_GET['id']) ){
		
	
		
			//pour user
		if($_GET['action']=="admin"){	
		//chauffeur	
				
		$sel = $bdd->query('SELECT * FROM admin WHERE id= '.$_GET['id'].'');
		$del = $sel->fetch();
				
				if($del['level']==2){
						$reta = $bdd->query('SELECT COUNT(*) AS nb FROM admin WHERE level=2');
				$dataa = $reta->fetch();
				$totalA = $dataa['nb'];
				
				
			if($totalA==1){
				header('Location:supprimer.php?admin=admin');
				exit;
				}	
				
					
				}
				
			if ($del['photo']!="avatar.jpg"){
				$dirname = 'img/user/';
				$name=$dirname.$del['photo'];
				unlink($name);
				
			}
				//$req = $bd->query('DELETE FROM articles WHERE id_art='.$_GET['id'].';');
				$ch = $bdd->query('DELETE FROM admin WHERE id='.$_GET['id'].';');
				//$chau = $ch->fetch();
			header('Location:l_user.php');
			exit();
			
			
			
		}
		
			//pour categorie
		if($_GET['action']=="categorie"){	
		
		$sel = $bdd->query('SELECT * FROM categorie WHERE id_cate= '.$_GET['id'].'');
		$del = $sel->fetch();
				
			
				//$req = $bd->query('DELETE FROM articles WHERE id_art='.$_GET['id'].';');
				$ch = $bdd->query('DELETE FROM categorie WHERE id_cate='.$_GET['id'].';');
				//$chau = $ch->fetch();
			header('Location:setting.php');
			exit();
			
			
			
		}
		
		
		
		
		//pour chauffeur
		if($_GET['action']=="chauffeur"){	
		$i=0;
		$sel = $bdd->query('SELECT * FROM chauffeur WHERE id= '.$_GET['id'].'');
		$del = $sel->fetch();
		
		
		//verifier si la location est en cour
			$seli = $bdd->query('SELECT * FROM facture ');
			
		while ($data= $seli->fetch())
			{		
				if($del['id']==$data['id_cha'])
					$i++;
			}
			
			$selic = $bdd->query('SELECT * FROM reservations ');
			
		while ($datac= $selic->fetch())
			{		
				if($del['id']==$datac['id_cha'])
					$i++;
			}
			
			if($i==0){	
			if ($del['photo']!="avatar.jpg"){
				$dirname = 'img/chauffeur/';
				$name=$dirname.$del['photo'];
				unlink($name);
			
			
			}
				//$req = $bd->query('DELETE FROM articles WHERE id_art='.$_GET['id'].';');
				$ch = $bdd->query('DELETE FROM chauffeur WHERE id='.$_GET['id'].';');
				//$chau = $ch->fetch();
			header('Location:l_cha.php');
			exit();
			}
			else {
					echo '
					<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon white edit"></i><span class="break"></span> </h2>
						<div class="box-icon">
							
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal" method="post" action="setting.php" enctype = "multipart/form-data">
						  <fieldset>
							<div class="control-group">
					
								<div class="alert alert-error">
							<button type="button" class="close" data-dismiss="alert">×</button>
							<strong><h3>Erreur!</h3></strong> <h1> impossible de le supprimer il y a une location ou une réservation le concernant.</h1>
						<br><br><br></div>
			  
							  ';
								
				echo '	
							 							  
							</div>
							<div class="">
                                            <a class="btn " href="l_cha.php">retour
											 										
											</a>
											
                             </div>	
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			</div><!--/row-->
	
			';
			}
			
		}
		//pour vehicule
	if($_GET['action']=="vehicule"){
		$i=0;
		
		$sel = $bdd->query('SELECT * FROM vehicule WHERE id= '.$_GET['id'].'');
		$del = $sel->fetch();
		$selk = $bdd->query('SELECT * FROM assurance WHERE id_voi= '.$_GET['id'].'');
		$delk = $selk->fetch();
		
		//verifier si la location est en cour
			$seli = $bdd->query('SELECT * FROM facture ');
			
		while ($data= $seli->fetch())
			{		
				if($del['id']==$data['id_voi'])
					$i++;
			}	
			$selic = $bdd->query('SELECT * FROM reservations ');
			
		while ($datac= $selic->fetch())
			{		
				if($del['id']==$datac['id_voi'])
					$i++;
			}	
			
		if($i==0){	
			if ($del['photo']!="avatar.jpg"){
				$dirname = 'img/voiture/';
				$name=$dirname.$del['photo'];
				unlink($name);
			}
			
			//$req = $bd->query('DELETE FROM articles WHERE id_art='.$_GET['id'].';');
			$delki = $bdd->query('DELETE FROM assurance WHERE id_voi='.$_GET['id'].';');
				$ch = $bdd->query('DELETE FROM vehicule WHERE id='.$_GET['id'].';');
				
				
				//$chau = $ch->fetch();
			header('Location:l_veh.php');
			exit();
			
		}
		else {
				echo '
					<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon white edit"></i><span class="break"></span> </h2>
						<div class="box-icon">
							
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal" method="post" action="setting.php" enctype = "multipart/form-data">
						  <fieldset>
							<div class="control-group">
					
								<div class="alert alert-error">
							<button type="button" class="close" data-dismiss="alert">×</button>
							<strong><h3>Erreur!</h3></strong> <h1> impossible de le supprimer il y a une location ou une réservation le concernant.</h1>
						<br><br><br></div>
			  
							  ';
								
				echo '	
							 							  
							</div>
							<div class="">
                                            <a class="btn " href="l_veh.php">retour
											 										
											</a>
											
                             </div>	
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			</div><!--/row-->
	
			';
			}
		
		
	}
		//pour client
			if($_GET['action']=="client"){	
			$i=0;
			
		$sel = $bdd->query('SELECT * FROM client WHERE id= '.$_GET['id'].'');
		$del = $sel->fetch();
		
		//verifier si la location est en cour
			$seli = $bdd->query('SELECT * FROM facture ');
			
		while ($data= $seli->fetch())
			{		
				if($del['id_fact']==$data['id'])
					$i++;
			}	
				if($i==0){
					if ($del['photo']!="avatar.jpg"){
					$dirname = 'avatars/';
					$name=$dirname.$del['photo'];
					unlink($name);
					
					
					
					}
					//$req = $bd->query('DELETE FROM articles WHERE id_art='.$_GET['id'].';');
					$ch = $bdd->query('DELETE FROM client WHERE id='.$_GET['id'].';');
					//$chau = $ch->fetch();
					header('Location:l_cli.php');
					exit();
    			}
				else {
					echo '
					<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon white edit"></i><span class="break"></span> </h2>
						<div class="box-icon">
							
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal" method="post" action="setting.php" enctype = "multipart/form-data">
						  <fieldset>
							<div class="control-group">
					
								<div class="alert alert-error">
							<button type="button" class="close" data-dismiss="alert">×</button>
							<strong><h3>Erreur!</h3></strong> <h1> impossible de le supprimer il y a une location en cour le concernant.</h1>
						<br><br><br></div>
			  
							  ';
								
				echo '	
							 							  
							</div>
							<div class="">
                                            <a class="btn " href="l_cli.php">retour
											 										
											</a>
											
                             </div>	
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			</div><!--/row-->
	
			';
			}
	
		}
				
		//pour reservation suppp		
		if($_GET['action']=="reservation"){		
	
			$sel = $bdd->query('SELECT * FROM reservations WHERE id= '.$_GET['id'].'');
			$del = $sel->fetch();
		
			$lib="libre";
			$libp=0;
				
					$reqvv = $bdd->prepare('UPDATE vehicule SET status=:status, id_fact=:id_fact WHERE id = :id');
			$reqvv->execute(array(
			':status' =>$lib,
			':id_fact' =>$libp,
			':id' => $del['id_voi']
			));



			//pour client voiture rendu
			$cli="voiture rendue";
			$req = $bdd->prepare('UPDATE client SET location=:location WHERE id = :id');
			$req->execute(array(
			':location' =>$cli,
			':id' => $del['id_cli']
			));




			//pour chauffeur son statu passe a libre
			$l="libre";
			$reqv = $bdd->prepare('UPDATE chauffeur SET status=:status WHERE id = :id');
			$reqv->execute(array(
			':status' => $l,
			':id' => $del['id_cha']
			));
	
			
			$seli = $bdd->query('SELECT * FROM client WHERE id= '.$del['id_cli'].'');
			$deli = $seli->fetch();
			if ($deli['photo']!="avatar.jpg"){
				$dirname = 'avatars/';
				$name=$dirname.$deli['photo'];
				unlink($name);
			}
			
			//$req = $bd->query('DELETE FROM articles WHERE id_art='.$_GET['id'].';');
			$chi = $bdd->query('DELETE FROM client WHERE id='.$del['id_cli'].';');
			
			
			
			
			
			
			
			
			//$req = $bd->query('DELETE FROM articles WHERE id_art='.$_GET['id'].';');
			$ch = $bdd->query('DELETE FROM reservations WHERE id='.$_GET['id'].';');
			//$chau = $ch->fetch();
		header('Location:accueil.php');
		exit();
		}
			
		//pour reservation activé
		
		if($_GET['action']=="activer"){
			
			$sel = $bdd->query('SELECT * FROM reservations WHERE id= '.$_GET['id'].'');
			$del = $sel->fetch();
			$selcc = $bdd->query('SELECT * FROM client WHERE id= '.$del['id_cli'].'');
			$delcc = $selcc->fetch();
	
			
					
						$req = $bdd->prepare('INSERT INTO facture(datel, dater,
			datef, prixl, nbrj, num, fait, operateur, id_voi, id_cli, id_cha, id_chacli) VALUES(:datel,
			:dater, :datef, :prixl,:nbrj, :num, :fait, :operateur, :id_voi, :id_cli, :id_cha, :id_chacli )');
			$req->execute(array(
			'datel' => $del['datel'],
			'dater' => $del['dater'],
			'datef' => $del['datef'],
			'prixl' => $del['prixl'],
			'nbrj' =>  $del['nbrj'],
			'num' =>   $del['num'],
			'fait' =>  $del['fait'],
			'operateur' => $del['operateur'],
			'id_voi' => $del['id_voi'],
			'id_cli' => $del['id_cli'],
			'id_cha' => $del['id_cha'],
			'id_chacli' => $del['id_chacli']
			));
		//pour client voiture rendu
$cli="voiture non rendue";

		$ch = $bdd->query('SELECT * FROM facture WHERE id= (SELECT MAX(id) from facture);');
$chau = $ch->fetch();
		$req = $bdd->prepare('UPDATE client SET id_fact=:id_fact, location=:location WHERE id = :id');
$req->execute(array(
':id_fact' => $chau['id'],
':location' =>$cli,
':id' => $delcc['id']
));
$l="occupe";
$reqv = $bdd->prepare('UPDATE chauffeur SET status=:status, id_fact=:id_fact WHERE id = :id');
$reqv->execute(array(
':status' => $l,
':id_fact' => $chau['id'],
':id' => $del['id_cha']
));
//id client dans voiture et statut location
$l="location";

$client_nom= $delcc['nom'].' '.$delcc['prenom']; 
$reqv1 = $bdd->prepare('UPDATE vehicule SET id_client=:id_client,status=:status, id_fact=:id_fact WHERE id = :id');
$reqv1->execute(array(
':id_client' => $client_nom,
':status' => $l,
':id_fact' => $chau['id'],
':id' => $del['id_voi']
));


			//$req = $bd->query('DELETE FROM articles WHERE id_art='.$_GET['id'].';');
			
	
			$ch = $bdd->query('DELETE FROM reservations WHERE id='.$_GET['id'].';');
			
			
			//$chau = $ch->fetch();
		header('Location:accueil.php');
		exit();
		}
		
		
		
		
			//pour historique
		if($_GET['action']=="historique"){	
		
		
				//$req = $bd->query('DELETE FROM articles WHERE id_art='.$_GET['id'].';');
				$ch = $bdd->query('DELETE FROM historique WHERE id='.$_GET['id'].';');
				//$chau = $ch->fetch();
			header('Location:a_fac.php');
			exit();
			
			
			
		}
		
		
		
		
		

		
		
		
		//pour facture
			if($_GET['action']=="facture"){	
			
		$sel = $bdd->query('SELECT * FROM facture WHERE id= '.$_GET['id'].'');
		$del = $sel->fetch();
	    $lib="libre";
	    $libpp=0;
	
		$req = $bdd->prepare('UPDATE vehicule SET status=:status, id_fact=:id_fact WHERE id = :id');
$req->execute(array(
':status' =>$lib,
':id_fact' =>$libpp,
':id' => $del['id_voi']
));



//pour client voiture rendu
$cli="voiture rendue";
$valu=0;
$req = $bdd->prepare('UPDATE client SET location=:location, id_fact=:id_fact WHERE id = :id');
$req->execute(array(
':location' =>$cli,
':id_fact' =>$valu,
':id' => $del['id_cli']
));




//pour chauffeur son statu passe a libre
$l="libre";
$valuu=0;
$reqv = $bdd->prepare('UPDATE chauffeur SET status=:status, id_fact=:id_fact WHERE id = :id');
$reqv->execute(array(
':status' => $l,
':id_fact' =>$valuu,
':id' => $del['id_cha']
));


$chffd = $bdd->query('SELECT * FROM vehicule WHERE id= '.$del['id_voi'].'');
$chauffv = $chffd->fetch();

$chffv = $bdd->query('SELECT * FROM client WHERE id= '.$del['id_cli'].'');
$chauffc = $chffv->fetch();

if( $del['id_chacli'] ==0 ){ //si c'est pas un client comme chauffeur

$chff = $bdd->query('SELECT * FROM chauffeur WHERE id= '.$del['id_cha'].' ;');
$chauff = $chff->fetch();	
$nomc = $chauff['nom'].' '.$chauff['prenom'];
	//enregistrement dans histo
$req = $bdd->prepare('INSERT INTO historique(datel, dater,
datef, prixl, nbrJ, num, marque, modele, 
matricule, prixj, nom, prenom, tel, 
permis,fait,npch, operateur ) VALUES(:datel,:dater, :datef,
:prixl,:nbrJ, :num, :marque, :modele,
:matricule,:prixj,:nom,:prenom,:tel,:permis,:fait,:npch, :operateur )');
$req->execute(array(
'datel' => $del['datel'],
'dater' => $del['dater'],
'datef' => $del['datef'],
'prixl' => $del['prixl'],
'nbrJ' => $del['nbrj'],
'num' => $del['num'],
'marque' => $chauffv['marque'],
'modele' => $chauffv['modele'],
'matricule' => $chauffv['matricule'],
'prixj' => $chauffv['prix'],
'nom' => $chauffc['nom'],
'prenom' => $chauffc['prenom'],
'tel' => $chauffc['tel'],
'permis' => $chauffc['permis'],
'fait' => $del['fait'],
'npch' => $nomc,
'operateur' => $del['operateur']
));

}
else{ //alors c'est un chauffeur
	//statut du chauff passe a occupé

	
	$nom = $chauffc['nom'].' '.$chauffc['prenom'];	
		//enregistrement dans histo
$req = $bdd->prepare('INSERT INTO historique(datel, dater,
datef, prixl, nbrJ, num, marque, modele, 
matricule, prixj, nom, prenom, tel, 
permis,fait,npchc, operateur ) VALUES(:datel,:dater, :datef,
:prixl,:nbrJ, :num, :marque, :modele,
:matricule,:prixj,:nom,:prenom,:tel,:permis,:fait,:npchc, :operateur )');
$req->execute(array(
'datel' => $del['datel'],
'dater' => $del['dater'],
'datef' => $del['datef'],
'prixl' => $del['prixl'],
'nbrJ' => $del['nbrj'],
'num' => $del['num'],
'marque' => $chauffv['marque'],
'modele' => $chauffv['modele'],
'matricule' => $chauffv['matricule'],
'prixj' => $chauffv['prix'],
'nom' => $chauffc['nom'],
'prenom' => $chauffc['prenom'],
'tel' => $chauffc['tel'],
'permis' => $chauffc['permis'],
'fait' => $del['fait'],
'npchc' => $nom,
'operateur' => $del['operateur']
));
	
	}
		




						
			//$req = $bd->query('DELETE FROM articles WHERE id_art='.$_GET['id'].';');
			$ch = $bdd->query('DELETE FROM facture WHERE id='.$_GET['id'].';');
			//$chau = $ch->fetch();
		header('Location:accueil.php');
		exit();
	
		}
		

	}
   ?>
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
   
			