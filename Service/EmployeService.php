<?php

include_once(__DIR__ . "/../DAO/EmployeDAO.php");
include_once(__DIR__ . "/../Exception/EmpExceptionService.php");



class EmployeService
{

    public function SelectAll(): array
    {
        $EmployeDAO = new EmployeDAO;
        try{
            $Employe = $EmployeDAO->SelectAll();
        }catch(EmpExceptionDAO $exc){
            throw new EmpExceptionService($exc->getMessage());
        }
        
        return $Employe;
    }

    public function Insertion(Employe $obj): void
    {
        $objDAO = new EmployeDAO;
        try{
        $objDAO->Insertion($obj);    
        }catch(EmpExceptionDAO $exc){
            throw new EmpExceptionService($exc->getMessage());
        }
        
    }

    public function updateALine(Employe $obj, int $id): void
    {
        $objDAO = new EmployeDAO;
        try{
        $objDAO->updateALine($obj, $id);    
        }catch(EmpExceptionDAO $exc){
            throw new EmpExceptionService($exc->getMessage());
        }
        
    }

    public function showDetailById($id): Employe
    {
        $EmployeDAO = new EmployeDAO;
        try{
        $Employe = $EmployeDAO->showDetailById($id);    
        }catch(EmpExceptionDAO $exc){
            throw new EmpExceptionService($exc->getMessage());
        }
        
        return $Employe;
    }

    public function deleteLine($id): void
    {
        $objDAO = new EmployeDAO;
        try{
        $objDAO->deleteLine($id);     
        }catch(EmpExceptionDAO $exc){
            throw new EmpExceptionService($exc->getMessage());
        }
    }

    public function detailChef(): array
    {
        $EmployeDAO = new EmployeDAO;
        try{
        $TabChef = $EmployeDAO->detailChef();    
        }catch(EmpExceptionDAO $exc){
            throw new EmpExceptionService($exc->getMessage());
        }
        
        return $TabChef;
    }

    public function counter(): int
    {
        $obj = new EmployeDAO;
        try{
        $compteur = $obj->counter();    
        }catch(EmpExceptionDAO $exc){
            throw new EmpExceptionService($exc->getMessage());
        }
        
        return $compteur;
    }

    public function listChef(): array
    {
        $obj = new EmployeDAO;
        try{
        $listChef = $obj->listChef();    
        }catch(EmpExceptionDAO $exc){
            throw new EmpExceptionService($exc->getMessage());
        }

        $tabNoEmpChef = [];
        foreach ($listChef as $value) {
            $c = $value["Sup"];
            $tabNoEmpChef[] = $c;
        }
        return $tabNoEmpChef;
    }

    public function nextId(): int
    {   
        $obj = new EmployeDAO;
        try{
        $nextId = $obj->NextId();    
        }catch(EmpExceptionDAO $exc){
            throw new EmpExceptionService($exc->getMessage());
        }
        
        return $nextId;
    }
}
