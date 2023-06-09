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

        $IsIdPresent = isset($_GET['id']);
        if($IsIdPresent)
        {
            $this->productDetailPage($_GET['id']);
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

}