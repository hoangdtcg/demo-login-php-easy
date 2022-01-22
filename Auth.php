<?php
session_start();

class Auth
{
    public $users;
    public $dataPath;

    public function __construct()
    {
        $this->dataPath = "user.json";
        $this->users = $this->loadData();
    }

    public function login($request)
    {
        $email = $request["email"];
        $password = $request["password"];
        foreach ($this->users as $user){
            if($user->email == $email){
                if($user->password == $password){
                    $_SESSION["user"] = $user;
                    header("Location:index.php");
                }
            }
        }
    }

    public function logout()
    {
        session_destroy();
        header("location:login.php");
//        unset($_SESSION["user"]);
    }

    public function getAllUser()
    {
        return $this->users;
    }

    public function getDataChat($fileName)
    {
        $dataJson = file_get_contents($fileName);
        return json_decode($dataJson);
    }


    public function loadData()
    {
        $dataJson = file_get_contents($this->dataPath);
        return json_decode($dataJson);
    }
}