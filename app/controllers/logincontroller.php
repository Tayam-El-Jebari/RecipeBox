<?php
require __DIR__ . '/../services/loginservice.php';

class LoginController
{
    private $loginservice;
    function __construct()
    {
            $this->loginservice = new LoginService();
    }
    public function index()
    {
        require __DIR__ . '/../views/login/index.php';
    }
    public function loginToAccount(){
        $response = array(
            'status' => 1,
            'message' => 'Inloggen gelukt, je wordt nu gebracht naar de homepagina.'
        );
        try{
            $this->loginservice->login();
        }catch(ErrorException $e){
            $response['message'] = $e->getMessage();
            $response['status'] = 0;
        }
        echo json_encode($response);
    }
}