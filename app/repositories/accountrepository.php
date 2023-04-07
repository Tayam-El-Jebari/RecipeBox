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
    function getPasswordByEmail($email)
    {
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
            $user = new Account($userData['firstname'], $userData['id']);
            return $user;
        } catch (Exception $e) {
            throw new ErrorException("It seems something went wrong with our database! Please try again later.");
        }
    }
    function getUserById($id)
    {
        try {
            $stmt = $this->connection->prepare("SELECT `id`, `firstname`, `lastname`, `email`, `postalcode`, `housenumber` FROM `Users` WHERE id = ?");
            $stmt->execute([$id]);
            $userData = $stmt->fetch();
            $user = new Account($userData['firstname'], $userData['id'], $userData['lastname'], $userData['email'], '', $userData['postalcode'], $userData['housenumber']);
            return $user;
        } catch (Exception $e) {
            throw new ErrorException("It seems something went wrong with our database! Please try again later.");
        }
    }
    function getPasswordById($id)
    {
        try {
            $stmt = $this->connection->prepare("SELECT  `password` FROM `Users` WHERE id = ?");
            $stmt->execute([$id]);
            $userData = $stmt->fetch();
            $password = $userData['password'];
            return $password;
        } catch (Exception $e) {
            throw new ErrorException("It seems something went wrong with our database! Please try again later.");
        }
    }
    public function updateUserPersonalInformation(Account $account)
    {
        try {
            $stmt = $this->connection->prepare("UPDATE `Users` SET `firstname` = ?, `lastname` = ?, `email` = ?, `postalcode` = ?, `housenumber` = ? WHERE `id` = ?");
            $stmt->execute([
                $account->getFirstname(),
                $account->getLastname(),
                $account->getEmail(),
                $account->getPostalcode(),
                $account->getHouseNumber(),
                $account->getUserId()
            ]);
            return true;
        } catch (Exception $e) {
            throw new ErrorException("It seems something went wrong on our side! Please try again later.");
        }
    }
}
