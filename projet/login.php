<?php
   session_start();
   @$login=$_POST["email"];
   @$pass=md5($_POST["pass"]);
   @$valider=$_POST["valider"];
   $erreur="";
   if(isset($valider)){
      include("connexion.php");
      $sel=$pdo->prepare("select * from enseignant where login=? and pass=? limit 1");
      $sel->execute(array($login,$pass));
      $tab=$sel->fetchAll();
      if(count($tab)>0){
         $_SESSION["prenomNom"]=ucfirst(strtolower($tab[0]["prenom"])).
         " ".strtoupper($tab[0]["nom"]);
         $_SESSION["autoriser"]="oui";
         $_SESSION["modifier"]="";
         $_SESSION["ajout"]="";
         $_SESSION["chercher"]="";
         $_SESSION["supp"]="";
         $_SESSION["classeS"]="";
        $_SESSION["envoyer"]="";
        $_SESSION["semaine"]="";
        $_SESSION["matiere"]="";
        $_SESSION["date"]="";
        $_SESSION["groupePar"]="";
         header("location:index.php");
      }
      else
         $erreur="Login or Password Incorect!";
   }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>SCO-ENICAR Se Connecter</title>

    <!-- Bootstrap core CSS -->


    <link href="bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
      .erreur{
        color:red;
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
  </head>
  <body class="text-center">

<div id="erreur" class="erreur"></div>
<form id="myForm" method="post" class="form-signin" action="">
<img class="mb-4" style="height: 180px; width: auto;" src="logoa.png" alt="" width="72" height="72">
  <h1 class="h3 mb-3 font-weight-normal">Veuillez vous connecter</h1>
  <label for="inputEmail"  class="sr-only">Email </label>
  <input  type="email" id="inputEmail" name="email" class="form-control"  required autofocus>
  <label for="inputPassword"  class="sr-only">Mot de Passe</label>
  <input type="password" id="inputPassword" name="pass" class="form-control" placeholder="Password" required >
  <h6 class="erreur" color="red"><?php echo $erreur?></h6>
  <button class="btn btn-lg btn-primary btn-block" name="valider" type="submit">Se Connecter</button>
  <br><a href="inscription.php"> Créer un Compte</a>
  <p style="text-align: center ;" class="mt-5 mb-3 text-muted">&copy; SOC-Enicar 2021-2022</p>
</form>
</script>
  </body>
</html>
