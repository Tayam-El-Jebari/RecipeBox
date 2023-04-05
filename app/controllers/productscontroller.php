<?php
require_once __DIR__ . '/controller.php';
require_once __DIR__ . '/../services/productservice.php';

class ProductsController extends Controller 
{
    private $productService;

    function __construct()
    {
        $this->productService = new ProductService();
    }
    public function index()
    {
        $id = isset($_GET['id']);
        if($id)
        {
            $this->productDetailPage($id);
        }
        else{
            $models = [
                "products" => $this->productService->getAll(),
                "categories" => $this->productService->getAllCategories()
            ];
            $this->displayView($models);
        }
    }
    public function productDetailPage($id){
        $models = [
            "product" => $this->productService->getOne($id),
            
        ];
        $this->displayView($models);
    }
    public function getCartItems(){
        $jsonData = file_get_contents('php://input');
        $data = json_decode($jsonData, true);
        $response = array(
            'status' => 1,
            'message' => 'cart is empty! please go to products and press "add to cart"',
            'products' => null
        );
        try {
            if (isset($data["cart"])  && is_array($data["cart"])) {
                $cartItems = $this->productService->getCart($data["cart"]);
                $response['products'] = $cartItems;
            }
            else{
                $repsonse['message'] = "It seems the cart data has been corrupted. Please try clearing browser cache and refreshing.";
            }
        } catch (ErrorException $e) {
            $response['status'] = 0;
            $response['message'] = $e->getMessage();
        }
        if($response['products'] == null){
            $response['status'] = 0;
        }
        echo json_encode($response);
    }
}