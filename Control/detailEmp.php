<?php

include_once(__DIR__ . "/../Service/EmployeService.php");
include_once(__DIR__ . "/../Presentation/TableauView.php");

session_start();
if (!isset($_SESSION) || empty($_SESSION) || $_SESSION["Profil"] == "user") {
    header("location: connexion.php");
}

    $obj = new EmployeService;
    if (isset($_GET["id"])) {
        try{
                $data = $obj->showDetailById($_GET["id"]);    
        }catch(EmpExceptionService $exc){
            echo $exc->getMessage();
        }
    }


    affichDetail($data, $_GET["id"]);    
   