<?php
class AccountController
{
    private $accountService;

    function __construct()
    {
    }
    public function login()
    {
        require __DIR__ . '/../views/account/login.php';
    }

    public function signUp()
    {
     
        require __DIR__ . '/../views/account/signup.php';
    }
    public function index()
    {
        require __DIR__ . '/../views/account/index.php';
    }
}