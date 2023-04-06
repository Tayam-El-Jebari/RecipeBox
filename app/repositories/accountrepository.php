<?php
require_once __DIR__ . '/repository.php';
require_once __DIR__ . '/../models/account.php';

class AccountRepository extends Repository
{

    function checkEmailExists($email)
    {
        try {
            $stmt = $this->connection->prepare("SELECT id FROM Users WHERE email = ?");
            $stmt->execute([$email]);
            $users = $stmt->fetchAll();
            if (empty($users)) {
                return false;
            } else {
                return true;
            }
        } catch (PDOException $e) {
            throw new ErrorException("It seems something went wrong on our side! Please try again later.");
        }
    }
    function register($firstname, $lastname, $email, $password, $postalcode, $housenumber)
    {
        try {
            $stmt = $this->connection->prepare("INSERT INTO `Users`(`firstname`, `lastname`, `email`, `password`, `postalcode`, `housenumber`) 
            VALUES (?,?,?,?,?,?)");
            $stmt->execute([$firstname, $lastname, $email, $password, $postalcode, $housenumber]);
            return true;
        } catch (Exception $e) {
            throw new ErrorException("It seems something went wrong on our side! Please try again later.");
        }
    }
    function getPasswordByEmail($email){
        try {
            $stmt = $this->connection->prepare("SELECT `password` FROM `Users` WHERE email = ?");
            $stmt->execute([$email]);
            $password = $stmt->fetch();
            return $password;
        } catch (Exception $e) {
            throw new ErrorException("It seems something went wrong with our database! Please try again later.");
        }
    }
    function getUser($email)
    {
        try {
            $stmt = $this->connection->prepare("SELECT id, firstname FROM `Users` WHERE email = ?");
            $stmt->execute([$email]);
            $userData = $stmt->fetch();
            $user = new Account($userData['id'], $userData['firstname']);            
            return $user;
        } catch (Exception $e) {
            throw new ErrorException("It seems something went wrong with our database! Please try again later.");
        }
    }
    function getUserById($id)
    {
        try {
            $stmt = $this->connection->prepare("SELECT `id`, `firstname`, `lastname`, `email`, `password`, `postalcode`, `housenumber` FROM `Users` WHERE id = ?");
            $stmt->execute([$id]);
            $userData = $stmt->fetch();
            $user = new Account($userData['id'], $userData['firstname'], $userData['lastname'], $userData['email'], $userData['password'], $userData['postalcode'], $userData['housenumber']);            
            return $user;
        } catch (Exception $e) {
            throw new ErrorException("It seems something went wrong with our database! Please try again later.");
        }
    }
}
