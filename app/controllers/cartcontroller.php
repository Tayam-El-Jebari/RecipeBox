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
        $response = array(
            'status' => 1,
            'message' => 'cart is empty! please go to products and press "add to cart"',
            'products' => null
        );
        try {
            if (isset($data["cart"])  && is_array($data["cart"])) {
                $cartItems = $this->cartService->getCart($data["cart"]);
                $response['products'] = $cartItems;
            } else {
                $repsonse['message'] = "It seems the cart data has been corrupted. Please try clearing browser cache and refreshing.";
            }
        } catch (ErrorException $e) {
            $response['status'] = 0;
            $response['message'] = $e->getMessage();
        }
        if ($response['products'] == null) {
            $response['status'] = 0;
        }
        echo json_encode($response);
    }
    public function processPayment()
    {
        session_start();

        $response = [
            'status' => 0,
            'message' => 'Please login first to continue.',
        ];

        if (isset($_SESSION['user_id'])) {
            $jsonData = file_get_contents('php://input');
            $data = json_decode($jsonData, true);

            try {
                if (isset($data["cart"]) && is_array($data["cart"])) {
                    $this->cartService->storeUserCart($_SESSION['user_id'], $data["cart"]);

                    $response['status'] = 1;
                    $response['message'] = 'Payment processed successfully.';
                } else {
                    $response['message'] = 'Invalid or corrupted cart data.';
                }
            } catch (ErrorException $e) {
                $response['message'] = $e->getMessage();
            }
        }

        echo json_encode($response);
    }
}
