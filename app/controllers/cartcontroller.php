<?php
require_once __DIR__ . '/controller.php';
require_once __DIR__ . '/../services/productservice.php';
require_once __DIR__ . '/../services/cartservice.php';
class CartController extends Controller
{
    private $productService;
    private $cartService;
    function __construct()
    {
        $this->productService = new ProductService();
        $this->cartService = new CartService();
    }
    public function index()
    {
        $models = [];
        $this->displayView($models);
    }
    public function getCartItems()
    {
        $jsonData = file_get_contents('php://input');
        $data = json_decode($jsonData, true);
    
        $response = [
            'status' => 0,
            'message' => 'cart is empty! please go to products and press "add to cart"',
            'products' => null
        ];
    
        try {
            if (isset($data["cart"]) && is_array($data["cart"])) {
                $getCartItemsResult = $this->cartService->getCart($data["cart"]);
    
                if (!empty($getCartItemsResult['items'])) {
                    $response['products'] = $getCartItemsResult['items'];
                    $response['message'] = $getCartItemsResult['message'];
                    //status of 1 means cart loaded succesfully, 2 means cart loaded succesfully AND user is logged in
                    $response['status'] = isset($_SESSION['userID']) ? 2 : 1;
                }
            } else {
                $response['message'] = "It seems the cart data has been corrupted. Please try clearing browser cache and refreshing.";
            }
        } catch (ErrorException $e) {
            $response['message'] = $e->getMessage();
        }
    
        echo json_encode($response);
    }
    public function processPayment()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $response = [
            //retrieving information error
            'status' => 0,
            'message' => 'Something went wrong while processing. Please try again later',
        ];

        if (isset($_SESSION['userID'])) {
            $jsonData = file_get_contents('php://input');
            $data = json_decode($jsonData, true);

            try {
                if (isset($data["cart"]) && is_array($data["cart"])) {
                    $this->cartService->storeUserCart($_SESSION['userID'], $data["cart"]);

                    $response['status'] = 1;
                    $response['message'] = 'Payment processed successfully! You can now view the order status on your personal page';
                } else {
                    $response['message'] = 'Invalid or corrupted cart data.';
                }
            } catch (ErrorException $e) {
                $response['message'] = $e->getMessage();
            }
        } else{
            //user isn't logged in
            $response['status'] = 2;
            $response['message'] = 'Please login first to continue.';
        }

        echo json_encode($response);
    }
}
