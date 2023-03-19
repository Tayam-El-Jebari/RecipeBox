<?php
require __DIR__ . '/../repositories/accountrepository.php';

class RegisterService {
    private $repository;
    function __construct()
    {
        $this->repository = new AccountRepository();
    }
    public function register() {
        if(!$this->repository ->checkEmailExists())
        {
            if(!$this->isValidPostalCode($_POST['postalcode']))
            {
                throw new ErrorException("De postcode is incorrect ingevlud, kijk a.u.b. of je begint met 4 cijfers en eindigd met 2 letters.");
            }
            $this->repository ->registerAccount();
        }
        else{
            throw new ErrorException("Helaas is de gegeven email al in gebruik, gebruik aub een andere mail.");
        }
    }
    private function isValidPostalCode($postalCode) {
        // Regular expression to match a valid postal code
        $pattern = '/^[0-9]{4}\s?[a-zA-Z]{2}$/';
        return preg_match($pattern, $postalCode) === 1;
    }

}