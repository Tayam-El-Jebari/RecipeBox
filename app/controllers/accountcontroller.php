<?php
require_once __DIR__ . '/controller.php';
require __DIR__ . '/../services/accountservice.php';
require __DIR__ . '/../services/cartservice.php';
require_once __DIR__ . '/../models/account.php';


class AccountController extends Controller
{
    private $accountService;
    private $cartService;

    function __construct()
    {
        $this->accountService = new AccountService();
        $this->cartService = new CartService();

    }
    public function index()
    {
        if (isset($_SESSION['userID'])) {
            $this->overview();
        } else {
            $models = [];
            $this->displayView($models);
        }
    }public function createAccount()
    {
        $response = array(
            'status' => 1,
            'message' => 'Account is successfully created! You can now login'
        );
        // Read the JSON data from the request body
        $json_data = file_get_contents("php://input");
        $data = json_decode($json_data, true);
        
        if ($data !== null) {
            try {
                $this->accountService->register($data["firstName"], $data["lastName"], $data["email"], $data["password"], $data["postalCode"], $data["houseNumber"]);
            } catch (ErrorException $e) {
                $response['status'] = 0;
                $response['message'] = $e->getMessage();
            }
        } else {
            $response['status'] = 0;
            $response['message'] = "Invalid input data format. Please check the provided data.";
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
                $user = $this->accountService->login($data["email"], $data["password"]);
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
        $this->accountService->logout();
    }
    public function overview()
    {
        if (isset($_SESSION['userID'])) {
            $models = [
                "account" => $this->accountService->getUser($_SESSION['userID']),
                "ordersPaid" => $this->cartService->getMostRecentPaidOrders($_SESSION['userID']),
            ];
            $this->displayView($models);
        }
    }
    public function updateAccount()
    {
    $response = array(
        'status' => 1,
        'message' => 'Account information has been successfully updated!'
    );

    // Read the JSON data from the request body
    $json_data = file_get_contents("php://input");
    $data = json_decode($json_data, true);

    try {
        $this->accountService->updateUser($_SESSION['userID'], $data["firstName"], $data["lastName"], $data["email"], $data["postalCode"], $data["houseNumber"]);
    } catch (ErrorException $e) {
        $response['status'] = 0;
        $response['message'] = $e->getMessage();
    }

    echo json_encode($response);
    }
}
