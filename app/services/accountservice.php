<?php
require_once __DIR__ . '/../repositories/productrepository.php';

class AccountService {
    public function getMostRecentFive() {

        $repository = new ProductRepository();
        return $repository->getMostRecentFour();
    }
}