<?php
include_once(__DIR__ . "/../DAO/UserDAO.php");
include_once(__DIR__ . "/../Exception/UserExceptionService.php");

class UserService
{

    public function searchByName($name): User
    {
        $UserDAO = new UserDAO;
        try{
            $User = $UserDAO->searchByName($name);
        }catch(UserExceptionDAO $exc){
            throw new UserExceptionService($exc->getMessage());
        }
        
        return $User;
    }

    public function listeNom(): array
    {
        $UserDAO = new UserDAO;
        try{
            $User = $UserDAO->listeNom();
        }catch(UserExceptionDAO $exc){
            throw new UserExceptionService($exc->getMessage());
        }
        
        return $User;
    }


    public function insertUser(User $obj): void
    {
        $MDPHash = password_hash($obj->getMDP(), PASSWORD_DEFAULT);
        $obj->setMDP($MDPHash);
        $userDAO = new UserDAO;
        try{
            $userDAO->insertUser($obj);
        }catch(UserExceptionDAO $exc){
            throw new UserExceptionService($exc->getMessage());
        }

    }

    public function nextId(): int
    {
        $obj = new UserDAO;
        try{
            $nextId = $obj->nextId();
        }catch(UserExceptionDAO $exc){
            throw new UserExceptionService($exc->getMessage());
        }
        
        return $nextId;
    }
}
