<?php
 session_start();
 if($_SESSION["autoriser"]!="oui"){
	header("location:login.php");
	exit();
 }
else {
$cin=$_SESSION["cin"];
$nom=$_REQUEST['nom'];
$prenom=$_REQUEST['prenom'];
$email=$_REQUEST['email'];
$adresse=$_REQUEST['adresse'];
$pwd=$_REQUEST['pwd'];
$cpwd=$_REQUEST['cpwd'];
$classe=$_REQUEST['classe'];


include("connexion.php");
            $req="update etudiant set nom=? ,prenom=?, email=?,adresse=?,password=?,cpassword=?,classe=? where cin=?";
            $reponse = $pdo->prepare($req) ;
            $reponse->execute(array($nom,$prenom,$email,$adresse,md5($pwd),md5($cpwd),$classe,$cin));
            header("location:ModifierEtudiant.php");
}
?>