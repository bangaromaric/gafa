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
								<i class="halflings-icon white user"></i>  <?php echo " ".$_SESSION['login'];  ?>
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
				<li><a href="#">information </a></li>
			</ul>		
			
			<?php
			

	
	if (isset($_GET['action']) AND isset($_GET['id']) ){
		
		if($_GET['action']=="chauffeur"){
		$ch = $bdd->query('SELECT * FROM chauffeur WHERE id= '.$_GET['id'].'');
			$chau = $ch->fetch();
	echo '
			
			
			
			<div class="row-fluid sortable">
				<div class="box span12 green">
					<div class="box-header blue" data-original-title>
						<h2><i class="halflings-icon white user"></i><span class="break"></span></h2>
						<div class="box-icon">
							
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
				
					<div class="box-content">
						<ul class="dashboard-list metro">
							<li class="green">
								
									<img src="img/chauffeur/'.$chau['photo'].'" style="height: 192px;width: 192px; float: left;	margin: 3px 15px 0px 10px;	border: none;	border-radius:50%;" alt="Dennis Ji" >
								</a>
								<h5>
								<strong><u>Nom</u>:</strong> '.$chau['nom'].'<br><br>
								<strong><u>Prenom:</u></strong> '.$chau['prenom'].'<br><br>
								<strong><u>Téléphone</u>:</strong> '.$chau['tel'].'<br><br>
								<strong><u>Type de Permis</u>:</strong> '.$chau['permis'].'<br><br>
								<strong><u>Numéro du Permis</u>:</strong> '.$chau['numPermis'].'<br><br>
								<strong><u>Status</u>:</strong> '.$chau['status'].'<br><br>
								<strong><u>Observation</u>:</strong> '.$chau['obs'].'<br><br>
								            
							</h3>
							</li>
							
						</ul>
					</div>
				
	
		
				

					
				</div><!--/span-->

			</div><!--/row-->
			<div class="">
                                            <a class="btn " href="l_cha.php">retour
											 										
											</a>';
											if($chau['id_fact']!=0){
									echo'	
									
                                     <a class="btn btn-primary " href="vprint.php?action=facture&amp;id='.$chau['id_fact'].'">Location en cour
										 										
											</a>';
                                     }
                                     
								echo'			
                             </div>	
			
			';
	
		}
		
		
	if($_GET['action']=="vehicule"){
	$ch = $bdd->query('SELECT * FROM vehicule WHERE id= '.$_GET['id'].'');
			$chau = $ch->fetch();

			
			
	echo '
			
			
			
			<div class="row-fluid sortable">
				<div class="box span12 green">
					<div class="box-header blue" data-original-title>
						<h2><i class="halflings-icon white user"></i><span class="break"></span>Dernier Client: '.$chau['id_client'].'</h2>
						<div class="box-icon">
							
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
				
					<div class="box-content">
						<ul class="dashboard-list metro">
							<li class="green">
								
									<img src="img/voiture/'.$chau['photo'].'" style="height: 300px;width: 500px; float: left;	margin: 3px 15px 0px 10px;	border: none;" alt="Dennis Ji" >
								</a>
								<h5>
								<strong><u>Matricule</u>:</strong> '.$chau['matricule'].'<br><br>
								<strong><u>Marque</u>:</strong> '.$chau['marque'].'<br><br>
								<strong><u>Modèle</u>:</strong> '.$chau['modele'].'<br><br>
								<strong><u>Nombre de Places</u>:</strong> '.$chau['nbrP'].'<br><br>
								<strong><u>Prix par jour</u>:</strong> '.$chau['prix'].'<br><br>
								<strong><u>Status</u>:</strong> '.$chau['status'].'<br><br>
								<strong><u>Énergie</u>:</strong> '.$chau['energie'].'<br><br>
								<strong><u>Catégorie</u>:</strong> '.$chau['cate'].'<br><br>
								'; if($chau['etat']=="yes")
									echo	'<strong><u>Etat</u>:</strong> Bonne état<br><br>';
								   if($chau['etat']=="no")  
									echo	'<strong><u>Etat</u>:</strong> En panne<br><br>'; 
								
								$reqr = $bdd->query('SELECT * FROM vehicule where id='.$chau['id'].' ;');
								$chaud = $reqr->fetch();
								$reqre = $bdd->query('SELECT * FROM assurance ;');	
								while ($datae= $reqre->fetch())
								{	
									if($datae['id_voi']==$chau['id']){	
										echo' <strong><u>Nom assurance</u>:</strong> '.$datae['nom'].'<br><br>' ;
										echo' <strong><u>Assurance</u>:</strong> Du '.date("d-m-Y", strtotime($datae['assurDateDebut'])).'  au '.date("d-m-Y", strtotime($datae['assurDateFin'])).'<br><br>' ;
										}
										//echo'<i class="glyphicons-icon warning_sign"></i> ';
										// date("d-m-Y", strtotime($_SESSION['datel']));//
										
								}
								
								echo '
							</h3>
							</li>
							
						</ul>
					</div>
				
	
		
				

					
				</div><!--/span-->

			</div><!--/row-->
			
			<div class="">
                              <a class="btn " href="l_veh.php">retour
											 										
											</a>';
											if($chau['id_fact']!=0){
									echo'	
									
                                     <a class="btn btn-primary " href="vprint.php?action=facture&amp;id='.$chau['id_fact'].'">Location en cour
										 										
											</a>';
                                     }
                                     
								echo'			
                             </div>	
			
			';
	
		}	
		//pour client
		if($_GET['action']=="client"){
		$ch = $bdd->query('SELECT * FROM client WHERE id= '.$_GET['id'].'');
			$chau = $ch->fetch();
			
			
	echo '
			
		<div class="row-fluid sortable">
				<div class="box span12 green">
					<div class="box-header blue" data-original-title>
						<h2><i class="halflings-icon white user"></i><span class="break"></span>Client</h2>
						<div class="box-icon">
							
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
				
					<div class="box-content">
						<ul class="dashboard-list metro">
							<li class="green">
								
									<img src="img/client/'.$chau['photo'].'" style="height: 192px;width: 192px; float: left;	margin: 3px 15px 0px 10px;	border: none;	border-radius:50%;" alt="Dennis Ji" >
								</a>
								<h5>
								<strong><u>Nom</u>:</strong> '.$chau['nom'].'<br><br>
								<strong><u>Prenom</u>:</strong> '.$chau['prenom'].'<br><br>
								<strong><u>Téléphone</u>:</strong> '.$chau['tel'].'<br><br>
								<strong><u>Numero de Permis</u>:</strong> '.$chau['permis'].'<br><br>
								<strong><u>Type de Permis</u>:</strong> '.$chau['numPermis'].'<br><br>
								
								            
							</h3>
							</li>
							
						</ul>
					</div>
									
				</div><!--/span-->

			</div><!--/row-->
			<div class="">
                                            <a class="btn " href="l_cli.php">retour
											 										
											</a>
											';
											if($chau['id_fact']!=0){
									echo'	
									
                                     <a class="btn btn-primary " href="vprint.php?action=facture&amp;id='.$chau['id_fact'].'">Location en cour
										 										
											</a>';
                                     }
								echo'			
                             </div>	
			
			';
	
		}
		
		
		if($_GET['action']=="admin"){
		$ch = $bdd->query('SELECT * FROM admin WHERE id= '.$_GET['id'].'');
			$chau = $ch->fetch();
			
			
	echo '
			
			
			
			<div class="row-fluid sortable">
				<div class="box span12 green">
					<div class="box-header blue" data-original-title>
						<h2><i class="halflings-icon white user"></i><span class="break"></span>Utilisateur</h2>
						<div class="box-icon">
							
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
				
					<div class="box-content">
						<ul class="dashboard-list metro">
							<li class="green">
								
									<img src="img/user/'.$chau['photo'].'" style="height: 192px;width: 192px; float: left;	margin: 3px 15px 0px 10px;	border: none;	border-radius:50%;" alt="Dennis Ji" >
								</a>
								<h5>
								<strong><u>Login</u>:</strong> '.$chau['login'].'<br><br>
								<strong><u>Nom</u>:</strong> '.$chau['nom'].'<br><br>
								<strong><u>Prenom</u>:</strong> '.$chau['prenom'].'<br><br>
								<strong><u>Téléphone</u>:</strong> '.$chau['tel'].'<br><br>
								<strong><u>e-mail</u>:</strong> '.$chau['mail'].'<br><br>
								<strong><u>Dernière connexion</u>:</strong> '.$chau['heurco'].'<br><br>
								<strong></strong><strong><u>Dernière deconnexion</u>:</strong> '.$chau['heurde'].'<br>
								
								
								            
							</h5>
							</li>
							
						</ul>
					</div>
				
	
		
				

					
				</div><!--/span-->

			</div><!--/row-->
			<div class="">
                                            <a class="btn " href="l_user.php">retour
											 										
											</a>
                                     
											
                             </div>	
			
			';
	
		}
		
		
		
		
		if($_GET['action']=="facture"){
		$ch = $bdd->query('SELECT * FROM facture WHERE id= '.$_GET['id'].'');
			$chau = $ch->fetch();
		$reqc = $bdd->query('SELECT * FROM client WHERE id='.$chau['id_cli'].' ;');
				$datac= $reqc->fetch();
			$reqv = $bdd->query('SELECT * FROM vehicule WHERE id='.$chau['id_voi'].' ;');
				$datav= $reqv->fetch();	
			
			$cha = $bdd->query('SELECT * FROM chauffeur WHERE id='.$chau['id_cha'].' ;');
				$chauff= $cha->fetch();	
				
			
	echo '
			
			
			
			<div class="row-fluid sortable">
				<div class="box span12 green">
					<div class="box-header blue" data-original-title>
						<h2><i class="halflings-icon white user"></i><span class="break"></span></h2>
						<div class="box-icon">
							
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
				
					<div class="box-content">
						<ul class="dashboard-list metro">
							<li class="green">
								</a>
								<h5>
								<strong>Nom: </strong> '.$datac['nom'].'<br>
								<strong>Prenom: </strong> '.$datac['prenom'].'<br>
								<strong>Marque: </strong> '.$datav['marque'].'<br>
								<strong>Modèle: </strong> '.$datav['modele'].'<br>
								<strong>Prix par Jour: </strong> '.$datav['prix'].' (FCFA)<br>
								<strong>Date de Location: </strong> '.date("d-m-Y", strtotime($chau['datel'])).'<br>
								<strong>Date de Retour: </strong> '.date("d-m-Y", strtotime($chau['dater'])).'<br>
								<strong>Date de Facturation:</strong> '.date("d-m-Y", strtotime($chau['datef'])).'<br>
								<strong>Nombre de Jour: </strong> '.$chau['nbrj'].'<br>
								<strong>Prix:</strong> '.$chau['prixl'].' (FCFA)<br>';
								if( $chau['id_chacli']==0)		
								echo '<strong>Chauffeur: </strong>'.$chauff['nom'].' '.$chauff['prenom'].'<br>';
								
								else																         
									echo '<strong>Chauffeur client: </strong>'.$datac['nom'].' '.$datac['prenom'].'<br>';
								echo '
							</h3>
							</li>
							
						</ul>
					</div>
				
	
		
				

					
				</div><!--/span-->

			</div><!--/row-->
			<div class="">
                                            <a class="btn " href="accueil.php">retour
											 										
											</a>
                                     
											
                             </div>	
			
			';
	
		}
	
	}
   ?>
			
			
			
			
       

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
