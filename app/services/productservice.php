<?php
require_once __DIR__ . '/../repositories/productrepository.php';

class ProductService {
    private $repository;
    function __construct() {
        $this->repository = new ProductRepository();
    }
    public function getMostRecentFour() {

        return $this->repository->getMostRecentFour();
    }
    public function getAll() {

        return $this->repository->getAll();
    }

    public function getAllCategories(){
        return $this->repository->getAllCategories();
    }
}