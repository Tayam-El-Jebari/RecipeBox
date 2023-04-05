<?php
require __DIR__ . '/../repositories/accountrepository.php';

class LoginService {
    private $repository;
    function __construct()
    {
        $this->repository = new AccountRepository();
    }
    public function login() {
        $this->repository->login();
    }

}