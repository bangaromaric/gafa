<?php
session_start(); # Ouverture des sessions
include('connexion.php');
if(!$_SESSION['login']){
header('Location:index.php');
exit();





}
?>	
<?php 
ob_start();
?>
<style type="text/css">
<!--
table
{
    width:  100%;
    border:none;
    border-collapse: collapse;
}
th
{
    text-align: center;
    border: solid 1px #eee;
    background: #f8f8f8;
}
td
{
    text-align: center;
     
    
}
.dataTable td{
padding:10px 5px;
background-color:#efefef;
}
.dataTable th{
padding:10px 5px;
}

img {
   max-height : ???px ;
   max-width : ???px ;
}

-->
</style>
<!DOCTYPE html>
<html lang="en">
<head>
	
	<!-- start: Meta -->
	<meta charset="utf-8">
	<title>Parc Auto</title>
	<meta name="description" content="Bootstrap Metro Dashboard">
	<meta name="author" content="Dennis Ji">
	<meta name="keyword" content="Metro, Metro UI, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
	<!-- end: Meta -->
	
	<!-- start: Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- end: Mobile Specific -->
	
	<!-- start: CSS -->
	<!-- end: CSS -->
	<link rel="stylesheet" href="print.css" type="text/css" media="print" />

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

<?php

 //$date->format('D Y-m-d H:i:s - \s\e\m\a\i\n\e W');
 $ch = $bdd->query('SELECT * FROM vehicule WHERE id= '.$_SESSION['id_voit'].'');
 $chau = $ch->fetch();

 if($_SESSION['client']==1){ //si c'est un client comme chauffeur'

$chff = $bdd->query('SELECT * FROM client WHERE id='.$_SESSION['id_cha'].' ;');
$chauff = $chff->fetch();	
	}
	else{ //alors c'est un chauffeur'
		
		$chff = $bdd->query('SELECT * FROM chauffeur WHERE id='.$_SESSION['id_cha'].' ;');
$chauff = $chff->fetch();
	}
		
 
 
$rete = $bdd->query('SELECT * FROM entreprise');
$ent = $rete->fetch();
	
	

echo '

<page style="font-size: 12pt" backimg="./images/sign.png" backimgy="bottom">
    <table cellspacing="0" style="width: 100%; text-align: center; font-size: 14px">
        <tr>
            <td style="width: 25%; color: #444444;">
                <img style="max-width: 200px;" src="img/logo/'.$ent['photo'].' " alt="Logo"><br><br>
                '.$ent['slogan'].'
            </td>
            <td style="width: 75%;">
            <table cellspacing="0" style="width: 100%; text-align: left; font-size: 11pt;">
        <tr>
            <td style="width:50%;"></td>
            <td style="width:14%;text-align:left; ">Client</td>
            <td style="width:36%">M. '.$_SESSION['nom'].' '.$_SESSION['prenom'].'</td>
        </tr>
        <tr>
            <td style="width:50%;"></td>
            <td style="width:14%;text-align:left; ">Permis</td>
            <td style="width:36%">
                '.$_SESSION['permis'].'
            </td>
        </tr>
        
        <tr>
            <td style="width:50%;"></td>
            <td style="width:14%;text-align:left; ">Téléphone</td>
            <td style="width:36%">(241) '.$_SESSION['tel'].'</td>
        </tr>
 </table>
    
    
<barcode type="EAN13" value="123467891245" style="margin-left:100mm;margin-top:10mm;width: 30mm; height: 12mm; font-size: 4mm"></barcode>
      
</td>
 </tr>
</table>
    <br>
    <br>
    <table cellspacing="0" style="width: 100%; text-align: left;font-size: 10pt">
        <tr>
            <td style="width:50%;"></td> 
            <td style="width:50%; ">Libreville, le '.$_SESSION['fait'].'   </td>
        </tr>
    </table>
    <br>  
    <i>
	Numero : #'.date("Ym").'-'.$_SESSION['num'].' <br><br>

        <b><u>Objet </u>: &laquo; Location de voiture &raquo;</b><br><br>
        
    </i>
    <br>
    <br>
    Madame, Monsieur, Cher Client,<br>
    <br>
    <br>
    Voici votre commande: <br />
    <br>
    <table class="dataTable" cellspacing="0" style="width: 100%; border: solid 1px black; background: #E7E7E7; text-align: center; font-size: 10pt;">
        <tr>
            <th style="width: 20%">Matricule</th>
            <th style="width: 20%">Marque</th>
            <th style="width: 20%">Modèle</th>';
			if($_SESSION['client']==1)
			echo '<th style="width: 20%">Chauffeur client</th>';
            else
			echo '<th style="width: 20%">Chauffeur</th>';
		echo '
        </tr>
    </table>
    <table class="dataTable" cellspacing="0" style="width: 100%; border: solid 1px black; background: #E7E7E7; text-align: center; font-size: 10pt;">
        <tr>
            <td style="width: 20%">'.$chau['matricule'].'</td>
            <td style="width: 20%">'.$chau['marque'].'</td>
            <td style="width: 20%; text-align:right;">'.$chau['modele'].'</td>
            <td style="width: 20%; text-align:right;">'.$chauff['nom'].' '.$chauff['prenom'].'</td>
            
        </tr>
        
        
    </table>
	<table class="dataTable" cellspacing="0" style="width: 100%; border: solid 1px black; background: #E7E7E7; text-align: center; font-size: 10pt;">
        <tr>
            <th style="width: 20%">Date de location</th>
            <th style="width: 20%">Date de retour</th>
            <th style="width: 20%">Date de facturation</th>
            <th style="width: 20%">Prix par jour</th>
            <th style="width: 20%">Nombre de Jour</th>
			
        </tr>
    </table>
	<table class="dataTable" cellspacing="0" style="width: 100%; border: solid 1px black; background: #E7E7E7; text-align: center; font-size: 10pt;">
        <tr>
            <td style="width: 20%">'.$_SESSION['Dloc'].'</td>
            <td style="width: 20%">'.$_SESSION['Dret'].'</td>
            <td style="width: 20%; text-align:right;">'.$_SESSION['Dfac'].'</td>
            <td style="width: 20%; text-align:right;">'.$chau['prix'].' FCFA</td>
            <td style="width: 20%; text-align:right;">'.$_SESSION['Nbrj'].'</td>
        </tr>
        
        <tr>
       <th style="width: 20%;"></th>
       <th style="width: 20%;"></th>
       <th style="width: 20%;"></th>
            <th style="width: 20%; text-align:right;">Total</th>
            <th style="width: 20%; text-align:right;">'.$_SESSION['prixl'].' FCFA</th>
        </tr>
    </table>
	
</page>
<br /><br />
A bientôt,
<br /><br />
    <button id="impression" style="margin-left: 650px;" value="Imprimer cette page" name="impression" class="btn btn-primary pull-right" onclick="imprimer_page()"><i class="fa fa-print"></i> Imprimer</button>
    <button id="impression" style="margin-left: 30px;" > 
	<a href="accueil.php"> Accueil</a>
	</button>

	';
	
	?>
<script type="text/javascript">
function imprimer_page(){
  window.print();

}
</script>
<?php 
/*
    $content = ob_get_clean();
    require_once( __DIR__ . "/html2pdf.class.php");
    try
    {
        $html2pdf = new HTML2PDF("P", "A4", "fr");
       
        $html2pdf->setDefaultFont("Arial");
        $html2pdf->writeHTML($content);
        $html2pdf->Output("votre_pdf.pdf");
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }*/
?>