<?php
require_once __DIR__ . '/../repositories/accountrepository.php';

class AccountService
{
    private $repository;
    function __construct()
    {
        $this->repository = new AccountRepository();
    }
    public function register($firstname, $lastname, $email, $password, $postalcode, $housenumber)
    {
        try {
            if ($this->repository->checkEmailExists($email)) {
                throw new ErrorException("This email is already linked to an account! Please try to log in.");
            } else if (!$this->isPasswordDistinct($password, $firstname . ' ' . $lastname, $email)) {
                throw new ErrorException("Password is too similair to email or fullname! Please choose a more secure password.");
            } else if (!$this->verifyPostalCode($postalcode)) {
                throw new ErrorException("The format of the postal code is not correct <br>make sure the format follows: 1000XX or 1000 XX");
            } else if (!$this->verifyHouseNumber($housenumber)) {
                throw new ErrorException("The housenumber is not correct <br>make sure the format follows: 823F or 823");
            } else {
                $this->repository->register($firstname, $lastname, $email, password_hash($password, PASSWORD_DEFAULT), $postalcode, $housenumber);
            }
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
    public function logout()
    {
        //if user somehow tries to log out when user has no session. This prevents crash
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (session_status() == PHP_SESSION_ACTIVE) {
            session_destroy();
        }
        header('Location: /');
        exit();
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
}
