<?php
 session_start();
 if($_SESSION["autoriser"]!="oui"){
	header("location:login.php");
	exit();
 }
else {
$nom=$_SESSION['nom'];
$classe=$_REQUEST['classe'];


include("connexion.php");
            $req="update groupe set nom=? where nom=?";
            $reponse = $pdo->prepare($req) ;
            $reponse->execute(array($classe,$nom));
            header("location:ModifierGroupe.php");
}
?>