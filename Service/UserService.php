<?php
include_once(__DIR__ . "/../DAO/UserDAO.php");

class UserService
{

    public function searchByName($name): User
    {
        $UserDAO = new UserDAO;
        $User = $UserDAO->searchByName($name);
        return $User;
    }

    public function listeNom(): array
    {
        $UserDAO = new UserDAO;
        $User = $UserDAO->listeNom();
        return $User;
    }


    public function insertUser(User $obj): void
    {
        $MDPHash = password_hash($obj->getMDP(), PASSWORD_DEFAULT);
        $obj->setMDP($MDPHash);
        $userDAO = new UserDAO;
        $userDAO->insertUser($obj);
    }

    public function nextId(): int
    {
        $obj = new UserDAO;
        $nextId = $obj->NextId();
        return $nextId;
    }
}
