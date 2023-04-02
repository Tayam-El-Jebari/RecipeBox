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
    function login()
    {
        try {
            session_start();
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $stmt = $this->connection->prepare("SELECT * FROM `Users` WHERE email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch();
            if (!$user) {
                throw new ErrorException("foutieve email of wachtwoord");
            }
            if (!password_verify($password, $user['password'])) {
                throw new ErrorException("foutieve email of wachtwoord");
            }
            
            if (isset($_POST['remember_me'])) {
                if (array_values($_POST)[2] === "true") {
                    setcookie("user", $user, time() + 86400);
                } else if (array_values($_POST)[2] === "false"){
                    $_SESSION['user'] = $user;
                }
                else{
                    throw new ErrorException("Iets lijkt fout te zijn gegaan. probeer het later nogmaals.");
                }
            }

            return true;
        } catch (Exception $e) {
            throw new ErrorException("It seems something went wrong on our side! Please try again later.");
        }
    }
}
