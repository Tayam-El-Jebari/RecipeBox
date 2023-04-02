<?php
require_once __DIR__ . '/controller.php';
require __DIR__ . '/../services/accountservice.php';
require_once __DIR__ . '/../models/account.php';

class AccountController extends Controller
{
    private $service;

    function __construct()
    {
        $this->service = new AccountService();
    }
    public function index()
    {
        if (isset($_SESSION['userID'])) {
            //$this->overview();
        } else {
            $models = [];
            $this->displayView($models);
        }
    }
    public function createAccount()
    {
        $response = array(
            'status' => 1,
            'message' => 'Account is successfully created! You can now login'
        );
        // Read the JSON data from the request body
        $json_data = file_get_contents("php://input");
        $data = json_decode($json_data, true);
        try {
            $this->service->register($data["firstName"], $data["firstName"], $data["email"], $data["password"], $data["postalCode"], $data["houseNumber"]);
        } catch (ErrorException $e) {
            $response['status'] = 0;
            $response['message'] = $e->getMessage();
        }
        echo json_encode($response);
    }
    public function login()
    {
        $jsonData = file_get_contents('php://input');
        $data = json_decode($jsonData, true);
        $response = array(
            'status' => 1,
            'message' => "login successfull, redirecting to home page. Please wait... <br>if nothing happends; click <a href='/'>here</a>"
        );

        try {
            if (isset($data["email"]) && isset($data["password"])) {
                $user = $this->service->login($data["email"], $data["password"]);
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }
                $_SESSION['userID'] = $user->getUserID();
                $_SESSION['firstname'] = $user->getFirstname();
            } else {
                $response['status'] = 0;
                $response['message'] = "Email or password is not provided.";
            }
        } catch (ErrorException $e) {
            $response['status'] = 0;
            $response['message'] = $e->getMessage();
        }
        echo json_encode($response);
    }
    public function logout()
    {
        $this->service->logout();
    }
}
