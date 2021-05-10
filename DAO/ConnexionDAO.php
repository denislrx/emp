<?php



class ConnexionDAO
{
    protected function connexion()
    {
        $bdd = new mysqli("localhost", "root", "", "personnel_bdd");
        return $bdd;
    }
}
