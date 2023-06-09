<?php
require_once __DIR__ . '/../repositories/accountrepository.php';
require_once __DIR__ . '/../models/account.php';

class AccountService
{
    private $repository;
    function __construct()
    {
        $this->repository = new AccountRepository();
    }
    private function validateUserInputs($inputStrings, $email, $postalcode, $housenumber, $password = null, $fullname = null)
    {
        if (!$this->validateStringLength($inputStrings)) {
            throw new ErrorException("One or more inputs have more than 100 characters. Please provide shorter input values.");
        }
        if (!$this->verifyEmail($email)) {
            throw new ErrorException("The email is in an incorrect format!");
        }
        if ($password !== null && $fullname !== null && !$this->isPasswordDistinct($password, $fullname, $email)) {
            throw new ErrorException("Password is too similar to email or fullname! Please choose a more secure password.");
        }
        if (!$this->verifyPostalCode($postalcode)) {
            throw new ErrorException("The format of the postal code is not correct <br>make sure the format follows: 1000XX or 1000 XX");
        }
        if (!$this->verifyHouseNumber($housenumber)) {
            throw new ErrorException("The housenumber is not correct <br>make sure the format follows: 823F or 823");
        }
    }
    public function register($firstname, $lastname, $email, $password, $postalcode, $housenumber)
    {
        try {
            $inputStrings = [$firstname, $lastname, $email, $password, $postalcode, $housenumber];
            $this->validateUserInputs($inputStrings, $email, $postalcode, $housenumber, $password, $firstname . ' ' . $lastname);

            if ($this->repository->checkEmailExists($email)) {
                throw new ErrorException("This email is already linked to an account! Please try to log in.");
            }

            $this->repository->register($firstname, $lastname, $email, password_hash($password, PASSWORD_DEFAULT), $postalcode, $housenumber);
        } catch (Exception $e) {
            throw new ErrorException($e->getMessage());
        }
    }
    public function validateStringLength($strings)
    {
        foreach ($strings as $string) {
            if (strlen($string) >= 100) {
                return false;
            }
        }
        return true;
    }
    public function updateUser($id, $firstname, $lastname, $email, $postalcode, $housenumber)
    {
        try {
            $inputStrings = [$firstname, $lastname, $email, $postalcode, $housenumber];
            $this->validateUserInputs($inputStrings, $email, $postalcode, $housenumber);

            $account = new Account($firstname, $id, $lastname, $email, '', $postalcode, $housenumber);
            $this->repository->updateUserPersonalInformation($account);
        } catch (Exception $e) {
            throw new ErrorException($e->getMessage());
        }
    }
    public function login($email, $password)
    {
        try {
            $current_time = date("H:i:s");
            $encryptedPassword = $this->repository->getPasswordByEmail($email);

            //checks if repository fetched something or checks if the password can be verified
            if ($encryptedPassword == false || !password_verify($password, $encryptedPassword["password"])) {
                throw new ErrorException("incorrect email or password! <br>Current time: {$current_time}");
            } else {
                $user = $this->repository->getUser($email);
                return $user;
            }
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function getUser($userID)
    {
        try {
            $user = $this->repository->getUserById($userID);
            return $user;
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function logout()
    {
        
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (session_status() == PHP_SESSION_ACTIVE) {
            session_destroy();
        }
        header('Location: /');
        exit();
    }
    public function verifyEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }

    private function isPasswordDistinct($password, $fullName, $email)
    {
        $similarityThreshold = 70;
        similar_text(strtolower($password), strtolower($fullName), $nameSimilarity);
        similar_text(strtolower($password), strtolower($email), $emailSimilarity);

        // Check if both similarities are below the defined threshold.
        return $nameSimilarity < $similarityThreshold && $emailSimilarity < $similarityThreshold;
    }
    private function verifyPostalCode($postalCode)
    {
        //begins with a digit between 1 and 9, followed by exactly three digits, an optional space, and ends with exactly two letters.
        $postalCodePattern = '/^[1-9][0-9]{3}\s?[a-zA-Z]{2}$/';

        $isPostalCodeValid = preg_match($postalCodePattern, $postalCode);

        if ($isPostalCodeValid) {
            return true;
        } else {
            return false;
        }
    }
    private function verifyHouseNumber($houseNumber)
    {
        // begins with a digit between 1 and 9, followed by any number of digits, and ends with an optional sequence of up to two letters.
        $houseNumberPattern = '/^[1-9][0-9]*[a-zA-Z]{0,2}$/';

        $isHouseNumberValid = preg_match($houseNumberPattern, $houseNumber);

        if ($isHouseNumberValid) {
            return true;
        } else {
            return false;
        }
    }
    //method made for password reset/ change password. Should have or could have but not Must have, isn't implemented but here for quick implementation
    public function verifyNotSamePassword($id, $password)
    {
        try {
            $current_time = date("H:i:s");
            $encryptedPassword = $this->repository->getPasswordById($id);

            if ($encryptedPassword == false || password_verify($password, $encryptedPassword["password"])) {
                return false;
            }
            return true;
        } catch (Exception $e) {
            throw $e;
        }
    }
}
