
<?php

include_once(__DIR__ . "/../Service/EmployeService.php");

if (isset($_GET["id"])) {

    $objService = new EmployeService;
    try{
    $objService->deleteLine($_GET["id"]);   
    }catch(EmpExceptionService $exc){
        echo $exc->getMessage();
    }
    
}

header("location:emp.php");
