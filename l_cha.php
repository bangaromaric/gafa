<?php
session_start(); # Ouverture des sessions
include('connexion.php');
if(!$_SESSION['login']){
header('Location:index.php');
exit();
}
if(isset($_GET['noty']))
{
?>
<script>	
		
			window.onload = function () { 
		 
		$.gritter.add({
			// (string | mandatory) the heading of the notification
			title: '',
			// (string | mandatory) the text inside the notification
			text: '<h3>Modification reussite</h3>'
		});

		 }


</script>	
<?php		
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
				<li><a href="#">Liste des chauffeurs</a></li>
			</ul>		
			
			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon white time"></i><span class="break"></span>chauffeurs</h2>
						<div class="box-icon">
							
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>Nom</th>
								  <th>Prenom</th>
								  <th>Téléphone</th>
								  <th>Type de Permis</th>
								  <th>status</th>
								  <th>Observation</th>
								  <th>Action</th>
							  </tr>
						  </thead>   
						  <tbody>
						  <?php
$req = $bdd->query('SELECT * FROM chauffeur ;');
while ($data= $req->fetch())
	{
	?>						  												  
							<tr>
								<td class="center"><?php echo $data['nom'];?></td>
								<td class="center"><?php echo $data['prenom'];?></td>
								<td class="center"><?php echo $data['tel'];?></td>
								<td class="center"><?php echo $data['permis'];?></td>
								<td class="center">
								<?php if($data['status']=="occupe")    	
									echo '<span class="label label-important">'.$data['status'].'</span>';
								      elseif($data['status']=="libre")    	
									echo '<span class="label label-success">'.$data['status'].'</span>';
										else
											echo '<span class="label">Aucun</span>';
											
										?>
						
								</td>
								<td class="center">
								<?php     	
									echo $data['obs'];
								      		
										?>
						
								</td>
								<td class="center">
								
									<a class="btn btn-info " href="affiche.php?action=chauffeur&amp;id=<?php echo $data['id'];?>" >voir
										<i class="halflings-icon white zoom-in"></i>                                            
									</a>
									<?php
									if($_SESSION['level']==2){
										echo'
									<a class="btn btn-info" href="modifier.php?action=chauffeur&amp;id='.$data['id'].'" >modifier
										<i class="halflings-icon white edit"></i>                                            
									</a>
									<!-- 
									<a class="btn btn-danger " href="supprimer.php?action=chauffeur&amp;id='.$data['id'].'">supprimer
										<i class="halflings-icon white trash"></i> 
										
									</a>
									-->
									<!-- -->
									<button  data-toggle="modal" data-target="#myModal2" type="submit" class="btn btn-danger "  onclick="return cap('.$data['id'].');" href="">supprimer
									  <i class="halflings-icon white trash"></i>
									</button>
									';}
									?>
								</td>
<?php
}
?>						
						  </tbody>	
							</tr>
							  
					  </table> 
					  
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
			
			
			<div class="col-lg-4">
                        <div >
                        
                        <div >
                            <a class="btn btn-info" href="add_ch.php" >ajouter
										<i class="halflings-icon white plus-sign"></i>                                            
									</a>
                             
                        </div>
                    </div>
                    </div>
			
  

	</div><!--/.fluid-container-->
	
			<!-- end: Content -->
		</div><!--/#content.span10-->
		</div><!--/fluid-row-->
	
	
	
		<script >	
												function cap(art)  //pour le changer de lien dans le modal
											{
												
											var link = document.getElementById('myLink');
											var href = link.href;
											//top.document.location="l_user.php?idi="+art; envoyer var dans page php et recuperation avec $_GET['art']
												
											link.href = "supprimer.php?action=chauffeur&id="+art;
											
											//alert(art);
																							
												// href = "<?php echo $data['id'];?>	";
												
											}
											</script>

	
	<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
              <div class="modal-dialog">
                <div class="modal-content" id="div1">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Confirmation </h4>
                     
                  </div>
                  <div class="modal-body">
					
					<p>Voulez vous vraiment supprimer?</p>
	
					
                  </div>
  
                  <div class="modal-footer" >
                  <div class="row no-print">	
                        <div class="col-xs-12">
				<?php 
				echo '
					<a id="myLink" href="supprimer.php?action=chauffeur&amp;id=s" ><button class="btn btn-primary btn-xs" ><i class="fa fa-pencil"></i>Oui</button></a>
					 ';

					?>
					
					
					
					
					
					
                     <button type="button" class="btn btn-danger" data-dismiss="modal">Non</button>
				
				
                        </div>
						
						
						
                    </div>
                  </div>
				  
				  
				  
                </div>
              </div>
            </div>
	
	
	
	<div class="modal hide fade green" id="myModal">	
		<div class="box-header blue">
						<h2><i class="halflings-icon white user"></i><span class="break"></span>Voulez vous vraiment supprimer?</h2>
						<button type="button" class="close" data-dismiss="modal"><i class="halflings-icon white remove"></i></button>
					</div>
		
					<div class="box-content">
						<div class="">
                                            <a class="btn " href="l_cha.php">retour</a>
                                            <a class="btn btn-primary"   >valider</a>
											
                             </div>	
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
