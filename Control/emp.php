<?php
include_once(__DIR__ . "/../Service/EmployeService.php");
include_once(__DIR__ . "/../Presentation/TableauView.php");

session_start();
$profil = $_SESSION["Profil"];
$objService = new EmployeService;
$compteur = $objService->counter();
$objSelectAll = $objService->selectAll();
$tabChef = $objService->detailChef();
$tabNoEmpChef = $objService->listChef();
afficherTableau($compteur, $profil, $objSelectAll, $tabNoEmpChef);
