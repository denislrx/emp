<?php

include_once(__DIR__ . "/../Service/UserService.php");
include_once(__DIR__ . "/../Presentation/InscriptionView.php");

$erreur = false;
$messageErreur = [];
$objUser = new UserService;
if (!empty($_POST)) {

try{
  $NextId = $objUser->nextId();  
}catch(UserExceptionService $exc){
    echo $exc->getMessage();
}
    
    if (!isset($_POST["Nom"]) || empty($_POST["Nom"])) {
        $erreur = true;
        $messageErreur[] = "Erreur de saisie du mot de passe ";
    } else {

        try{
        $tabNom = $objUser->listeNom();
        }catch(UserExceptionService $exc){
            echo $exc->getMessage();
        }
        foreach ($tabNom as $nom) {
            if ($_POST["Nom"] == $nom) {
                $erreur = true;
                $messageErreur[] = "Nom déjà utilisé";
            }
        }
    }

    if (!isset($_POST["MDP1"]) || empty($_POST["MDP1"])) {
        $erreur = true;
        $messageErreur[] = "Saisisez le mot de passe une première fois";
    }

    if (!isset($_POST["MDP2"]) || empty($_POST["MDP2"])) {
        $erreur = true;
        $messageErreur[] = "Saisisez le mot de passe une seconde fois";
    }

    if ($_POST["MDP1"] == $_POST["MDP2"]) {
        $MDP = password_hash($_POST["MDP1"], PASSWORD_DEFAULT);
    } else {
        $erreur = true;
        $messageErreur[] = "Les deux saisies de mots de passe ne correspondent pas";
    }


    if (!$erreur) {
        $objProfil = new User;
        $objProfil->setNom($_POST["Nom"]);
        $objProfil->setMDP($_POST["MDP1"]);
        try{
        $objUser->insertUser($objProfil);    
        }catch(UserExceptionService $exc){
            echo $exc->getMessage();
        }
        
        header("location:connexion.php");
    }
}

afficherInscr($erreur, $messageErreur, $_POST);
