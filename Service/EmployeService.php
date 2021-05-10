<?php

include_once(__DIR__ . "/../DAO/EmployeDAO.php");

class EmployeService
{

    public function SelectAll(): array
    {
        $EmployeDAO = new EmployeDAO;
        $Employe = $EmployeDAO->SelectAll();
        return $Employe;
    }

    public function Insertion(Employe $obj): void
    {
        $objDAO = new EmployeDAO;
        $objDAO->Insertion($obj);
    }

    public function UpdateALine(Employe $obj, int $id): void
    {
        $objDAO = new EmployeDAO;
        $objDAO->UpdateALine($obj, $id);
    }

    public function showDetailById($id): Employe
    {
        $EmployeDAO = new EmployeDAO;
        $Employe = $EmployeDAO->showDetailById($id);
        return $Employe;
    }

    public function deleteLine($id): void
    {
        $objDAO = new EmployeDAO;
        $objDAO->deleteLine($id);
    }

    public function detailChef(): array
    {
        $EmployeDAO = new EmployeDAO;
        $TabChef = $EmployeDAO->detailChef();
        return $TabChef;
    }

    public function counter(): int
    {
        $obj = new EmployeDAO;
        $compteur = $obj->counter();
        return $compteur;
    }

    public function listChef(): array
    {
        $obj = new EmployeDAO;
        $listChef = $obj->listChef();
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
        $nextId = $obj->NextId();
        return $nextId;
    }
}
