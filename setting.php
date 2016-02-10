
<?php
session_start(); # Ouverture des sessions
include('connexion.php');
if(!$_SESSION['login']){
header('Location:index.php');
exit();
}



?>


<?php

$i=0;
if(isset($_POST['submit']))
{
	
	if(isset($_POST['nomCate'])){
		

$req = $bdd->prepare('INSERT INTO categorie(nom) VALUES(:nom)');
$req->execute(array(
'nom' => $_POST['nomCate']
));
	
header('Location:setting.php');
exit();	
	}
	
	
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
        else{
			$ui=1;
			$chi = $bdd->query('SELECT * FROM entreprise WHERE id= '.$ui.'');
			$chaui = $chi->fetch();
		$_FILES['photo']['name'] = $chaui['photo'];}
        if($i == 0)
        {
$infosfichier = pathinfo($_FILES['photo']['name']);
$extension = $infosfichier['extension'];			
if(!empty($_FILES['photo']['size'])){
			
			
			$chai='abcdefghijklmnopqrstuvwz0123456789';
			$mo= str_shuffle($chai);
			$mi= str_shuffle($chai);
			$p=substr($mo,0,3);		
			$mu=substr($mi,0,3);
			
			
			$_FILES['photo']['name']= $p.$mu.'.'.$extension;
		}
	$T=1;
$req = $bdd->prepare('UPDATE entreprise SET nom=:nom, slogan=:slogan, photo=:photo WHERE id = :id');
$req->execute(array(
':nom' => $_POST['nom'],
':slogan' => $_POST['slogan'],
':id' => $T,
':photo' => $_FILES['photo']['name']
));

//reduire la taillede l'image
 if(!empty($_FILES['photo']['size'])){
if($extension=='jpg' || $extension=='JPG' || $extension=='jpeg' || $extension=='JPEG'    )
    $source = imagecreatefromjpeg($_FILES['photo']['tmp_name']); // La photo est la source
else 
	$source = imagecreatefrompng($_FILES['photo']['tmp_name']); // La photo est la source

$destination = imagecreatetruecolor(200, 200); // On crée la miniature vide
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
	imagejpeg($destination, 'img/logo/'. basename($_FILES['photo']['name']),72);
else
	imagepng($destination, 'img/logo/'. basename($_FILES['photo']['name']),1);

//imagejpeg($destination, "mini_couchersoleil.jpg");
}


//imagejpeg($destination, "mini_couchersoleil.jpg");
//move_uploaded_file($_FILES['photo']['tmp_name'], 'avatars/' . basename($_FILES['photo']['name']));
header('Location:accueil.php');
exit();
//$id = $connexion -> id() ;
	?>	
		
		 
	<script>	
	
		 var Gritter = function () {
    
        $.gritter.add({
			//alert(nom.value)
            // (string | mandatory) the heading of the notification
            title: '<?php echo $_POST['nom'].' '.$_POST['prenom']; ?> ',
            // (string | mandatory) the text inside the notification
            text:'Vient d\'être ajouté .',
			// (string | optional) the image to display on the left
            image: 'avatars/<?php echo $_FILES['photo']['name']; ?>',
            // (bool | optional) if you want it to fade out on its own or just sit there
            sticky: true,
            // (int | optional) the time you want it to be alive for before fading out
            time: '',
			// (string | optional) the class name you want to apply to that specific message
            class_name: 'my-sticky-class'
			 // You can have it return a unique id, this can be used to manually remove it later using
        /*
         setTimeout(function(){

         $.gritter.remove(unique_id, {
         fade: true,
         speed: 'slow'
         });

         }, 6000)
         */

	   });


}();
</script>		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
	<?php										
        }
        else
        {
            header('Location:accueil.php') ;
            exit();
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
				<li><a href="#">Modification</a></li>
			</ul>		
			
			
			
			
			<?php
			$op=1;
			$ch = $bdd->query('SELECT * FROM entreprise WHERE id= '.$op.'');
			$chau = $ch->fetch();

	
		
	echo '
			
			
			
			<div class="row-fluid sortable">
				<div class="box span12 green">
					<div class="box-header blue" data-original-title>
						<h2><i class="halflings-icon white user"></i><span class="break"></span>information</h2>
						<div class="box-icon">
							
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
				
					<div class="box-content">
						<ul class="dashboard-list metro">
							<li class="green">
								
									<img src="img/logo/'.$chau['photo'].'" style="height: 150px;width: 150px; float: left;	margin: 3px 15px 0px 10px;	border: none;	border-radius:20%;" alt="Dennis Ji" >
								</a>
								<h5>
								<strong><u>Nom</u>:</strong> '.$chau['nom'].'<br><br>
								<strong><u>slogan</u>:</strong> '.$chau['slogan'].'<br><br>
								
								 ';
								 
								echo '
								            
							</h3>
							</li>
							
						</ul>
					</div>
				
	
		
				

					
				</div><!--/span-->

			</div><!--/row-->
			
			
	

		
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon white edit"></i><span class="break"></span>information de l\'entreprise </h2>
						<div class="box-icon">
							
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal" method="post" action="setting.php" enctype = "multipart/form-data">
						  <fieldset>
							<div class="control-group">
							  
							  <div class="alert alert-success">	
							    <strong>modification </strong> 
					        	</div>
							  <div class="control-group success">
								<label class="control-label" for="inputSuccess">Nom </label>
								<div class="controls">
								  <input type="text" id="inputSuccess" name="nom" value="'.$chau['nom'].'">
								  <span class="help-inline"></span>
								</div>
							  </div>
							  <div class="control-group success">
								<label class="control-label" for="inputSuccess">Slogan </label>
								<div class="controls">
								  <input type="text" id="inputSuccess" name="slogan"  value="'.$chau['slogan'].'"  >
								  <span class="help-inline"></span>
								</div>
							  </div>
					  
							  
								
											  
							  <div class="control-group">
							  <label class="control-label" for="fileInput">Photo</label>
							  <div class="controls">
								<input class="input-file uniform_on" id="fileInput" name="photo" type="file">
							  </div>
							</div>
							
							 							  
							</div>
							<div class="">
                                            <a class="btn " href="accueil.php">retour
											 										
											</a>
                                            <button  type="submit" name="submit" class="btn btn-primary">valider</button>
											
                             </div>	
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			</div><!--/row-->
			
			';
		
		
   ?>
   
   
   			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon white time"></i><span class="break"></span>Catégorie de voitures</h2>
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
								  <th>Action</th>
							  </tr>
						  </thead>   
						  <tbody>
						  <?php
$req = $bdd->query('SELECT * FROM categorie ;');
while ($data= $req->fetch())
	{
	?>						  												  
							<tr>
								<td class="center"><?php echo $data['nom'];?></td>
								
								<td class="center">
									
									<?php 
									
									if($_SESSION['level']==2){
										echo '
									
								<!--	
									<a class="btn btn-danger " href="supprimer.php?action=admin&amp;id='.$data['id_cate'].'" onclick="return sure();" >supprimer
										<i class="halflings-icon white trash"></i> 
										
									</a>
								-->
								
									<button  data-toggle="modal" data-target="#myModal2" type="submit" class="btn btn-danger " onclick="return cap('.$data['id_cate'].');" href="">supprimer
									  <i class="halflings-icon white trash"></i>
									</button>
									
									'; 
								     
											?>
											
											
											
									<?php
									
									}
									?>
								</td>
<?php
}
?>						
						  </tbody>	
							</tr>
							  
					  </table> 
					  <form class="form-horizontal" method="post" action="setting.php" >
						  <fieldset>
							<div class="control-group">
							  
							  <div class="alert alert-success">	
							    <strong>Ajouté une categorie </strong> 
					        	</div>
							  <div class="control-group success">
								<label class="control-label" for="inputSuccess">Nouvelle catégorie </label>
								<div class="controls">
								  <input type="text" id="inputSuccess" name="nomCate" >
								  <span class="help-inline"></span>
								</div>
							  </div>
						 
							 							  
							</div>
							<div class="">
                                           
                                            <button  type="submit" name="submit" class="btn btn-primary">Ajouter</button>
											
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
					<a id="myLink" href="supprimer.php?action=categorie&amp;id=s" ><button class="btn btn-primary btn-xs" ><i class="fa fa-pencil"></i>Oui</button></a>
					 ';

					?>
					
					
					
					
					
					
                     <button type="button" class="btn btn-danger" data-dismiss="modal">Non</button>
				
				
                        </div>
						
						
						
                    </div>
                  </div>
				  
				  
				  
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
	
	<script >	
												function cap(art)  //pour le changer de lien dans le modal
											{
												
											var link = document.getElementById('myLink');
											var href = link.href;
											//top.document.location="l_user.php?idi="+art; envoyer var dans page php et recuperation avec $_GET['art']
												
											link.href = "supprimer.php?action=categorie&id="+art;
											
											//alert(art);
																							
												// href = "<?php echo $data['id'];?>	";
												
											}
											</script>

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
