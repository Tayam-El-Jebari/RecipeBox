<?php
require __DIR__ . '/../services/registerservice.php';

class RegisterController
{
    private $registerService;

    function __construct()
    {
            $this->registerService = new RegisterService();
    }
    public function index()
    {
        require __DIR__ . '/../views/register/index.php';
    }
    public function createAccount(){
        $response = array(
            'status' => 1,
            'message' => 'Account is aangemaakt. Je kan nu inloggen.'
        );
        try{
            $this->registerService->register();
        }catch(ErrorException $e){
            $response['message'] = $e->getMessage();
            $response['status'] = 0;
        }
        echo json_encode($response);
    }
}