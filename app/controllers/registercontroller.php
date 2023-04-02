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
        if ($_SERVER["CONTENT_TYPE"] == "application/json") {
            // Read the JSON data from the request body
             $json_data = file_get_contents("php://input");
             $data = json_decode($json_data, true);
            $response['message'] = $data["firstname"];;
            echo json_encode($response);}
        }
        //
        // try{
        //     $firstname = $_POST['firstname'] ?? '';
        //     $lastname = $_POST['lastname'] ?? '';
        //     $email = $_POST['email'] ?? '';
        //     $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        //     $postalcode = $_POST['postalcode'] ?? '';
        //     $housenumber = $_POST['housenumber'] ?? '';
        //     $this->registerService->register($firstname, $lastname, $email, $password, $postalcode, $housenumber);
        // }catch(ErrorException $e){
        //     $response['message'] = $e->getMessage();
        //     $response['status'] = 0;
        // }
        // echo json_encode($response);
    }